#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
import pymysql.cursors
import sys


# In[2]:


def get_data(file_name):
    path = ''
    data_frame = pd.read_csv(path + file_name)
    return data_frame


# In[3]:


# Connect to the database
connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                             user='intellifyiitd16',
                             password='dbsolve6june',
                             db='quizdb',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)


# In[4]:


option_label = {1:'A', 2:'B', 3:'C', 4:'D'}


# In[5]:


def mcq4_questions(data_frame, quizid, path_to_image):
    
    if 'option1' not in data_frame or 'option2' not in data_frame or 'option3' not in data_frame or 'option4' not in data_frame:
        return False
    
    question_numbers = data_frame['question_number']
    question_texts = data_frame['question_text']
    option1_texts, option2_texts, option3_texts, option4_texts = data_frame['option1'], data_frame['option2'], data_frame['option3'], data_frame['option4']
    answers_texts = data_frame['answer']
    difficulty = data_frame['question_difficulty']
    quiz_id = quizid
    
    passage = ''    
    question_image_url = ''
    
    pflag = 0
    iflag = 0
    if 'passage' in data_frame:
        data_frame['passage'].fillna("No Passage", inplace = True)
        passage = data_frame['passage']
        pflag = 1
    
    if 'question_image_url' in data_frame:
        data_frame['question_image_url'].fillna("No Image", inplace = True)
        question_image_url = data_frame['question_image_url']
        iflag = 1
    
    option_1_image_flag = 0
    option_2_image_flag = 0
    option_3_image_flag = 0
    option_4_image_flag = 0
    
    option_1_image_url = ''
    option_2_image_url = ''
    option_3_image_url = ''
    option_4_image_url = ''
    
    if 'option_1_image' in data_frame:
        data_frame['option_1_image'].fillna("No Image", inplace = True)
        option_1_image_url = data_frame['option_1_image']
        option_1_image_flag = 1
    
    if 'option_2_image' in data_frame:
        data_frame['option_2_image'].fillna("No Image", inplace = True)
        option_2_image_url = data_frame['option_2_image']
        option_2_image_flag = 1
        
    
    if 'option_3_image' in data_frame:
        data_frame['option_3_image'].fillna("No Image", inplace = True)
        option_3_image_url = data_frame['option_3_image']
        option_3_image_flag = 1
    
    if 'option_4_image' in data_frame:
        data_frame['option_4_image'].fillna("No Image", inplace = True)
        option_4_image_url = data_frame['option_4_image']
        option_4_image_flag = 1
    
    try:
        with connection.cursor() as cursor:
         
            for i in question_numbers:
                
                if pflag:
                    q_text = passage[i-1] + '\n\n' + question_texts[i-1]
                else:
                    q_text = question_texts[i-1]
                    
                sql = 'insert into questions(qnstext, quizid, difficulty_level) values (%s, %s, %s)'
                cursor.execute(sql, (q_text, quiz_id, int(difficulty[i-1])))
                    
                sql = 'select quesid from questions where qnstext = %s and quizid = %s'
                cursor.execute(sql, (q_text, quiz_id))
                
                ques_id = cursor.fetchall()[-1]['quesid']
                
                if iflag:
                    sql = 'update questions set questions_img = %s where quesid = %s'
                    cursor.execute(sql, (path_to_image + '/questions/' + question_image_url[i-1], ques_id))
                
                if option_1_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('A', option1_texts[i-1], ques_id, path_to_image + '/options/' + option_1_image_url[i-1]))
                
                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('A', option1_texts[i-1], ques_id))
                
                if option_2_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('B', option2_texts[i-1], ques_id, path_to_image + '/options/' + option_2_image_url[i-1]))

                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('B', option2_texts[i-1], ques_id))

                if option_3_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('C', option3_texts[i-1], ques_id, path_to_image + '/options/' + option_3_image_url[i-1]))
                
                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('C', option3_texts[i-1], ques_id))
                
                if option_4_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('D', option4_texts[i-1], ques_id, path_to_image + '/options/' + option_4_image_url[i-1]))
                
                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('D', option4_texts[i-1], ques_id))
                
                # print(type(ques_id), type())
                sql = 'insert into answer(quesid, answer) values(%s, %s)'
                cursor.execute(sql,(ques_id, option_label[answers_texts[i-1]]))
                
            sql = 'select count(*) from questions where quizid = %s'
            cursor.execute(sql,(quiz_id))
            no_of_questions = cursor.fetchall()[0]['count(*)']
            
            sql = 'update quiz set total = %s where quizid = %s'
            cursor.execute(sql,(no_of_questions, quiz_id))
             
        # connection is not autocommit by default. So you must commit to save
        # your changes.
        connection.commit()
        
    finally:
    
        connection.close()
        return True


# In[6]:


def mcq2_questions(data_frame, quizid, path_to_image):
    
    if 'option3' in data_frame or 'option4' in data_frame:
        return False
    
    question_numbers = data_frame['question_number']
    question_texts = data_frame['question_text']
    option1_texts, option2_texts = data_frame['option1'], data_frame['option2']
    answers_texts = data_frame['answer']
    difficulty = data_frame['question_difficulty']
    quiz_id = quizid
    
    passage = ''
    question_image_url = ''
    
    pflag = 0
    iflag = 0
    if 'passage' in data_frame:
        data_frame['passage'].fillna("No Passage", inplace = True)
        passage = data_frame['passage']
        pflag = 1
    
    if 'question_image_url' in data_frame:
        data_frame['question_image_url'].fillna("No Image", inplace = True)
        question_image_url = data_frame['question_image_url']
        iflag = 1
    
    option_1_image_flag = 0
    option_2_image_flag = 0
    
    option_1_image_url = ''
    option_2_image_url = ''
    
    if 'option_1_image' in data_frame:
        data_frame['option_1_image'].fillna("No Image", inplace = True)
        option_1_image_url = data_frame['option_1_image']
        option_1_image_flag = 1
    
    if 'option_2_image' in data_frame:
        data_frame['option_2_image'].fillna("No Image", inplace = True)
        option_2_image_url = data_frame['option_2_image']
        option_2_image_flag = 1
    
    try:
        with connection.cursor() as cursor:
         
            for i in question_numbers:
                
                if pflag:
                    q_text = passage[i-1] + '\n\n' + question_texts[i-1]
                else:
                    q_text = question_texts[i-1]
                    
                sql = 'insert into questions(qnstext, quizid, difficulty_level) values (%s, %s, %s)'
                cursor.execute(sql, (q_text, quiz_id, int(difficulty[i-1])))
                    
                sql = 'select quesid from questions where qnstext = %s and quizid = %s'
                cursor.execute(sql, (q_text, quiz_id))
                
                ques_id = cursor.fetchall()[-1]['quesid']
                
                if iflag:
                    sql = 'update questions set questions_img = %s where quesid = %s'
                    cursor.execute(sql, (path_to_image + '/questions/' + question_image_url[i-1], ques_id))
                
                if option_1_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('A', option1_texts[i-1], ques_id, path_to_image + '/options/' + option_1_image_url[i-1]))
                
                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('A', option1_texts[i-1], ques_id))
                
                if option_2_image_flag:
                
                    sql = 'insert into options(option_label, text, quesid, img) values(%s, %s, %s, %s)'
                    cursor.execute(sql,('B', option2_texts[i-1], ques_id, path_to_image + '/options/' + option_2_image_url[i-1]))

                else:
                    
                    sql = 'insert into options(option_label, text, quesid) values(%s, %s, %s)'
                    cursor.execute(sql,('B', option2_texts[i-1], ques_id))

                # print(type(ques_id), type())
                sql = 'insert into answer(quesid, answer) values(%s, %s)'
                cursor.execute(sql,(ques_id, option_label[answers_texts[i-1]]))
                
            sql = 'select count(*) from questions where quizid = %s'
            cursor.execute(sql,(quiz_id))
            no_of_questions = cursor.fetchall()[0]['count(*)']
            
            sql = 'update quiz set total = %s where quizid = %s'
            cursor.execute(sql,(no_of_questions, quiz_id))
             
        # connection is not autocommit by default. So you must commit to save
        # your changes.
        connection.commit()
        
    finally:
    
        connection.close()
        return True


# In[7]:


def integer_questions(data_frame, quizid, path_to_image):
    
    if 'option1' in data_frame or 'option2' in data_frame or 'option3' in data_frame or 'option4' in data_frame:
        return False
    
    question_numbers = data_frame['question_number']
    question_texts = data_frame['question_text']
    answers_texts = data_frame['answer']
    difficulty = data_frame['question_difficulty']
    quiz_id = quizid
    
    question_image_url = ''
    
    iflag = 0
    if 'question_image_url' in data_frame:
        data_frame['question_image_url'].fillna("No Image", inplace = True)
        question_image_url = data_frame['question_image_url']
        iflag = 1
    
    try:
        with connection.cursor() as cursor:
         
            for i in question_numbers:
                
                q_text = question_texts[i-1]
                sql = 'insert into questions(qnstext, quizid, difficulty_level) values (%s, %s, %s)'
                cursor.execute(sql, (q_text, quiz_id, int(difficulty[i-1])))
                    
                sql = 'select quesid from questions where qnstext = %s and quizid = %s'
                cursor.execute(sql, (q_text, quiz_id))
                
                ques_id = cursor.fetchall()[-1]['quesid']
                
                if iflag:
                    sql = 'update questions set questions_img = %s where quesid = %s'
                    cursor.execute(sql, (path_to_image + '/questions/' + question_image_url[i-1], ques_id))
                
                # print(type(ques_id), type())
                sql = 'insert into answer(quesid, answer) values(%s, %s)'
                cursor.execute(sql,(ques_id, str(answers_texts[i-1])))
                
            sql = 'select count(*) from questions where quizid = %s'
            cursor.execute(sql,(quiz_id))
            no_of_questions = cursor.fetchall()[0]['count(*)']
            
            sql = 'update quiz set total = %s where quizid = %s'
            cursor.execute(sql,(no_of_questions, quiz_id))
             
        # connection is not autocommit by default. So you must commit to save
        # your changes.
        connection.commit()
        
    finally:
    
        connection.close()
        return True


# In[8]:


# def mcq2_questions(data_frame, quizid):
#     question_numbers = data_frame['question_number']
#     question_texts = data_frame['question_text']
#     option1_texts, option2_texts, option3_texts, option4_texts = data_frame['option1'], data_frame['option2'], data_frame['option3'], data_frame['option4']
#     answers_texts = data_frame['answer']
    
#     try:
#         with connection.cursor() as cursor:
         
#             for i in question_numbers:
#                 q_text = question_texts[i-1]
#                 quiz_id = quizid
#                 sql = 'insert into questions(qnstext, quizid) values (%s, %s)'
#                 cursor.execute(sql, (q_text, quiz_id))
                
#                 sql = 'select quesid from questions where qnstext = %s and quizid = %s'
#                 cursor.execute(sql, (q_text, quiz_id))
                
#                 ques_id = cursor.fetchall()[0]['quesid']
                
#                 sql = 'insert into options(option_label, text, quesid) values(%s,  %s, %s)'
#                 cursor.execute(sql,('A', option1_texts[i-1], ques_id))
                
#                 sql = 'insert into options(option_label, text, quesid) values(%s,  %s, %s)'
#                 cursor.execute(sql,('B', option2_texts[i-1], ques_id))
                
#                 # print(type(ques_id), type())
#                 sql = 'insert into answer(quesid, answer) values(%s, %s)'
#                 cursor.execute(sql,(ques_id, option_label[answers_texts[i-1]]))
                 
#                 sql = 'select count(*) from questions where quizid = %s'
#                 cursor.execute(sql,(quiz_id))
#                 no_of_questions = cursor.fetchall()[0]['count(*)']

#                 sql = 'update quiz set total = %s where quizid = %s'
#                 cursor.execute(sql,(no_of_questions, quiz_id))

#         # connection is not autocommit by default. So you must commit to save
#         # your changes.
#         connection.commit()
        
#     finally:
    
#         connection.close()       


# In[9]:


# def integer_questions(data_frame, quizid):
#     question_numbers = data_frame['question_number']
#     question_texts = data_frame['question_text']
#     answers_texts = data_frame['answer']
    
#     try:
#         with connection.cursor() as cursor:
         
#             for i in question_numbers:
#                 q_text = question_texts[i-1]
#                 quiz_id = quizid
#                 sql = 'insert into questions(qnstext, quizid) values (%s, %s)'
#                 cursor.execute(sql, (q_text, quiz_id))
                
#                 sql = 'select quesid from questions where qnstext = %s and quizid = %s'
#                 cursor.execute(sql, (q_text, quiz_id))
                
#                 ques_id = cursor.fetchall()[0]['quesid']
                
#                 # print(type(ques_id), type())
#                 sql = 'insert into answer(quesid, answer) values(%s, %s)'
#                 cursor.execute(sql,(ques_id, str(answers_texts[i-1])))
                 
#                 sql = 'select count(*) from questions where quizid = %s'
#                 cursor.execute(sql,(quiz_id))
#                 no_of_questions = cursor.fetchall()[0]['count(*)']

#                 sql = 'update quiz set total = %s where quizid = %s'
#                 cursor.execute(sql,(no_of_questions, quiz_id))

#         # connection is not autocommit by default. So you must commit to save
#         # your changes.
#         connection.commit()
        
#     finally:
    
#         connection.close()       


# In[10]:


if __name__ == '__main__':
    
    try:
        
        file_name, question_type, quiz_id, path_to_image = sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4]
        
#         file_name = 'L1Verb.csv'
#         question_type = 'mcq4'
#         quiz_id = 61
#         path_to_image = '/'
        
        data_frame = get_data(file_name)
        flag = -1
        
        if question_type == 'mcq2':
            flag = mcq2_questions(data_frame, quiz_id, path_to_image)
        elif question_type == 'mcq4':
            flag = mcq4_questions(data_frame, quiz_id, path_to_image)
        elif question_type == 'int':
            flag = integer_questions(data_frame, quiz_id, path_to_image)
        
        if not flag:
            raise Exception('Invalid CSV Uploaded')
            
    except Exception as error:
        
        print(error)


# In[ ]:




