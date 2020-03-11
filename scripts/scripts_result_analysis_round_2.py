# Script for round 2 analysis 
# note : quizdb.history have student who gave round2 and updates will be there only.
#  intellify.student have status=1 for those who qualifed round1 
# during round 2 intellify.user_answer table is updated 
# Round 2 result is present in intellify.history
# Importing Libraries...
import numpy 
import pandas
from collections import OrderedDict
import pymysql.cursors
import sys
import math

def fetch_from_db():
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                 user='intellifyiitd16',
                                 password='dbsolve6june',
                                 db='intellify',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    cursor = connection.cursor()
    username_level_query = "select I.username, I.level, U.quesid, U.flag , QZ.skill_id from quizdb.user_answer as U , intellify.student as I, quizdb.quiz as QZ, quizdb.questions as Q where QZ.belongs_to = 1 and  QZ.quizid = Q.quizid and Q.quesid = U.quesid and  I.status = 1 and I.username = U.username "

    try:
        cursor.execute(username_level_query)
        user_name = cursor.fetchall()
        data_dict = {}
        question_wise_correct = {}
        
        for i in range(len(user_name)):
            username = user_name[i]['username']
            level = int(user_name[i]['level'])
            quesid = user_name[i]['quesid']
            flag = user_name[i]['flag']
            skill_id = user_name[i]['skill_id']
#--------------------------------------------------------------------#
            if quesid in question_wise_correct:
                pass
            else:
                question_wise_correct[quesid] = [0,0,0,0]

            if flag == 1:
                question_wise_correct[quesid][0] += 1
            else:
                question_wise_correct[quesid][1] += 1
#--------------------------------------------------------------------#
            if username in data_dict:
                pass
            else:
                data_dict[username] = [{},level]
            
            if quesid in data_dict[username][0]:
                pass
            else:
                data_dict[username][0][quesid] = flag

    except:
        pass

    questions = {}
    try:
        sql = "select Q.skill_id from quizdb.quiz as Q where Q.belongs_to = 1 "
        cursor.execute(sql)
        skills = cursor.fetchall()
        skill_id = []
        for skillid in skills:
            skill_id.append(skillid['skill_id'])
        skill_id = sorted(list(set(skill_id)))

        for level in range(4):
            for skill in skill_id:
                sql = "select q.quesid from quizdb.questions as q, quizdb.quiz as Q where q.quizid = Q.quizid and Q.belongs_to = 1 and Q.level = %s and skill_id = %s"
                cursor.execute(sql, (level, skill))
                data = cursor.fetchall()
    
                for ques in data:
                    if level in questions:
                        pass
                    else:
                        questions[level] = {}

                    if skill in questions[level]:
                        questions[level][skill].append(ques['quesid'])
                    else:
                        questions[level][skill] = [ques['quesid']]
                        
    except:
        pass

    try:
        quiz_marks = {}
        for level in range(4):
            sql = "select quizid, correct as marks from quizdb.quiz where level = %s and belongs_to = 1"
            cursor.execute(sql, (level))
            quiz_list_data = cursor.fetchall()
            #print(quiz_list_data)

            for ele in quiz_list_data:
                quiz_marks[ele['quizid']] = ele['marks']

    except:
        pass

    try:
        ques_quiz = {}
        for quizid in quiz_marks:
            sql = "select quesid from quizdb.questions where quizid = %s"
            cursor.execute(sql, (quizid))
            quiz_list_data = cursor.fetchall()
            for ele in quiz_list_data:
                ques_quiz[ele['quesid']] = quizid

    except:
        pass

    try:
        ques_marks = {}
        for quesid in ques_quiz:
            ques_marks[quesid] = quiz_marks[ques_quiz[quesid]]

    except:
        pass
        
    return data_dict, questions, question_wise_correct, ques_marks

    connection.commit()
#-------------------------------------------------------------------------------------------------------------------------#
    
def get_result_round_2(data_dict, questions, ques_marks):
    
    dict_correct_responses = {}
    dict_incorrect_responses = {}
    dict_total_scores = {}
    dict_skill_wise_scores = {}
    od = {}
    dict_level = {0:[], 1:[], 2:[], 3:[]}

    total_questions ={}
    skill_wise_questions = {}
    for level in questions:
        s = 0
        if level in skill_wise_questions:
            pass
        else:
            skill_wise_questions[level] = {}
        for skill_id in questions[level]:
            s += len(questions[level][skill_id])
            skill_wise_questions[level][skill_id] = len(questions[level][skill_id])
                
        total_questions[level] = s

    for student in data_dict:
        level = data_dict[student][1]
        
        if student in dict_correct_responses:
            pass
        else:
            dict_correct_responses[student] = {'correct_response': []}
        if student in dict_incorrect_responses:
            pass
        else:
            dict_incorrect_responses[student] = {'incorrect_response': []}
        if student in dict_total_scores:
            pass
        else:
            dict_total_scores[student] = [0, 0]

        dict_level[level].append(student)

        for quesid in data_dict[student][0]:
            if data_dict[student][0][quesid] == 1:
                dict_correct_responses[student]['correct_response'].append(quesid)
                dict_total_scores[student][0] += ques_marks[quesid]
                dict_total_scores[student][1] = round(dict_total_scores[student][0]*100/(total_questions[level]*ques_marks[quesid]), 2)
            else:
                dict_incorrect_responses[student]['incorrect_response'].append(quesid)

        if student in dict_skill_wise_scores:
            pass
        else:
            dict_skill_wise_scores[student] = {}

        for ques in dict_correct_responses[student]['correct_response']:
            for skillid in questions[level]:
                if ques in questions[level][skillid]:
                    if skillid in dict_skill_wise_scores[student]:    
                        dict_skill_wise_scores[student][skillid][0] += ques_marks[ques]
                        dict_skill_wise_scores[student][skillid][1] = round(dict_skill_wise_scores[student][skillid][0]*100/(skill_wise_questions[level][skillid]*ques_marks[ques]), 2)
                    else:
                        dict_skill_wise_scores[student][skillid] = [ques_marks[ques],round(100/skill_wise_questions[level][skillid], 2)]
                else:
                    pass
                    
        for skill in questions[level]:
            if skill in dict_skill_wise_scores[student]:
                pass
            else:
                dict_skill_wise_scores[student][skill] = [0, 0]
                
    od = OrderedDict(sorted(dict_total_scores.items(), key=lambda kv:kv[1], reverse=True))

    return dict_correct_responses, dict_incorrect_responses, dict_total_scores, dict_skill_wise_scores, od, dict_level

#------------------------------------------------------------------------------------------------------------------------------#

def get_additional_results_students(od, dict_total_scores, dict_skill_wise_scores, dict_level):

    ranks_overall = {0:[], 1:[], 2:[], 3:[]}
    ranks_skill_wise = {0:{}, 1:{}, 2:{}, 3:{}}

    level_wise_dist = {0:[], 1:[], 2:[], 3:[]}
    
    for ele in od:
        if ele in dict_level[0]:
            level_wise_dist[0].append([ele, od[ele]])
        elif ele in dict_level[1]:
            level_wise_dist[1].append([ele, od[ele]])
        elif ele in dict_level[2]:
            level_wise_dist[2].append([ele, od[ele]])
        else:
            level_wise_dist[3].append([ele, od[ele]])
# Overall Ranks
    for level in level_wise_dist:
        
        marks = -1
        rank = 0
        increment = 1
        for data in level_wise_dist[level]:
            stu_id, stu_marks = data[0], data[1][0]
            
            if stu_marks == marks:
                stu_rank = rank
                increment += 1
            else:
                stu_rank = rank+increment
                rank += increment
                marks = stu_marks
                increment = 1
            ranks_overall[level].append([stu_id, stu_rank])
    
    level_wise_percentage = {0:0, 1:0, 2:0, 3:0}
    for level in range(4):
        percentage = [0]*11

        for stu in dict_level[level]:
            percentage[int(dict_total_scores[stu][1] )//10] += 1
            
        percentage[-2] += percentage[-1]
        del (percentage[-1])
        s = sum(percentage)
        if s==0:
            for i in range(10):
                percentage[i] = 0
        else:
            for i in range(10):
                percentage[i] = round(percentage[i]*100/s, 2)

        marks_interval = {'0-10': percentage[0], '10-20': percentage[1], '20-30': percentage[2], '30-40': percentage[3],
                          '40-50': percentage[4], '50-60': percentage[5], '60-70': percentage[6], '70-80': percentage[7],
                          '80-90': percentage[8], '90-100': percentage[9]}

        level_wise_percentage[level] = marks_interval

    # Dictionary d to store the maximum and average score in each skill in each skill
    d = {0:[{},{}], 1:[{},{}], 2:[{},{}], 3:[{},{}]}
    
    for level in range(4):
        skill_max = {}
        skill_avg = {}
        total_stu = len(dict_level[level])
        for stu in dict_level[level]:
            
            for skillid in dict_skill_wise_scores[stu]:
                if skillid in skill_max:
                    skill_max[skillid] = max(skill_max[skillid], dict_skill_wise_scores[stu][skillid][0])
                else:
                    skill_max[skillid] = dict_skill_wise_scores[stu][skillid][0]

                if skillid in skill_avg:
                    skill_avg[skillid] += dict_skill_wise_scores[stu][skillid][0]
                else:
                    skill_avg[skillid] = dict_skill_wise_scores[stu][skillid][0]
    
            for skillid in dict_skill_wise_scores[stu]:
                d[level][1][skillid] = skill_max[skillid]
                d[level][0][skillid] = round(skill_avg[skillid]/total_stu, 2)

    school_wise_dist = {}
    ranks_school_wise = {}
    for level in dict_level:
        if level in school_wise_dist:
            pass
        else:
            school_wise_dist[level] = {}
            
        for ele in dict_level[level]:
            if str(ele)[1:4] in school_wise_dist[level]:
                school_wise_dist[level][str(ele)[1:4]].append([ele, od[ele][0]])
            else:
                school_wise_dist[level][str(ele)[1:4]] = [[ele, od[ele][0]]]

    for level in school_wise_dist:
        for sch in school_wise_dist[level]:
            school_wise_dist[level][sch] = sorted(school_wise_dist[level][sch], key = lambda x:(x[1]), reverse = True)
    
    for level in school_wise_dist:
        if level in ranks_school_wise:
            pass
        else:
            ranks_school_wise[level] = {}
        
        for sch in school_wise_dist[level]:
            if sch in ranks_school_wise[level]:
                pass
            else:
                ranks_school_wise[level][sch] = []
            
            marks = -1
            rank = 0
            increment = 1
            for data in school_wise_dist[level][sch]:
                stu_id, stu_marks = data[0], data[1]
                if stu_marks == marks:
                    stu_rank = rank
                    increment += 1
                else:
                    stu_rank = rank+increment
                    rank += increment
                    marks = stu_marks
                    increment = 1
                ranks_school_wise[level][sch].append([stu_id, stu_rank])
            
    return ranks_overall, level_wise_percentage, d, ranks_school_wise

#------------------------------------------------------------------------------------------------------------------------------------#

def qualification(ranks_overall):

    stu_qualified = {0:[], 1:[], 2:[], 3:[]}
    stu_waiting = {0:[], 1:[], 2:[], 3:[]}

    for level in ranks_overall:
        last_rank_qualified = 20
        start_rank_waiting = 21
        last_rank_waiting = 40

        for stu_data in ranks_overall[level]:
            if stu_data[1] <=last_rank_qualified:
                stu_qualified[level].append(stu_data[0])
            elif stu_data[1]>=start_rank_waiting and stu_data[1]<=last_rank_waiting:
                stu_waiting[level].append(stu_data[0])
            else:
                pass

    return stu_qualified, stu_waiting

# ----------------------------------------------------------------------------------------------------------#

# select u.username, u.quesid, u.flag from quizdb.history as u , intellify.student as s where s.status = 1 and s.username = u.username
def insert_into_db(ranks_overall, level_wise_percentage, d, dict_skill_wise_scores, dict_level, stu_qualified, stu_waiting, question_wise_correct, dict_correct_responses, dict_incorrect_responses, ranks_school_wise):
    # Connect to the database
    
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                 user='intellifyiitd16',
                                 password='dbsolve6june',
                                 db='Round_2',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)
    
    
    try:
        cursor = connection.cursor();
        
        try:
            for level in ranks_overall:
                for stu in ranks_overall[level]:
                    sql = "insert into overall_rank(`username`,`level`,`overall_rank`) values(%s, %s, %s)";
                    cursor.execute(sql, (str(stu[0]), str(level), str(stu[1])))
        except Exception as error:
            print(error)

        try:
            for level in level_wise_percentage:
                for interval in level_wise_percentage[level]:
                    sql = "insert into interval_percentage (`level`,`interval`,`percentage`) values (%s, %s, %s)";
                    cursor.execute(sql, (str(level), str(interval), str(level_wise_percentage[level][interval])))
        except Exception as error:
            print(error)

        try:
            for level in d:
                for skill in d[level][0]:
                    sql = "insert into skill_wise_avg_hig (`skill`, `level`,`average`,`highest`) values (%s, %s, %s, %s)";
                    cursor.execute(sql, (str(skill), str(level), str(d[level][0][skill]), str(d[level][1][skill])))
        except Exception as error:
            print(error)
        
        try:
            for level in dict_level:
                for stu in dict_level[level]:
                    skill_data = {}
                    for quesid in dict_correct_responses[stu]['correct_response']:
                        for skill in questions[level]:
                            if quesid in questions[level][skill]:
                                if skill in skill_data:
                                    skill_data[skill][0] += 1
                                else:
                                    skill_data[skill] = [1, 0]
                                break
                            else:
                                pass
                            
                    for quesid in dict_incorrect_responses[stu]['incorrect_response']:
                        for skill in questions[level]:
                            if quesid in questions[level][skill]:
                                if skill in skill_data:
                                    skill_data[skill][1] += 1
                                else:
                                    skill_data[skill] = [0, 1]
                                break
                            else:
                                pass
                    skill_wise_data = []
                    for skill in questions[level]:
                        if skill in skill_data:
                            skill_wise_data.append(skill_data[skill][0])
                            skill_wise_data.append(skill_data[skill][1])
                        else:
                            skill_wise_data.append(0)
                            skill_wise_data.append(0)
                    sql = "insert into skill_wise_score(`username`,`skill_1_correct`,`skill_1_incorrect`,`skill_2_correct`,`skill_2_incorrect`,`skill_3_correct`,`skill_3_incorrect`,`skill_4_correct`,`skill_4_incorrect`) values (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                    cursor.execute(sql, (str(stu), skill_wise_data[0], skill_wise_data[1], skill_wise_data[2], skill_wise_data[3], skill_wise_data[4], skill_wise_data[5], skill_wise_data[6], skill_wise_data[7]))

        except Exception as error:
            print(error)
    
        try:
            
            for quesid in question_wise_correct:
                for level in questions:
                    for skill in questions[level]:
                        cond = False
                        if quesid in questions[level][skill]:
                            cond = True
                            break
                        else:
                            pass
                    if cond == True:
                        break
                    else:
                        pass
                total_stu = len(dict_level[level])
                
                sql = "insert into question_wise_correct (`ques_no`,`level`,`correct_attempts`,`incorrect_attempts`,`total_attempted`,`total_unattempted`) values(%s, %s, %s, %s, %s, %s)"
                cursor.execute(sql, (str(quesid), str(level), str(question_wise_correct[quesid][0]), str(question_wise_correct[quesid][1]), str(question_wise_correct[quesid][0] + question_wise_correct[quesid][1]), str(total_stu - (question_wise_correct[quesid][0] + question_wise_correct[quesid][1]))))

        except Exception as error:
            print(error)

        try:
            sql = select I.username, I.level, QZ.quizid , QZ.skill_id
                         from quizdb.user_answer as U , intellify.student as I, quizdb.quiz as QZ, quizdb.questions as Q
                         where QZ.belongs_to = 1 and  QZ.quizid = Q.quizid and Q.quesid = U.quesid and  (I.status = 1 
                         or I.status = 2 or I.status = 3) and I.username = U.username group by username, quizid
                    
            cursor.execute(sql)
            data = cursor.fetchall()

            for student in data:
                username = student['username']
                quizid = student['quizid']
                score = dict_skill_wise_scores[username][student['skill_id']][0]

                sql = "update quizdb.history set score = %s where username = %s and quizid = %s"
                cursor.execute(sql, (str(score), username, str(quizid)))
                
        except Exception as error:
            print(error)

        # Changing status of the qualified students in the intellify.student table.
        try:
            for level in stu_qualified:
                for stu in stu_qualified[level]:

                    sql = "update intellify.student set status = 3 where `username` = %s"
                    cursor.execute(sql, (str(stu)))

        except Exception as error:
            print(error)

        # Changing status of the waiting students in the intellify.student table.
        try:
            for level in stu_waiting:
                for stu in stu_waiting[level]:

                    sql = "update intellify.student set status = 2 where `username` = %s"
                    cursor.execute(sql, (str(stu)))

        except Exception as error:
            print(error)

        try:
            for level in ranks_school_wise:
                for school_id in ranks_school_wise[level]:
                    stu_data = ranks_school_wise[level][school_id]
                    
                    for stu in stu_data:
                        sql = "insert ignore into Round_2.School_wise_ranks(`username`,`school_id`,`level`,`school_rank`) values(%s, %s, %s, %s)";
                        cursor.execute(sql, (str(stu[0]), str(school_id), str(level), str(stu[1])));
                        
        except Exception as error:
            print(error);
        """
        try:
            for username in dict_skill_wise_scores:
                sql = "insert into Round_2.Dummy(`username`, `ps`, `wm`, `se`, `msc`) values(%s, %s, %s, %s, %s) "
                cursor.execute(sql, (username, str(dict_skill_wise_scores[username][72][1]), str(dict_skill_wise_scores[username][73][1]), str(dict_skill_wise_scores[username][74][1]), str(dict_skill_wise_scores[username][75][1])))

        except Exception as error:
            print(error)
        """  
    except:
        pass

    connection.commit()

#################################################################################
    
if __name__ == '__main__':
    try:
        print("FETCHING DATA .....")
        data_dict, questions, question_wise_correct, ques_marks = fetch_from_db()
        print("FETCHING DONE !")
        print()
        print("ANALYSING DATA ........")
        dict_correct_responses, dict_incorrect_responses, dict_total_scores, dict_skill_wise_scores, od, dict_level = get_result_round_2(data_dict, questions, ques_marks)
        ranks_overall, level_wise_percentage, d, ranks_school_wise = get_additional_results_students(od, dict_total_scores, dict_skill_wise_scores, dict_level)
        stu_qualified, stu_waiting = qualification(ranks_overall)
        #print(dict_skill_wise_scores)
        print("DATA ANALYSATION DONE !")
        print()
        print("INSERTING DATA INTO DATABASE .......")
        insert_into_db (ranks_overall, level_wise_percentage, d, dict_skill_wise_scores, dict_level, stu_qualified, stu_waiting, question_wise_correct, dict_correct_responses, dict_incorrect_responses, ranks_school_wise)
        print("DATA INSERTION DONE !")
        print()
        print("OVER AND OUT")
    except Exception as error:
        print('error',error)

# SQL Query for making CSV of students with their question wise answer.

"""1.
        select I.username, I.level, U.quesid, QZ.skill_id, A.answer, 
            U.user_response, U.flag

            from quizdb.user_answer as U , intellify.student as I, 
            quizdb.quiz as QZ, quizdb.questions as Q, quizdb.answer as A

            where QZ.belongs_to = 1 and  QZ.quizid = Q.quizid and 
            Q.quesid = A.quesid and A.quesid = U.quesid and I.status = 1 and I.username = U.username


2.

select I.username, I.firstname, I.lastname, I.category_id, 
S.name as school, I.class, M.skill_1_correct as 
quiz_1_correct, M.skill_2_correct as quiz_2_correct, 
M.skill_3_correct as quiz_3_correct, M.skill_4_correct 
as quiz_4_correct
from intellify.student as I, intellify.school as S, 
Round_2.skill_wise_score as M
where I.category_id = S.category_id and I.status = 1 and 
I.username = M.username
"""
