from jinja2 import Environment, FileSystemLoader
import os
import pymysql
import operator
from collections import OrderedDict
from operator import itemgetter
import sys

def get_attendance_sheet_R1(_school_id, purpose):
    
    # Connect to the database
    connection = pymysql.connect(host='intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com',
                                user='intellifyiitd16',
                                password='dbsolve6june',
                                db='intellify',
                                charset='utf8mb4',
                                cursorclass=pymysql.cursors.DictCursor)


    school_id = _school_id
    if purpose == 'round_2':
        sql = """select B.username, B.firstname, B.lastname, B.class as student_class, B.level as level from school as A, student as B where A.category_id = %s and A.category_id = B.category_id and B.status = 1"""
    elif purpose == 'round_3':
        sql = """select B.username, B.firstname, B.lastname, B.class as student_class, B.level as level from school as A, student as B where A.category_id = %s and A.category_id = B.category_id and B.status = 2"""
    else:
        sql = """select B.username, B.firstname, B.lastname, B.class as student_class, B.level as level from school as A, student as B where A.category_id = %s and A.category_id = B.category_id and (B.status = 0 or B.status = 1 or B.status = 2)"""
    
    try:
        
        with connection.cursor() as cursor:
            cursor.execute(sql, (school_id))
            school_details = cursor.fetchall()

            sql = 'select distinct level from school as A, student as B where A.category_id = B.category_id and A.category_id = %s'
            cursor.execute(sql, (school_id))
            level_list = cursor.fetchall()

            sql = 'select name from school where category_id = %s'
            cursor.execute(sql, (school_id))
            data =  cursor.fetchall()
            if data:
                school_name = data[0]['name']
            else:
                school_name = 'No registered student from your school'

        connection.commit()
    
    except Exception as error:
        print(error)

    finally:
    
        connection.close()

    root = os.path.dirname(os.path.abspath(__file__))
    templates_dir = os.path.join(root, 'templates')
    env = Environment( loader = FileSystemLoader(templates_dir) )
    template = env.get_template('index.html')

    filename = os.path.join(root, 'html', str(school_id) + '.html')
            
    with open(filename, 'w+') as fh:
        
        i = 0    

        level_list = sorted(level_list, key = lambda i: i['level'])
        
        for level in level_list:
        
            student_list  = []    
            for student_detail in school_details:

                if student_detail['level'] == level['level']:
                    student_list.append(student_detail)

            fh.write(template.render(
                school_name = school_name,
                school_id = school_id,
                level = level['level'],
                student_list = student_list
            ))

            i += 1

def get_R1_result_sheet(_school_id):
    
    # Connect to the database
    connection = pymysql.connect(host='localhost',
                                user='root',
                                password='',
                                db='demoedte_intellify',
                                charset='utf8mb4',
                                cursorclass=pymysql.cursors.DictCursor)


    school_id = _school_id
    sql = """select B.username, B.firstname, B.lastname, B.class as student_class, B.level as level from school as A, student as B where A.category_id = %s and A.category_id = B.category_id and B.status = 1"""
    
    try:
        
        with connection.cursor() as cursor:
            cursor.execute(sql, (school_id))
            school_details = cursor.fetchall()

            sql = 'select distinct level from school as A, student as B where A.category_id = B.category_id and A.category_id = %s'
            cursor.execute(sql, (school_id))
            level_list = cursor.fetchall()

            sql = 'select name from school where category_id = %s'
            cursor.execute(sql, (school_id))
            data =  cursor.fetchall()
            if data:
                school_name = data[0]['name']
            else:
                school_name = 'No registered student from your school'

        connection.commit()
    
    except Exception as error:
        print(error)

    finally:
    
        connection.close()

    root = os.path.dirname(os.path.abspath(__file__))
    templates_dir = os.path.join(root, 'templates')
    env = Environment( loader = FileSystemLoader(templates_dir) )
    template = env.get_template('index.html')

    filename = os.path.join(root, 'html', str(school_id) + '.html')
            
    with open(filename, 'w+') as fh:
        
        i = 0    

        level_list = sorted(level_list, key = lambda i: i['level'])
        
        for level in level_list:
        
            student_list  = []    
            for student_detail in school_details:

                if student_detail['level'] == level['level']:
                    student_list.append(student_detail)

            fh.write(template.render(
                school_name = school_name,
                school_id = school_id,
                level = level['level'],
                student_list = student_list
            ))

            i += 1

if __name__ == '__main__':

    school_id = int(sys.argv[1])
    purpose = sys.argv[2]
    get_attendance_sheet_R1(school_id, purpose)