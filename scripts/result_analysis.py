#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
from collections import OrderedDict
import pymysql.cursors
import sys


# In[2]:


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
        return data_csv
    
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
                elif i in range(31, 41):
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
            dict_total_scores[curr_student_id] = sum(skill_wise_score.values())

        ranks_skill_wise = {}    
        for i in range(1, 6):
            ranks_skill_wise['skill_'+str(i)] = sorted(dict_skill_wise_scores, key=lambda x: (dict_skill_wise_scores[x]['skill_'+str(i)]))

        od = OrderedDict(sorted(dict_total_scores.items(), key=lambda kv:kv[1], reverse=True))

        return dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od


# In[3]:


def insert_into_db(data_csv, dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od, question_acc):
    
    # Connect to the database
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                 user='intellifyiitd16',
                                 password='dbsolve6june',
                                 db='quizdb',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    try:
        with connection.cursor() as cursor:

            i = 0
            
            wrong_omr_list = {}
            student_list = []
            same_omr_list = {}
            
            # filter wrong OMRs
            for student_id in data_csv['StudentID']:
                
                school_id = int(str(student_id)[1:4])
                level = data_csv['QuizName'][i][:7].split()[-1]
                
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
                    sql = "insert into quizdb.wrong_omr (school_id, student_id, error_type) values (%s, %s, %s)"
                    cursor.execute(sql, (school_id, student_id, error_type))
                    continue
                
                # get quizid corresponding to every student id
                # sql = "insert into demoedte_intellify.student (category_id, username, level, registrationno) values (%s, %s, %s, %s)"
                # cursor.execute(sql, (school_id, student_id, level, student_id))
            
            # get quizid corresponding to every registered student id
            sql = "select distinct I.username, E.quizid, I.registrationno from intellify.student as I, quizdb.quiz as E where I.level = E.level and E.belongs_to = 0"
            cursor.execute(sql)
            student_details = cursor.fetchall()
            
            # update history table
            for student in student_details:
                
                if len(str(student['username'])) != 7:
                    continue
                
                # get all question ids cooresponding to quizid attempted by student from question tabel
                sql = "select quesid from questions where quizid = %s"
                cursor.execute(sql, (student['quizid']))
                question_ids = cursor.fetchall()
                
                try:
                
                    username, quizid, reg_no = student['username'], student['quizid'], student['username']
                    
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
                        sql = "insert into quizdb.wrong_omr (school_id, student_id, error_type) values (%s, %s, %s)"
                        cursor.execute(sql, (int(str(student['username'])[1:4]), student['username'], "student ID didn't wrote the exam"))
                        
                    total_score = corrects*4
                    status = 1  # as round 1 has been finished
                    
                    try:
                        
                        # insert into history table
                        sql = "insert into history(`username`,`quizid`,`score`,`correct`,`wrong`,`status`, `skill_1_score`, `skill_2_score`, `skill_3_score`, `skill_4_score`, `skill_5_score`) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
                        cursor.execute(sql, (username, quizid, total_score, corrects, wrongs, status, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score))
                        
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
                    
                    except Exception as error:
                        
                        print('Error: Here', error)
                    
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
        
        # file_name = 'omr_output.csv'
        s1 = result(file_name, skills, questions, skill_range)
        data_csv = s1.get_data()
        question_acc = s1.manipulate_dataset(data_csv)
        dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od = s1.get_results(data_csv)
    
        insert_into_db(data_csv, dict_correct_responses, dict_incorrect_responses, dict_skill_wise_scores, ranks_skill_wise, od, question_acc)
        
    except Exception as error:
        
        print('error: ', error)


# In[ ]:




