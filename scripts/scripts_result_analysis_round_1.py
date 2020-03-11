import pandas as pd
from collections import OrderedDict
import pymysql.cursors
import sys
import math

class result(object):
    
    def __init__(self, file_name, skills, questions, skill_range):
        self.file_name = file_name
        self.skills = int(skills)
        self.questions = int(questions)
        self.skill_range = skill_range
    
    # function to get dataset of results
    def get_data(self):

        path = ''
        data_csv = pd.read_csv(path + self.file_name)
        data_csv = data_csv[(data_csv.StudentID >=6000000) & (data_csv.StudentID <7000000)]
        bool_series = data_csv["StudentID"].duplicated(keep = 'first')
        data_csv = data_csv[~bool_series]

        data_csv.to_csv("C:/Users/bhavi/Downloads/required.csv", index = False)
        data_csv = pd.read_csv("C:/Users/bhavi/Downloads/required.csv")
        return data_csv

    def get_level(self, data_csv):

        level = data_csv['QuizName'][0][:7].split()[-1]
        return level
    
    # get total number of skills
    def get_skills(self):

        return self.skills
    
    # alloting index for each question
    def get_question_index(self):

        return 1, self.questions

    # get number of difficulty levels
    def get_difficulty_levels(self):

        return 5

    # get details for student responses in exam
    def get_student_responses(self, data_csv):

        questionStartIndex, questionEndIndex = self.get_question_index()
        q_cols = ['Points' + str(i) for i in range(questionStartIndex,questionEndIndex+1)]
        answerCols=data_csv[q_cols]
        numStudents=answerCols.shape[0]

        return q_cols, answerCols, numStudents
    
    def manipulate_dataset(self, data_csv):

        # get total number of questions
        questionStartIndex, questionEndIndex = self.get_question_index()
        numQuestions=(questionEndIndex-questionStartIndex+1)

        questionsInEachDifficultyLevel=(questionEndIndex-questionStartIndex+1)/self.get_difficulty_levels()

        q_cols, answerCols, numStudents = self.get_student_responses(data_csv)

        # get question labels in  transposed form
        transposed_df=answerCols.transpose()

        # calculating number of correct responses for each questions
        transposed_df['numCorrect']=transposed_df.astype(bool).sum(axis=1)

        # make qid feature ranging from first question till last question
        transposed_df['qid'] = range(questionStartIndex, questionStartIndex+len(transposed_df))

        # compute percentage of correct answer given
        transposed_df['correctPercentage']=transposed_df['numCorrect']*100.0/numStudents

        # skill type=0 is to skip header
        transposed_df['skillType']=0

        # assign skill type wrt question id
        for skill in range(1, self.get_skills() + 1):
            skill_start = self.skill_range[skill][0]
            skill_end = self.skill_range[skill][0]
            transposed_df.loc[(transposed_df['qid']>=skill_start)&(transposed_df['qid']<=skill_end),'skillType' ] = skill

        colsReqd=['numCorrect','qid','correctPercentage','skillType']
        reqdDf=transposed_df[colsReqd].sort_values('correctPercentage',ascending=False)
        reqdDf['difficulty_level']=0
        
        for i in range(1,int(self.get_difficulty_levels()+1)):
            reqdDf.iloc[int((i-1)*questionsInEachDifficultyLevel):int((i)*questionsInEachDifficultyLevel),-1]=i

        question_wise_accuracy = reqdDf['correctPercentage'].to_dict()
        
        return question_wise_accuracy
    
    def get_results(self, data_csv):
        total_marks = data_csv['Possible Points'][0]*4
        student_id_array = data_csv['StudentID'].values
        q_cols, answerCols, numStudents = self.get_student_responses(data_csv)
        response_array = answerCols.values
        
        dict_correct_responses={}
        dict_wrong_responses={}
        dict_skill_correct={}
        dict_skill_incorrect={}

        for skillType in range(1, self.get_skills() + 1):
            dict_skill_correct[skillType]={}
            dict_skill_incorrect[skillType]={}

        skillWiseScore={}

        # curr_student_id = 5020005
        # curr_responses = response_array[numpy.where(student_id_array == curr_student_id)[0][0]]
        dict_correct_responses = {}
        dict_incorrect_responses = {}
        dict_skill_wise_scores = {}
        dict_total_scores = {}
        
        
        for stud in range(numStudents):    
            curr_student_id = student_id_array[stud]
            curr_responses = response_array[stud]

            # print(curr_responses)
            curr_df = pd.DataFrame(columns=['response'])
            curr_df['response'] = curr_responses

            correct_answers = {'correct_responses':[]}
            incorrect_answers = {'incorrect_responses':[]}

            response = curr_df['response'].to_dict()
            for i in response.keys():
                if response[i]:
                    correct_answers['correct_responses'].append(i+1)
                else:
                    incorrect_answers['incorrect_responses'].append(i+1)

            dict_correct_responses[curr_student_id] = correct_answers
            dict_incorrect_responses[curr_student_id] = incorrect_answers

            skill_1 = skill_2 = skill_3 = skill_4 = skill_5 = 0
            for i in correct_answers['correct_responses']:
                if i in range(1,11):
                    skill_1 += 1
                elif i in range(11, 21):
                    skill_2 += 1
                elif i in range(21, 31):
                    skill_3 += 1
                elif i in range(31, 36):
                    skill_4 += 1
                else:
                    skill_5 += 1

            skill_wise_score = {}
            skill_wise_score['skill_1'] = skill_1*4
            skill_wise_score['skill_2'] = skill_2*4
            skill_wise_score['skill_3'] = skill_3*4
            skill_wise_score['skill_4'] = skill_4*4
            skill_wise_score['skill_5'] = skill_5*4
            
            dict_skill_wise_scores[curr_student_id] = skill_wise_score
            dict_total_scores[curr_student_id] = [sum(skill_wise_score.values()), round(sum(skill_wise_score.values())*100/total_marks, 2)]
        ranks_skill_wise = {}    
        for i in range(1, 6):
            ranks_skill_wise['skill_'+str(i)] = sorted(dict_skill_wise_scores ,key=lambda x: (dict_skill_wise_scores[x]['skill_'+str(i)]))

        od = OrderedDict(sorted(dict_total_scores.items(), key=lambda kv:kv[1], reverse=True))

        return dict_correct_responses, dict_incorrect_responses, dict_total_scores, dict_skill_wise_scores, ranks_skill_wise, od

#################################################################################################
    def get_additional_results_students(self, data_csv, od, dict_total_scores, dict_skill_wise_scores):

        dict_school_scores = {}
        school_wise_dist = {}
        ranks_school_wise = {}
        total_students = len(data_csv)
        # print(od)
        for ele in od:
            # print(od[ele])
            if str(ele)[1:4] in school_wise_dist:
                school_wise_dist[str(ele)[1:4]].append([ele, od[ele][0]])
            else:
                school_wise_dist[str(ele)[1:4]] = [[ele, od[ele][0]]]
        #print(school_wise_dist)
        for school_id in school_wise_dist:
            if school_id in ranks_school_wise:
                pass
            else:
                ranks_school_wise[school_id] = []
            
            marks = -1
            rank = 0
            increment = 1
            for data in school_wise_dist[school_id]:
                stu_id, stu_marks = data[0], data[1]
                #print(stu_id, stu_marks)
                if stu_marks == marks:
                    stu_rank = rank
                    increment += 1
                else:
                    stu_rank = rank+increment
                    rank += increment
                    marks = stu_marks
                    increment = 1
                ranks_school_wise[school_id].append([stu_id, stu_rank])
        # print(ranks_school_wise)
            
        percentage = [0]*11

        for stu in dict_total_scores:
            percentage[int(dict_total_scores[stu][1] )//10] += 1

        percentage[-2] += percentage[-1]
        del (percentage[-1])
        s = sum(percentage)
        for i in range(10):
            percentage[i] = round(percentage[i]*100/s, 2)

        marks_interval = {'0-10': percentage[0], '10-20': percentage[1], '20-30': percentage[2], '30-40': percentage[3],
                          '40-50': percentage[4], '50-60': percentage[5], '60-70': percentage[6], '70-80': percentage[7],
                          '80-90': percentage[8], '90-100': percentage[9]}

        
        skill_1_m = 0
        skill_2_m = 0
        skill_3_m = 0
        skill_4_m = 0
        skill_5_m = 0
        skill_1_avg = 0
        skill_2_avg = 0
        skill_3_avg = 0
        skill_4_avg = 0
        skill_5_avg = 0

        skill_1_m1 = 0
        skill_2_m1 = 0
        skill_3_m1 = 0
        skill_4_m1 = 0
        skill_5_m1 = 0
        skill_1_avg1 = 0
        skill_2_avg1 = 0
        skill_3_avg1 = 0
        skill_4_avg1 = 0
        skill_5_avg1 = 0

        d = {}
        
        for stu in dict_skill_wise_scores:
    
            skill_1_m = max(skill_1_m, dict_skill_wise_scores[stu]['skill_1'])
            skill_2_m = max(skill_2_m, dict_skill_wise_scores[stu]['skill_2'])
            skill_3_m = max(skill_3_m, dict_skill_wise_scores[stu]['skill_3'])
            skill_4_m = max(skill_4_m, dict_skill_wise_scores[stu]['skill_4'])
            skill_5_m = max(skill_5_m, dict_skill_wise_scores[stu]['skill_5'])

            skill_1_avg += dict_skill_wise_scores[stu]['skill_1']
            skill_2_avg += dict_skill_wise_scores[stu]['skill_2']
            skill_3_avg += dict_skill_wise_scores[stu]['skill_3']
            skill_4_avg += dict_skill_wise_scores[stu]['skill_4']
            skill_5_avg += dict_skill_wise_scores[stu]['skill_5']

            school = str(stu)[1:4]

            if school in d:
                d[school]['count'] += 1
                d[school]['skill_1_m'] = max(d[school]['skill_1_m'], dict_skill_wise_scores[stu]['skill_1'])
                d[school]['skill_2_m'] = max(d[school]['skill_2_m'], dict_skill_wise_scores[stu]['skill_2'])
                d[school]['skill_3_m'] = max(d[school]['skill_3_m'], dict_skill_wise_scores[stu]['skill_3'])
                d[school]['skill_4_m'] = max(d[school]['skill_4_m'], dict_skill_wise_scores[stu]['skill_4'])
                d[school]['skill_5_m'] = max(d[school]['skill_5_m'], dict_skill_wise_scores[stu]['skill_5'])
                
                d[school]['skill_1_avg'] += dict_skill_wise_scores[stu]['skill_1']
                d[school]['skill_2_avg'] += dict_skill_wise_scores[stu]['skill_2']
                d[school]['skill_3_avg'] += dict_skill_wise_scores[stu]['skill_3']
                d[school]['skill_4_avg'] += dict_skill_wise_scores[stu]['skill_4']
                d[school]['skill_5_avg'] += dict_skill_wise_scores[stu]['skill_5']

            else:
                d[school] = {'skill_1_m':0,'skill_2_m':0,'skill_3_m':0,'skill_4_m':0,'skill_5_m':0,'skill_1_avg':0,'skill_2_avg':0,'skill_3_avg':0,'skill_4_avg':0,'skill_5_avg':0, 'count':0}
                
                d[school]['count'] += 1
                d[school]['skill_1_m'] = max(d[school]['skill_1_m'], dict_skill_wise_scores[stu]['skill_1'])
                d[school]['skill_2_m'] = max(d[school]['skill_2_m'], dict_skill_wise_scores[stu]['skill_2'])
                d[school]['skill_3_m'] = max(d[school]['skill_3_m'], dict_skill_wise_scores[stu]['skill_3'])
                d[school]['skill_4_m'] = max(d[school]['skill_4_m'], dict_skill_wise_scores[stu]['skill_4'])
                d[school]['skill_5_m'] = max(d[school]['skill_5_m'], dict_skill_wise_scores[stu]['skill_5'])
                
                d[school]['skill_1_avg'] += dict_skill_wise_scores[stu]['skill_1']
                d[school]['skill_2_avg'] += dict_skill_wise_scores[stu]['skill_2']
                d[school]['skill_3_avg'] += dict_skill_wise_scores[stu]['skill_3']
                d[school]['skill_4_avg'] += dict_skill_wise_scores[stu]['skill_4']
                d[school]['skill_5_avg'] += dict_skill_wise_scores[stu]['skill_5']
        
        skill_1_avg = round(skill_1_avg/total_students, 2)
        skill_2_avg = round(skill_2_avg/total_students, 2)
        skill_3_avg = round(skill_3_avg/total_students, 2)
        skill_4_avg = round(skill_4_avg/total_students, 2)
        skill_5_avg = round(skill_5_avg/total_students, 2)

        skill_wise_average = {'skill_1': skill_1_avg, 'skill_2': skill_2_avg, 'skill_3': skill_3_avg, 'skill_4': skill_4_avg, 'skill_5': skill_5_avg}
        skill_wise_max = {'skill_1': skill_1_m, 'skill_2': skill_2_m, 'skill_3': skill_3_m, 'skill_4': skill_4_m, 'skill_5': skill_5_m}

    
        for school in d:
            d[school]['skill_1_avg'] = round(d[school]['skill_1_avg']/d[school]['count'], 2)
            d[school]['skill_2_avg'] = round(d[school]['skill_2_avg']/d[school]['count'], 2)
            d[school]['skill_3_avg'] = round(d[school]['skill_3_avg']/d[school]['count'], 2)
            d[school]['skill_4_avg'] = round(d[school]['skill_4_avg']/d[school]['count'], 2)
            d[school]['skill_5_avg'] = round(d[school]['skill_5_avg']/d[school]['count'], 2)

        return ranks_school_wise, marks_interval, skill_wise_average, skill_wise_max, d

    def school(self, dict_school_wise_marks):
        school_rank = {}
        for school_id in dict_school_wise_marks:
            average_marks = 0
            for i in range(1,6):
                average_marks += dict_school_wise_marks[school_id]['skill_'+str(i)+'_avg']
            school_rank[school_id] = round(average_marks/5 , 2)
        school_rank = sorted(school_rank.items(), key = lambda x:x[1], reverse= True)
        
        dict_school_rank = {}
        marks = -1
        rank = 0
        increment = 1
        for data in school_rank:
            school_id, school_marks = data[0], data[1]
            #print(stu_id, stu_marks)
            if school_marks == marks:
                school_rank = rank
                increment += 1
            else:
                school_rank = rank + increment
                rank += increment
                marks = school_marks
                increment = 1
            dict_school_rank[school_id] = school_rank

        return dict_school_rank
    
    def get_additional_results_school(self, data_csv, ranks_school_wise):

        stu_qualified = {}
        school_participation = {}
        
        for school in ranks_school_wise:

            total_participation = len(ranks_school_wise[school])
            last_rank_qualified = math.ceil(total_participation/5)
            stu_qualified[school] = []
            school_participation[school] = total_participation

            for stu_data in ranks_school_wise[school]:
                if stu_data[1] <=last_rank_qualified:
                    stu_qualified[school].append(stu_data[0])
                else:
                    pass
        return stu_qualified, school_participation

    def get_overall_rank(self, od):
        overall_rank = {}
        marks = -1
        rank = 0
        increment = 1
        for data in od:
            stu_id, stu_marks = data, od[data][0]
            if stu_marks == marks:
                stu_rank = rank
                increment += 1
            else:
                stu_rank = rank+increment
                rank += increment
                marks = stu_marks
                increment = 1
            overall_rank[stu_id] = stu_rank
        return overall_rank
    
def insert_into_db_new(data_csv, ranks_school_wise, marks_interval, skill_wise_average, skill_wise_max, participation, dict_skill_wise_scores, questions, level, stu_qualified, dict_skill_wise_marks, dict_school_rank, overall_rank):

    # Connect to the database
    
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                 user='intellifyiitd16',
                                 password='dbsolve6june',
                                 db='tmp',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    
    
    try:
        cursor = connection.cursor();

        try:
            for school_id in ranks_school_wise:
                stu_data = ranks_school_wise[school_id]
                i = 0
                for stu in stu_data:
                    sql = "insert ignore into tmp.tab1(`username`,`school_id`,`level`,`school_rank`) values(%s, %s, %s, %s)";
                    cursor.execute(sql, (str(stu[0]), str(school_id), str(level), str(stu[1])));
                    i+=1
        except Exception as error:
            print(error);

        try:
            for interval in marks_interval:
                sql = "insert ignore into tmp.tab2 (`level`,`interval`,`percentage`) values (%s, %s, %s)";
                cursor.execute(sql, (str(level), str(interval), str(marks_interval[interval])));
        except Exception as error:
            print(error);

        try:
            for i in range(1, 6):
                sql = "insert ignore into tmp.tab3 (`skill`, `level`,`average`,`highest`) values (%s, %s, %s, %s)";
                cursor.execute(sql, ('skill_'+str(i), str(level), str(skill_wise_average['skill_'+str(i)]), str(skill_wise_max['skill_'+str(i)])));
        except Exception as error:
            print(error);
    
        try:
            # The number of questions in each skills have been assumed to be equal that is 45/5 = 9

            for stu_id in dict_skill_wise_scores:
                skill_1_correct = dict_skill_wise_scores[stu_id]['skill_1']//4
                skill_1_incorrect = 10 - skill_1_correct
                skill_2_correct = dict_skill_wise_scores[stu_id]['skill_2']//4
                skill_2_incorrect = 10 - skill_2_correct
                skill_3_correct = dict_skill_wise_scores[stu_id]['skill_3']//4
                skill_3_incorrect = 10 - skill_3_correct
                skill_4_correct = dict_skill_wise_scores[stu_id]['skill_4']//4
                skill_4_incorrect = 5 - skill_4_correct
                skill_5_correct = dict_skill_wise_scores[stu_id]['skill_5']//4
                skill_5_incorrect = 10 - skill_5_correct
                
                sql = "insert into tmp.Skill_wise_scores(`username`,`skill_1_correct`,`skill_1_incorrect`,`skill_2_correct`,`skill_2_incorrect`,`skill_3_correct`,`skill_3_incorrect`,`skill_4_correct`,`skill_4_incorrect`,`skill_5_correct`,`skill_5_incorrect`) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s) on duplicate key update `skill_1_correct`=values(`skill_1_correct`),`skill_1_incorrect`=values(`skill_1_incorrect`),`skill_2_correct`=values(`skill_2_correct`),`skill_2_incorrect`=values(`skill_2_incorrect`),`skill_3_correct`=values(`skill_3_correct`),`skill_3_incorrect`=values(`skill_3_incorrect`),`skill_4_correct`=values(`skill_4_correct`),`skill_4_incorrect`=values(`skill_4_incorrect`),`skill_5_correct`=values(`skill_5_correct`),`skill_5_incorrect`=values(`skill_5_incorrect`)"
                cursor.execute(sql, (str(stu_id), skill_1_correct, skill_1_incorrect, skill_2_correct, skill_2_incorrect, skill_3_correct, skill_3_incorrect, skill_4_correct, skill_4_incorrect, skill_5_correct, skill_5_incorrect))

        except Exception as error:
            print(error)

        try:
            total_students = len(data_csv)
            for i in range(1, questions+1):
                m = 'Points'+ str(i)
                n = 'Stu' + str(i)
                correct = data_csv[m].sum(axis = 0)//4
                unattempted = data_csv[n].isnull().sum()
                attempted = total_students - unattempted
                incorrect = attempted - correct

                sql = "insert ignore into tmp.question_wise_correct (`ques_no.`,`level`,`correct_attempts`,`incorrect_attempts`,`total_attempted`,`total_unattempted`) values(%s, %s, %s, %s, %s, %s)"
                cursor.execute(sql, (str(m), str(level), str(correct), str(incorrect), str(attempted), str(unattempted)))
        except Exception as error:
            print(error)

        try:
            for stu in overall_rank:
                sql = "insert into tmp.overall_rank (`username`,`level`, `overall_rank`) values (%s, %s, %s) on duplicate key update `username`=values(`username`),`level` = values(`level`), `overall_rank`=values(`overall_rank`)"
                cursor.execute(sql, (str(stu), str(level), str(overall_rank[stu])))
        except Exception as error:
            print(error)

        # Changing status of the qualified students in the intellify.student table.
        try:
            for school in stu_qualified:
                for stu in stu_qualified[school]:

                    sql = "update intellify.student set status = 1 where `username` = %s"
                    cursor.execute(sql, (str(stu)))

        except Exception as error:
            print(error)
        
        try:
            for school in dict_school_wise_marks:
                sql = "insert ignore into tmp.school_wise_avg_max (`school_id`,`level`,`skill_1_highest`,`skill_1_average`,`skill_2_highest`,`skill_2_average`,`skill_3_highest`,`skill_3_average`,`skill_4_highest`,`skill_4_average`,`skill_5_highest`,`skill_5_average`) values(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
                cursor.execute(sql, (str(school), str(level), str(dict_school_wise_marks[school]['skill_1_m']), str(dict_school_wise_marks[school]['skill_1_avg']), str(dict_school_wise_marks[school]['skill_2_m']), str(dict_school_wise_marks[school]['skill_2_avg']), str(dict_school_wise_marks[school]['skill_3_m']), str(dict_school_wise_marks[school]['skill_3_avg']), str(dict_school_wise_marks[school]['skill_4_m']), str(dict_school_wise_marks[school]['skill_4_avg']), str(dict_school_wise_marks[school]['skill_5_m']), str(dict_school_wise_marks[school]['skill_5_avg'])))

        except Exception as error:
            print(error)

        try:
            for school in dict_school_rank :

                sql = "insert ignore into tmp.school_rank (`school_id`,`level`,`rank`) values (%s, %s, %s)"
                cursor.execute(sql, (str(school), str(level), str(dict_school_rank[school])))

        except Exception as error:
            print(error)

        try:
            for school in dict_school_rank :

                sql = "insert ignore into tmp.school_rank (`school_id`,`level`,`rank`) values (%s, %s, %s)"
                cursor.execute(sql, (str(school), str(level), str(dict_school_rank[school])))

        except Exception as error:
            print(error)

    except:
        pass

    connection.commit()

###########################################################################
def insert_into_db(data_csv, dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od, question_acc, level):
    
    # Connect to the database
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                 user='intellifyiitd16',
                                 password='dbsolve6june',
                                 db='quizdb',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    try:
        cursor = connection.cursor();
        i = 0  
        wrong_omr_list = {}
        student_list = []
        same_omr_list = {}
            
        # filter wrong OMRs

        for student_id in data_csv['StudentID']:
                
            school_id = int(str(student_id)[1:4])
            level = data_csv['QuizName'][i][:7].split()[-1]
            # print(level)
            flag = 0
            error_type = ''
                
            if len(str(student_id)) != 7:
                    
                if student_id not in wrong_omr_list.keys():
                    wrong_omr_list[student_id] = data_csv['QuizName'][i]
                    error_type = 'Invalid Student ID'
                    flag = 1
                else:
                    wrong_omr_list['400' + str(student_id)] = data_csv['QuizName'][i]
                    error_type = 'Invalid Repeated Student ID'
                    flag = 1
            else:
                if student_id not in student_list:
                    student_school_id = int(str(student_id)[1:4])
                    sql = 'select 1 from intellify.school where EXISTS (select 1 where category_id = %s)'
                    cursor.execute(sql,(student_school_id))
                    flag_2 = cursor.fetchall()
                                                
                    if flag_2:
                        student_list.append(student_id)
                    else:
                        error_type = 'Invalid Student ID'
                        flag = 1
                else:
                    same_omr_list[student_id] = data_csv['QuizName'][i]
                    error_type = 'Repeated Student ID'
                    flag = 1
            i += 1
            if flag == 1:

                sql = "insert ignore into wrong_omr (student_id, error_type, school_id) values (%s, %s, %s) on duplicate key update `student_id`=values(`student_id`),`error_type`=values(`error_type`),`school_id`=values(`school_id`)"
                cursor.execute(sql, (student_id, error_type, school_id))
                continue
                
            # get quizid corresponding to every student id
            # sql = "insert into demoedte_intellify.student (category_id, username, level, registrationno) values (%s, %s, %s, %s)"
            # cursor.execute(sql, (school_id, student_id, level, student_id))

        # print(student_list, wrong_omr_list, same_omr_list)
                
        # get quizid corresponding to every registered student id
        sql = "select distinct I.username,  E.quizid, I.registrationno from intellify.student as I, quizdb.quiz as E where I.level = E.level and E.belongs_to = 0"
        cursor.execute(sql)
        student_details = cursor.fetchall()
        # update history table

        for student in student_details:
            if len(str(student['username'])) != 7:
                pass
            else:
                # get all question ids cooresponding to quizid attempted by student from question tabel
                sql = "select quesid from questions where quizid = %s"
                cursor.execute(sql, (student['quizid']))
                question_ids = cursor.fetchall()

                try:
                    # print("Inside try 2")
                    username, quizid, reg_no = student['username'], student['quizid'], student['registrationno']
                    if int(quizid) == int(level)+66:
                        # print("!!!!")
                        # exception handling for knowing students who registered but didn't appear for Round 1
                        try:
                            corrects = len(dict_correct_responses[int(reg_no)]['correct_responses'])
                            wrongs = len(dict_incorrect_responses[int(reg_no)]['incorrect_responses'])
                            skill_1_score = dict_skill_wise_scores[int(reg_no)]['skill_1']
                            skill_2_score = dict_skill_wise_scores[int(reg_no)]['skill_2']
                            skill_3_score = dict_skill_wise_scores[int(reg_no)]['skill_3']
                            skill_4_score = dict_skill_wise_scores[int(reg_no)]['skill_4']
                            skill_5_score = dict_skill_wise_scores[int(reg_no)]['skill_5']

                        except:
                            corrects = 0
                            wrongs = 0
                            skill_1_score = 0
                            skill_2_score = 0
                            skill_3_score = 0
                            skill_4_score = 0
                            skill_5_score = 0

                            # insert into wrong omr table
                            sql = "insert ignore into wrong_omr (school_id, student_id, error_type) values (%s, %s, %s) on duplicate key update `student_id`=values(`student_id`),`error_type`=values(`error_type`),`school_id`=values(`school_id`)"
                            cursor.execute(sql, (int(str(student['username'])[1:4]), student['username'], "student ID didn't wrote the exam"))

                        total_score = corrects*4
                        status = 1  # as round 1 has been finished
                        # insert into history table
                        sql = "insert into quizdb.history(`username`,`quizid`,`score`,`correct`,`wrong`,`status`, `skill_1_score`, `skill_2_score`, `skill_3_score`, `skill_4_score`, `skill_5_score`) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s) on duplicate key update `username`=values(`username`),`quizid`=values(`quizid`),`score`=values(`score`),`correct`=values(`correct`),`wrong`=values(`wrong`),`status`=values(`status`), `skill_1_score`=values(`skill_1_score`), `skill_2_score`=values(`skill_2_score`), `skill_3_score`=values(`skill_3_score`), `skill_4_score`=values(`skill_4_score`), `skill_5_score`=values(`skill_5_score`) "
                        cursor.execute(sql,(str(username), str(quizid), str(total_score), str(corrects), str(wrongs), str(status), str(skill_1_score), str(skill_2_score), str(skill_3_score), str(skill_4_score), str(skill_5_score)))
                    else:
                        pass
                        #if username in ans:
                            #print(username)
                            #break
                        #else:
                           # ans.append(username)
                        # insert into user_performance table
                        # sql = "insert into user_performance(`username`,`score`,`skill_1`, `skill_2`, `skill_3`, `skill_4`, `skill_5`,`quiz_attempted`) values(%s,%s,%s,%s,%s,%s,%s,%s)"
                        # cursor.execute(sql, (username, total_score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score, 1))

                        # for q_id in question_ids:

                        #     # insert student username and quiz id in user_answer table
                        #     sql_2 = "insert into user_answer(`username`, `quesid`) values(%s, %s)"
                        #     cursor.execute(sql_2, (username, q_id['quesid']))
                        
                        # # exception-handling to update user-answer table
                        # try:
                        #     correct_responses = dict_correct_responses[int(reg_no)]
                        
                        #     for i in correct_responses.values():

                        #         for q_id in i:
                        #             sql = 'update user_answer A, questions B, quiz C set flag = 1 where A.quesid = B.quesid and B.quizid = C.quizid and A.username = %s and B.quesid = %s and C.quizid = %s'
                        #             cursor.execute(sql, (reg_no, q_id, quizid))
                        
                        # except: # skip inserting (leave zero flag) if student didn't appear for olympiad
                            
                        #     pass

                except:
                    continue
        # connection is not autocommit by default. So you must commit to save
        # your changes.
        connection.commit()

    finally:

        connection.close()


# In[6]:


if __name__ == '__main__':
    
    try:
        """
       file_name, skills, questions = sys.argv[1], sys.argv[2], sys.argv[3]
        
        if not sys.argv[3 + 2*int(skills)]:
            
            raise Exception('missing range arguments')
        
        elif sys.argv[3 + 2*int(skills)] != questions:

            raise Exception('question and range not matching')

        
        skill_range = {}
        skill_counter = 1
        for i in range(4, int(skills)*2 + 3, 2):
            skill_range[skill_counter] = [ int(sys.argv[i]), int(sys.argv[i+1]) ]
            skill_counter += 1
""" 
        for i in range(1):
            questions = 45
            skills = 5
            file_name = 'file'+str(i)+'.csv'
            skill_range = {1:[1,10],2:[11,20],3:[21,30],4:[31,35],5:[36,45]}

            s1 = result(file_name, skills, questions, skill_range)
            data_csv = s1.get_data()
            level = s1.get_level(data_csv)
            question_acc = s1.manipulate_dataset(data_csv)

            dict_correct_responses, dict_incorrect_responses, dict_total_scores, dict_skill_wise_scores, ranks_skill_wise, od = s1.get_results(data_csv)
            # print(dict_correct_responses, dict_incorrect_responses, dict_total_scores, dict_skill_wise_scores)
            ranks_school_wise, marks_interval, skill_wise_average, skill_wise_max, dict_school_wise_marks = s1.get_additional_results_students(data_csv, od, dict_total_scores, dict_skill_wise_scores)
            dict_school_rank = s1.school(dict_school_wise_marks)
            stu_qualified, school_participation = s1.get_additional_results_school(data_csv, ranks_school_wise)
            overall_rank = s1.get_overall_rank(od)
            insert_into_db_new(data_csv, ranks_school_wise, marks_interval, skill_wise_average, skill_wise_max, school_participation, dict_skill_wise_scores, questions, level, stu_qualified, dict_school_wise_marks, dict_school_rank, overall_rank)
            print(7)
            insert_into_db(data_csv, dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od, question_acc, level)
            print("DONE")

    except Exception as error:
        print('error: ', error)
