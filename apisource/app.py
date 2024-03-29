import sys
from flask import Flask, jsonify, make_response
from flask_restful import Resource, Api
from flask_restful import reqparse
from flaskext.mysql import MySQL
from flask_cors import CORS

mysql = MySQL()
application = app = Flask(__name__)
CORS(app)

# MySQL configurations
app.config['MYSQL_DATABASE_USER'] = 'intellifyiitd16'
app.config['MYSQL_DATABASE_PASSWORD'] = 'dbsolve6june'
app.config['MYSQL_DATABASE_DB'] = 'quizdb'
app.config['MYSQL_DATABASE_HOST'] = 'intellifydb.cgurwbqxioqu.ap-south-1.rds.amazonaws.com'


mysql.init_app(app)
api = Api(app)

# all-okay
class GetAllResult(Resource):
    
    def get(self, registration_no):
    
        try:
    
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select username, quizid, score, correct, wrong from history where username = %s"
            cursor.execute(sql, (_userRegistrationNo))
            
            # fetch result data from cursor data
            rows = cursor.fetchall()
            no_of_quiz = len(rows)

            # sql query to get result scores
            sql = "select count(*) from intellify.student"
            cursor.execute(sql)
            
            # fetch result data from cursor data
            no_of_students = cursor.fetchall()[0][0]

            result = {}
            for i in range(no_of_quiz):
                
                result[rows[i][1]] = {

                    'total_score': rows[i][2],
                    'correctly_answered': rows[i][3],
                    'incorrectly_answered': rows[i][4]

                }


                field = ['score']
                for col in field:
                    sql = "select username from history where quizid = %s order by " + col + " desc, username asc"
                    _userQuizID = rows[i][1]
                    cursor.execute(sql, (_userQuizID))
                    
                    data = cursor.fetchall()
                    
                    list_ids = [int(id[0]) for id in data]
                    res = list_ids.index(_userRegistrationNo) + 1
                    result[rows[i][1]][col + '_rank'] = res
                    result[rows[i][1]][col + '_percentile'] = (res/no_of_students)*100
            
            if len(result):
                return make_response(jsonify(result), 200)
            else:
                return make_response( jsonify('null'), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay
class GetRound1Result(Resource):
    def get(self, registration_no, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = 'select skill_id, skill_name from quizdb.skill where round = 1'
            cursor.execute(sql)
            skill_list = cursor.fetchall()

            sql = 'select quizid, correct*total as marks from quizdb.quiz where level = %s and belongs_to = 0'
            cursor.execute(sql, (level))
            quiz_data = cursor.fetchall()
            _userQuizID = 0

            if quiz_data:
                _userQuizID = quiz_data[0][0]
            else:
                return make_response(jsonify('No quiz available'), 500)

             # sql query to get result scores
            sql = "select count(*) from intellify.student where level = %s"
            cursor.execute(sql, (level))
            
            # fetch result data from cursor data
            data = cursor.fetchall()
            no_of_students = data[0][0]

            result = {}
            result['score'] = {}
            result['rank'] = {}
            result['percentile'] = {}
            result['total_score'] = {}
            i = 1
            for skill in skill_list:

                total = quiz_data[0][1]
                skill_name = 'skill_' + str(i) + '_score'
                
                sql = "select username, quizid, score, " + skill_name + " from history where username = %s and quizid = %s"
                cursor.execute(sql, (_userRegistrationNo, _userQuizID))
            
                # fetch result data from cursor data
                data = cursor.fetchall()

                if data:

                    result['overall_score'] = data[0][2]
                    result['score'][skill[1]] = data[0][3]
                    result['total_score'][skill[1]] = total
                
                else:

                    result['overall_score'] = 0
                    result['score'][skill[1]] = 0
                    result['total_score'][skill[1]] = total
                i += 1
            
           
                sql = "select username from history where quizid = %s order by " + skill_name + " desc, score desc, username asc"
                cursor.execute(sql, (_userQuizID))

                data = cursor.fetchall()
                list_ids = [int(id[0]) for id in data]
                res = 0
                if int(_userRegistrationNo) in list_ids:
                    res = list_ids.index(int(_userRegistrationNo)) + 1

                result['rank'][skill[1]] = res

                result['percentile'][skill[1]] = 100 - (res/no_of_students)*100         
            
            sql = "select username from history where quizid = %s order by score desc, username asc"
            cursor.execute(sql, (_userQuizID))
            data = cursor.fetchall()
            
            list_ids = [int(id[0]) for id in data]
            res = 0
            if int(_userRegistrationNo) in list_ids:
                res = list_ids.index(_userRegistrationNo) + 1
            
            result['score_rank'] = res

            result['score_percentile'] = 100 - (res/no_of_students)*100         
            
            
            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)


# all-okay
class GetRound2Result(Resource):
    def get(self, registration_no, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)


            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select quizid, correct*total as marks from quizdb.quiz where level = %s and belongs_to = 1'
            cursor.execute(sql, (level))
            quiz_list_data = cursor.fetchall()
            
            # quiz_list = ()
            # for info in quiz_list_data:
            #     quiz_list += (info[0],)
                
            # sql query to get result scores
            sql = "select count(*) from intellify.student where level = %s"
            cursor.execute(sql, (level))
            
            # fetch result data from cursor data
            data = cursor.fetchall()
            no_of_students = data[0][0]

            result = {}
            result['overall_score'] = 0
            result['score'] = {}
            result['rank'] = {}
            result['percentile'] = {}
            result['total_score'] = {}

            # if not quiz_list_data:
            #     return make_response(jsonify('No quiz available'), 200)

            for quiz in quiz_list_data:
                
                sql = 'select score from quizdb.history where username = %s and quizid = %s'
                cursor.execute(sql, (_userRegistrationNo, quiz[0]))

                score = cursor.fetchall()

                if score:
                    result['overall_score'] += score[0][0]
                else:
                    result['overall_score'] += 0

                sql = 'select skill_id from quizdb.quiz where quizid = %s'
                cursor.execute(sql, (quiz[0]))
                skill_id = cursor.fetchall()[0][0]

                sql = 'select skill_name from quizdb.skill where skill_id = %s'
                cursor.execute(sql, (skill_id))
                skill_name = cursor.fetchall()[0][0]

                if score:
                    result['score'][skill_name] = score[0][0]
                else:
                    result['score'][skill_name] = 0
                
                result['total_score'][skill_name] = quiz[1]
                
                # sql = 'select username from quizdb.history as A, quizdb.quiz as B where A.quizid = B.quizid and B.belongs_to = 1 and B.quizid = %s order by skill_' + str(skill_id) + '_score desc, username asc'
                sql = 'select B.username from quizdb.history as B, quizdb.quiz as C, quizdb.skill as D where B.quizid = C.quizid and C.skill_id = D.skill_id and C.quizid = %s order by score desc'
                cursor.execute(sql, (quiz[0]))
                data = cursor.fetchall()

                student_list = []
                for stud in data:
                    student_list.append(stud[0])
                    
                rank = 0
                for info in student_list:
                    if int(info[0]) == _userRegistrationNo:
                        break
                    else:
                        rank += 1

                if str(_userRegistrationNo) in student_list:
                    result['rank'][skill_name] = student_list.index(str(_userRegistrationNo)) + 1
                    result['percentile'][skill_name] = 100 - (result['rank'][skill_name]/no_of_students)*100
                else:
                    result['rank'][skill_name] = 0
                    result['percentile'][skill_name] = 100
                
            sql = 'select distinct A.username from quizdb.history as A, intellify.student as B where A.username = B.username and B.level = %s'
            cursor.execute(sql, (level))
            rows = cursor.fetchall()

            list_ids = []
            for student in rows:
                list_ids.append(int(student[0]))
            
            score = {}
            for student in list_ids:

                if len(quiz_list_data) == 1:
                    sql = 'select avg(score) from quizdb.history where username = %s and quizid = ' + str(quiz_list_data[0][0])
                elif len(quiz_list_data):
                    quiz_list = ()
                    for q in quiz_list_data:
                        quiz_list += (q[0],) 
                    sql = 'select avg(score) from quizdb.history where username = %s and quizid in ' + str(quiz_list)

                print(sql)
                cursor.execute(sql, (student))
                data2 = cursor.fetchall()
                if data2:
                    score[student] = round(data2[0][0])
                else:
                    score[student] = 0

            import operator
            student_list = sorted(score.items(), key=operator.itemgetter(1), reverse = True)
            
            rank = 0
            for info in student_list:
                if info[0] == _userRegistrationNo:
                    break
                else:
                    rank += 1
                
            result['overall_rank'] = rank + 1

            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)


# alter - R1 / R2 and skill --> not in use currently
class GetSkillScores(Resource):
    def get(self, registration_no, quiz_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no) #int(args['registration_no'])
            _userQuizID = int(quiz_id) #int(args['quiz_id'])

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select username, quizid, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score from history where username = %s and quizid = %s"
            cursor.execute(sql, (_userRegistrationNo, _userQuizID))
            
            # fetch result data from cursor data
            data = cursor.fetchall()
            data = data[0]


            result = {
                'resgistration_number': data[0],
                'quiz_id': data[1],
                'skill_1_score': data[2],
                'skill_2_score': data[3],
                'skill_3_score': data[4],
                'skill_4_score': data[5],
                'skill_5_score': data[6]
            }
            
            # sql query to get result scores
            sql = "select count(*) from intellify.student"
            cursor.execute(sql)
            
            # fetch result data from cursor data
            data = cursor.fetchall()
            no_of_students = data[0][0]

            field = ['skill_1_score', 'skill_2_score', 'skill_3_score', 'skill_4_score', 'skill_5_score']
            for col in field:
                sql = "select username from history where quizid = %s order by " + col + " desc, score desc, username asc"
                cursor.execute(sql, (_userQuizID))

                data = cursor.fetchall()
                list_ids = [int(id[0]) for id in data]
                res = list_ids.index(_userRegistrationNo) + 1
                result[col + '_rank'] = res

                result[col + '_proficiency'] = (res/no_of_students)*100         
            
            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay
class GetPerformanceChart(Resource):
    def get(self, registration_no):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no) #int(args['registration_no'])

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select quiz.title, history.score, quiz.total*quiz.correct as marks from history, quiz where username=%s and quiz.quizid = history.quizid;"
            cursor.execute(sql, (_userRegistrationNo))
            
            # fetch result data from cursor data
            data = cursor.fetchall()
            
            chart = {}
            chart['x'] = []
            chart['y'] = []
            for stat in data:
                chart['x'].append(stat[0])
                if stat[2]:
                    chart['y'].append(round((stat[1]/stat[2])*100))
                else:
                    chart['y'].append(0)

            return make_response(jsonify(chart), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)        

# all-okay
class GetSkills(Resource):
    def get(self, round):
        try:
            conn = mysql.connect()
            cursor = conn.cursor()

            if round == 'all':
                sql = 'select skill_id, skill_name from quizdb.skill'
                cursor.execute(sql)
            else:
                sql = 'select skill_id, skill_name from quizdb.skill where round = %s'
                cursor.execute(sql, (round))

            data = cursor.fetchall()

            result = {}
            for info in data:
                result[info[0]] = info[1]
            
            return make_response(jsonify(result), 200)
        
        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay
class GetSkillPerformanceChart(Resource):
    def get(self, registration_no, skill_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)
            _skill_id = int(skill_id)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            #sql = "select quiz.title, history.skill_" + str(skill_number) + "_score from history, quiz where username = %s and quiz.quizid = history.quizid;"
            sql = 'select B.title, A.score from quizdb.history as A, quizdb.quiz as B, quizdb.skill as C where username = %s and B.quizid = A.quizid and B.skill_id = C.skill_id and C.skill_id = %s'
            cursor.execute(sql, (_userRegistrationNo, _skill_id))
            
            # fetch result data from cursor data
            # data = cursor.fetchall()
            
            data = cursor.fetchall()
            
            chart = {}
            chart['x'] = []
            chart['y'] = []
            for stat in data:
                
                chart['x'].append(stat[0])
                chart['y'].append(stat[1])

            return make_response(jsonify(chart), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)        

# all-okay
class GetOverallScore(Resource):
    
    def get(self, registration_no):
    
        try:
    
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select avg(score) from quizdb.history where username = %s"
            cursor.execute(sql, (_userRegistrationNo))
            
            # fetch result data from cursor data
            rows = cursor.fetchall()

            if rows[0][0]:
                result = {
                    'overall_average_score' : round(rows[0][0])
                }
            else:
                result = {
                    'overall_average_score' : 0
                }  
            
            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay
class GetOverAllRank(Resource):
    def get(self, registration_no, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select distinct A.username from quizdb.history as A, intellify.student as B where A.username = B.username and B.level = %s'
            cursor.execute(sql, (_level))
            rows = cursor.fetchall()
            
            list_ids = []
            for student in rows:
                list_ids.append(int(student[0]))
            
            score = {}
            for student in list_ids:
                sql = 'select avg(score) from quizdb.history where username = %s'
                cursor.execute(sql, (student))
                score[student] = round(cursor.fetchall()[0][0])

            import operator
            student_list = sorted(score.items(), key=operator.itemgetter(1), reverse = True)
            
            rank = 1
            flag = 0
            for info in student_list:
                if info[0] == _userRegistrationNo:
                    flag = 1
                    break
                else:
                    rank += 1
            
            if flag:
                result = { 'overall_rank': rank }
            else:
                result = { 'overall_rank': '-' }

            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)      

# all-okay - overall profile
class GetOverallSkillScores(Resource):
    def get(self, registration_no, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round != 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()

            result = {}
            for skill in skill_data:
                
                score = 0
                total_marks = 0

                sql = 'select quizid, total*correct as marks from quizdb.quiz where skill_id = %s and level = %s'
                cursor.execute(sql, (skill[0], level))
                quiz_data = cursor.fetchall()

                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],) 

                if quiz_data:
                    total_marks += quiz_data[0][1]

                for quiz in quiz_list:
                    sql = 'select score from quizdb.history where quizid = %s and username = %s'
                    cursor.execute(sql, (quiz, _userRegistrationNo))
                    skill_score = cursor.fetchall()

                    if skill_score:
                        score += skill_score[0][0]
                
                if total_marks:
                    result[skill[1]] = str(score/total_marks)
                else:
                    result[skill[1]] = '0'


            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round = 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()

            i = 1
            for skill in skill_data:
                
                # print(skill[0], level)
                # sql = "select skill_" + str(skill) + " from user_performance where username = %s"
                score = 0
                total_marks = 0
                
                sql = 'select quizid, total*correct as marks from quizdb.quiz where skill_id is NULL and level = %s'
                cursor.execute(sql, (level))
                quiz_data = cursor.fetchall()

                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],)
                
                if quiz_data:
                    total_marks = quiz_data[0][1]

                sql = 'select skill_' + str(i) + '_score from history where username = %s and quizid = %s'
                cursor.execute(sql, (_userRegistrationNo, quiz_list[0]))
                rows = cursor.fetchall()

                if rows and total_marks:
                    result[skill[1]] = str(rows[0][0]/total_marks)
                else:
                    result[skill[1]] = '0'
                i += 1

            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)         

# okay - overall profile - ASK
class GetOverAllSkillRanks(Resource):
    def get(self, registration_no, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _userRegistrationNo = int(registration_no)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()
            
            sql ='select distinct username from intellify.student where level = %s'
            cursor.execute(sql, (_level))
            student_data = cursor.fetchall()
            
            student_list = []
            for info in student_data:
                student_list.append(info[0])
            
            total_students = len(student_data)

            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round != 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()
            
            result = {}
            result['rank'] = {}
            result['percentile'] = {}
            
            for skill in skill_data:
                
                # sql = "select skill_" + str(skill) + " from user_performance where username = %s"
                sql = 'select quizid from quizdb.quiz where skill_id = %s and level = %s'
                cursor.execute(sql, (skill[0], level))
                quiz_data = cursor.fetchall()
                
                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],)
                
                
                score = {}
                
                for student in student_list:
                    
                    if type(student) == tuple:
                        student = student[0]

                    if len(quiz_list) == 1:
                        sql = 'select avg(score) from quizdb.history where username = %s and quizid = ' + str(quiz_list[0])
                    elif len(quiz_list) == 0:
                        score[student] = 0
                        continue
                    else:
                        sql = 'select avg(score) from quizdb.history where username = %s and quizid in ' + str(quiz_list)

                    cursor.execute(sql, (int(student)))
                    stud_score = cursor.fetchall()[0][0]
                    if stud_score:
                        score[student] = round(stud_score)

                import operator
                student_list = sorted(score.items(), key=operator.itemgetter(1), reverse = True)

                rank = 0
                for info in student_list:
                    if int(info[0]) == _userRegistrationNo:
                        break
                    else:
                        rank += 1

                result['rank'][skill[1]] = rank + 1
                result['percentile'][skill[1]] = 1- result['rank'][skill[1]]/total_students

                # if result['percentile'][skill[1]] <= 2:
                #     result['rank'][skill[1]] = '-'
                #     result['percentile'][skill[1]] = '-'

            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round = 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()
            
            i = 1
            for skill in skill_data:
                
                # sql = "select skill_" + str(skill) + " from user_performance where username = %s"
                sql = 'select quizid from quizdb.quiz where skill_id is NULL and level = %s'
                cursor.execute(sql, (level))
                quiz_data = cursor.fetchall()
                
                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],)

                score = {}
                for student in student_list:
                    
                    if type(student) == tuple:
                        student = student[0]

                    sql = 'select skill_' + str(i) + '_score from quizdb.history where username = %s and quizid = %s'

                    cursor.execute(sql, (int(student), quiz_list[0]))
                    stud_score = cursor.fetchall()
                    
                    if stud_score:
                        score[student] = round(stud_score[0][0])
                    else:
                        score[student] = 0

                import operator
                student_list = sorted(score.items(), key=operator.itemgetter(1), reverse = True)

                rank = 0
                for info in student_list:
                    if int(info[0]) == _userRegistrationNo:
                        break
                    else:
                        rank += 1

                result['rank'][skill[1]] = rank + 1
                result['percentile'][skill[1]] = 1- result['rank'][skill[1]]/total_students
                i += 1

                # if result['percentile'][skill[1]] <= 1:
                #     result['rank'][skill[1]] = '-'
                #     result['percentile'][skill[1]] = '-'

            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - admin
class GetWrongOmr(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _school_id = school_id

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select student_id, error_type from quizdb.wrong_omr where school_id = %s'
            cursor.execute(sql, (_school_id))
            rows = cursor.fetchall()

            return make_response(jsonify(rows), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - admin
class SetHistory(Resource):
    def post(self):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # call to procedures
            try:
                sql = 'SELECT A.username, A.quesid, C.quizid, A.flag from user_answer as A, questions as B, quiz as C where A.quesid = B.quesid and B.quizid = C.quizid and C.belongs_to = 1'
                cursor.execute(sql)

                user_answer_details = cursor.fetchall()
                
                students_list = []
                for info in user_answer_details:
                    if info[0] not in students_list:
                        students_list.append(info[0])

                # print(user_answer_details)

                sql = 'select skill_id from quizdb.skill where skill_id != 0'
                cursor.execute(sql)
                skill_data = cursor.fetchall()

                skill_list = []
                for info in skill_data:
                    skill_list.append(info[0])
                
                for student in students_list:

                    quiz_attempted = []
                    for info in user_answer_details:
                        if info[0] == student:
                            if info[2] not in quiz_attempted:
                                quiz_attempted.append(info[2])

                    # print(quiz_attempted)

                    for quiz in quiz_attempted:
                        
                        correct_count = 0
                        wrong_count = 0
                        score = 0

                        for info in user_answer_details:

                            if info[2] == quiz and info[0] == student:

                                if info[3] == 1:
                                    correct_count += 1
                                elif info[3] == -1:
                                    wrong_count += 1
                                else:
                                    pass
                        
                        # print(student, quiz, score)

                        sql_skill = 'select skill_id, correct, wrong from quiz where quizid = %s'
                        cursor.execute(sql_skill, (quiz))

                        data = cursor.fetchall()

                        # skill_id = data[0][0]
                        correct_marks = data[0][1]
                        incorrect_marks = data[0][2]

                        score = correct_marks*correct_count - incorrect_marks*wrong_count

                        sql2 = 'update history set correct = %s, wrong = %s, score = %s where username = %s and quizid = %s'
                        cursor.execute(sql2, (correct_count, wrong_count, score, student, quiz))
                        
                        # for skill in skill_list:
                            
                        #     if skill == skill_id:

                        #         sql = 'update history set skill_' + str(skill) + '_score = %s where username = %s and quizid = %s'
                        #         cursor.execute(sql, (score, quiz))
                            
                        #     else:

                        #         sql = 'update history set skill_' + str(skill) + '_score = %s where username = %s and quizid = %s'
                        #         cursor.execute(sql, (0, quiz))

                conn.commit()
                return make_response(jsonify('recorded'), 200)

            except Exception as error:
                
                return make_response(jsonify(error), 500)

        except Exception as error:

            return make_response(jsonify(error), 500)

# # alter - skill --> not in use
# class SetPerformance(Resource):
#     def post(self):
#         try:
#             # parse arguments
#             # parser = reqparse.RequestParser()
#             # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
#             # args = parser.parse_args()
            
#             # if not AUTHENTICATION(args['apikey']):
#             #     return { 'auth_status': 'denied' }

#             # connect to database
#             conn = mysql.connect()
#             cursor = conn.cursor()

#             sql = 'select skill_id from quizdb.skill where skill_id != 0'
#             cursor.execute(sql)
#             skill_data = cursor.fetchall()

#             skill_list = []
#             for info in skill_data:
#                 skill_list.append(info[0])
                    
#             try:
                
#                 sql = 'select distinct username from history'
#                 cursor.execute(sql)

#                 data = cursor.fetchall()

#                 student_list = []
#                 for info in data:
#                     student_list.append(info[0])
                
#                 for student in student_list:

#                     sql = 'INSERT INTO user_performance (username, score, quiz_attempted) select username, avg(score) as score, count(*) as quiz_attempted from history where username = %s'
#                     cursor.execute(sql, (stduent))

#                     for skill in skill_list:

#                         sql = 'update user_performance set skill_' + str(skill) + ' = avg(skill_' + str(skill) +'_score) as skill_' + str(skill) + ' from history where username = %s'
                    
#                         cursor.execute(sql, (student))
                
#             except:
            
#                 sql = 'select distinct username from history'
#                 cursor.execute(sql)

#                 data = cursor.fetchall()

#                 student_list = []
#                 for info in data:
#                     student_list.append(info[0])
                
#                 for student in student_list:

#                     sql = """update user_performance
#                             set
#                             score = (select avg(score) from history where username = %s),
#                             quiz_attempted = (select count(*) from history where username = %s)
#                             where username = %s"""
#                     cursor.execute(sql, (student))

#                     for skill in skill_list:

#                         sql = 'update user_performance set skill_' + str(skill) + ' = avg(skill_' + str(skill) +'_score) as skill_' + str(skill) + ' from history where username = %s'
#                         cursor.execute(sql, (student))
            
#             conn.commit()
#             return make_response(jsonify('updated'), 200)
            
#         except Exception as error:

#             return make_response(jsonify(error), 500)         

# # alter - skill - not in use
# class SetHistoryPractice(Resource):
#     def post(self, registration_no, quiz_id, skill_id):
#         try:
#             # parse arguments
#             # parser = reqparse.RequestParser()
#             # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
#             # args = parser.parse_args()
            
#             # if not AUTHENTICATION(args['apikey']):
#             #     return { 'auth_status': 'denied' }

#             # store arguments
#             _userRegistrationNo = int(registration_no)
#             _quiz_id = int(quiz_id)
#             _skill_id = int(skill_id)

#             # connect to database
#             conn = mysql.connect()
#             cursor = conn.cursor()

#             # call to procedures
#             try:
#                 sql = 'select count(*) from user_answer as A, questions as B where A.quesid = B.quesid and username = %s and quizid = %s and flag = 1'
#                 cursor.execute(sql, (_userRegistrationNo, _quiz_id))

#                 data = cursor.fetchall()[0][0]
                
#                 if not data:
#                     return {'error: ': 'no record in user_answer_table for given student'}

#                 score = data * 4
#                 skill_score = score

#                 sql2 = ''
#                 if _skill_id == 1:
#                     sql2 = 'insert into history(username, score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score) values (%s,%s,%s,0,0,0,0)'
#                 elif _skill_id == 2:
#                     sql2 = 'insert into history(username, score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score) values (%s,%s,0,%s,0,0,0)'
#                 elif _skill_id == 3:
#                     sql2 = 'insert into history(username, score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score) values (%s,%s,0,0,%s,0,0)'
#                 elif _skill_id == 4:
#                     sql2 = 'insert into history(username, score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score) values (%s,%s,0,0,0,%s,0)'
#                 elif _skill_id == 5:
#                     sql2 = 'insert into history(username, score, skill_1_score, skill_2_score, skill_3_score, skill_4_score, skill_5_score) values (%s,%s,0,0,0,0,%s)'
                
#                 # print(sql2, score, skill_score)
#                 cursor.execute(sql2, (_userRegistrationNo, score, skill_score))
		
#                 conn.commit()
#                 return make_response(jsonify('inserted'), 200)

#             except Exception as error:
                
#                 return make_response(jsonify(error), 500)

#         except Exception as error:

#             return make_response(jsonify(error), 500)         

# # alter - skill - not in use
# class SetPerformancePractice(Resource):
#     def post(self, registration_no):
#         try:
#             # parse arguments
#             # parser = reqparse.RequestParser()
#             # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
#             # args = parser.parse_args()
            
#             # if not AUTHENTICATION(args['apikey']):
#             #     return { 'auth_status': 'denied' }

#             # store arguments
#             _userRegistrationNo = int(registration_no)

#             # connect to database
#             conn = mysql.connect()
#             cursor = conn.cursor()

#             # call to procedures
#             try:
#                 cursor.callproc('populate_scores', (str(_userRegistrationNo),))
#             except:
#                 cursor.callproc('update_scores', (str(_userRegistrationNo),))

#             conn.commit()
#             return make_response(jsonify('updated'), 200)

#         except Exception as error:

#             return make_response(jsonify(error), 500)          

# all-okay - admin
class AddStudent(Resource):
    def post(self):
        try:
            # parse arguments
            parser = reqparse.RequestParser()
            parser.add_argument('school_id', type=str, help='School ID')
            parser.add_argument('first_name', type=str, help='First Name')
            parser.add_argument('last_name', type=str, help='Last Name')
            parser.add_argument('level', type=str, help='Level')
            parser.add_argument('stud_class', type=str, help='Class')
            parser.add_argument('email', type=str, help='Email')
            parser.add_argument('contact', type=str, help='Contact')
            args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _school_id = int(args['school_id'])
            _first_name = args['first_name']
            _last_name = args['last_name']
            _username = ''
            _userRegistrationNo = ''
            _level = args['level']
            _stud_class = int(args['stud_class'])
            _email = args['email']
            _contact = args['contact']

            if _level not in range(0,4):
                return { 'error' : 'incorrect-level' }
            
            if _stud_class not in range(5, 13):
                return { 'error' : 'incorrect-class' }

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # call to sql
            sql = 'select count(*) from intellify.student where category_id = %s'
            cursor.execute(sql, (_school_id))

            count = cursor.fetchall()[0][0]

            if len(_school_id) == 2:
                _school_id = '600' + _school_id
            elif len(_school_id) == 2:
                _school_id = '60' + _school_id
            else:
                _school_id = '6' + _school_id

            if count < 100:
                _username = _userRegistrationNo = str(_school_id) + '0' + str(count)
            else:
                _username = _userRegistrationNo = str(_school_id) + str(count)


            sql = 'insert into intellify.student (category_id, firstname, lastname, username, registrationno, level, class, email, mobile, status) values(%s,%s,%s,%s,%s,%s,%s,%s,%s, %s)'
            cursor.execute(sql, (_school_id, _first_name, _last_name, _username, _userRegistrationNo, _level, _stud_class, _email, _contact, -1))
            
            conn.commit()
            return make_response(jsonify('inserted'), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)          

# all-okay - school
class GetSchoolAverageSkillScore(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)
            #_level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0'
            cursor.execute(sql)
            skill_data = cursor.fetchall()
                
            average_skill_scores = {}
            average_skill_scores['scores'] = {}
            average_skill_scores['total_scores'] = {}

            for skill in skill_data:
                
                total_score = 0
                # sql = "select skill_" + str(skill) + " from user_performance where username = %s"
                sql = 'select quizid, correct*total as marks from quizdb.quiz where skill_id = %s'
                cursor.execute(sql, (skill[0]))
                quiz_data = cursor.fetchall()

                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],)
                
                # sql query to get result scores
                if len(quiz_list) == 1:
                    sql = "select avg(score) from intellify.student as I, quizdb.history as E where I.category_id = %s and I.username = E.username and E.quizid = " + str(quiz_list[0])
                    total_score = quiz_data[0][1]
                elif len(quiz_list) == 0:
                    average_skill_scores['scores'][skill[1]] = 0
                    for quiz in quiz_data:
                        total_score += quiz[1]
                    average_skill_scores['total_scores'][skill[1]] = total_score        
                    continue
                else:
                    sql = "select avg(score) from intellify.student as I, quizdb.history as E where I.category_id = %s and I.username = E.username and E.quizid in " + str(quiz_list)
                    for quiz in quiz_data:
                        total_score += quiz[1]

                cursor.execute(sql, (_schoolID))
                
                # fetch result data from cursor data
                data = cursor.fetchall()[0][0]
                
                if data:
                    average_skill_scores['scores'][skill[1]] = round(data)
                    average_skill_scores['total_scores'][skill[1]] = total_score        
                else:
                    average_skill_scores['scores'][skill[1]] = 0
                    average_skill_scores['total_scores'][skill[1]] = total_score        

            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round = 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()
            
            i = 1
            for skill in skill_data:
                
                sql = 'select quizid, correct*total as marks from quizdb.quiz where skill_id is NULL'
                cursor.execute(sql)
                quiz_data = cursor.fetchall()

                quiz_list = ()
                for qinfo in quiz_data:
                    quiz_list += (qinfo[0],)
                
                # sql query to get result scores
                sql = 'select avg(A.skill_' + str(i) + '_score) from history as A, intellify.student as B where A.username = B.username and B.category_id = %s and A.quizid in %s'
                cursor.execute(sql, (_schoolID, quiz_list))
                
                # fetch result data from cursor data
                data = cursor.fetchall()[0][0]
                
                if data:
                    average_skill_scores['scores'][skill[1]] = round(data)
                    for quiz in quiz_data:
                        average_skill_scores['total_scores'][skill[1]] = quiz[1]
                else:
                    average_skill_scores['scores'][skill[1]] = 0    
                    for quiz in quiz_data:
                        average_skill_scores['total_scores'][skill[1]] = quiz[1]
                i += 1            
            
            return make_response(jsonify(average_skill_scores), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - overall - school
class GetSchoolAverageScore(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)
            #_level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select avg(score) from intellify.student as I, quizdb.history as E where I.category_id = %s and I.username = E.username"
            
            cursor.execute(sql, (_schoolID))
            
            # fetch result data from cursor data
            data = cursor.fetchall()[0][0]

            if data:
                average_score = { 'average_score' :  round(data) }
            else:
                average_score = { 'average_score' :  0 }
            
            return make_response(jsonify(average_score), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# class HistogramR1(Resource):
#     def get(self, school_id, level):
        
#         try :

#             # connect to database
#             conn = mysql.connect()
#             cursor = conn.cursor()
#             sql = 'select username from intellify.student where category_id = %s and level = %s'
#             cursor.execute(sql, (school_id, level))
#             student_data = cursor.fetchall()

#             x = [ i for i in range(0, 101, 10)]
#             percentage_list = {}

#             sql = 'select quizid, correct, total from quizdb.quiz where belongs_to = 0 and level = %s'
#             cursor.execute(sql, (level))
#             quiz_data = cursor.fetchall()

#             quiz_list = {}
#             for quiz in quiz_data:
#                 quiz_list[quiz[0]] = quiz[1] * quiz[2]
            
#             quizid = list(quiz_list.keys())[0]
#             total_score = quiz_list[quizid]
#             for student in student_data:
#                 sql = 'select score from quizdb.history where username = %s and quizid = %s'
#                 cursor.execute(sql, (student[0], quizid))
#                 score = cursor.fetchall()

#                 if score:
#                     percentage_list[student[0]] = round((score[0][0]/total_score)*100)
#                 else:
#                     percentage_list[student[0]] = 0

#             y = [ 0 for x in range(10)]
            
#             for student in percentage_list:
#                 if percentage_list[student] in range(0, 11):
#                     y[0] += 1
#                 elif percentage_list[student] in range(10, 21):
#                     y[1] += 1
#                 elif percentage_list[student] in range(20, 31):
#                     y[2] += 1
#                 elif percentage_list[student] in range(30, 41):
#                     y[3] += 1
#                 elif percentage_list[student] in range(40, 51):
#                     y[4] += 1
#                 elif percentage_list[student] in range(50, 61):
#                     y[5] += 1
#                 elif percentage_list[student] in range(60, 71):
#                     y[6] += 1
#                 elif percentage_list[student] in range(70, 81):
#                     y[7] += 1
#                 elif percentage_list[student] in range(80, 91):
#                     y[8] += 1
#                 elif percentage_list[student] in range(90, 101):
#                     y[9] += 1

#             return make_response(jsonify(x, y), 200)
            
#         except Exception as error:

#             return make_response(jsonify(error), 500)

class Histogram(Resource):
    def get(self, school_id, level, purpose):
        
        try :
            
            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()
            
            x = [ i for i in range(0, 101, 10)]
            percentage_list = {}

            sql1= ''
            sql2 = ''
            if purpose == 'R1':
                sql1 = 'select quizid, correct, total from quizdb.quiz where belongs_to = 0 and level = %s'
                sql2 = 'select username from intellify.student where category_id = %s and level = %s'
            elif purpose == 'R2':
                sql1 = 'select quizid, correct, total from quizdb.quiz where belongs_to = 1 and level = %s'
                sql2 = 'select username from intellify.student where category_id = %s and level = %s and status = 1'
            elif purpose == 'Overall':
                sql1 = 'select quizid, correct, total from quizdb.quiz where level = %s'
                sql2 = 'select username from intellify.student where category_id = %s and level = %s'
            
            cursor.execute(sql2, (school_id, level))
            student_data = cursor.fetchall()

            cursor.execute(sql1, (level))
            quiz_data = cursor.fetchall()

            quiz_list = {}
            for quiz in quiz_data:
                quiz_list[quiz[0]] = quiz[1] * quiz[2]
            
            total_score = sum(quiz_list.values())
            for student in student_data:
                
                overall_score = 0
                for quiz in quiz_list:
                    sql = 'select score from quizdb.history where username = %s and quizid = %s'
                    cursor.execute(sql, (student[0], quiz))
                    score = cursor.fetchall()

                    if score:
                        overall_score += score[0][0]
                    else:
                        overall_score += 0

                if total_score:
                    percentage_list[student[0]] = round((overall_score/total_score)*100)
                else:
                    percentage_list[student[0]] = 0

            y = [ 0 for x in range(10)]
            
            for student in percentage_list:
                if percentage_list[student] in range(0, 11):
                    y[0] += 1
                elif percentage_list[student] in range(10, 21):
                    y[1] += 1
                elif percentage_list[student] in range(20, 31):
                    y[2] += 1
                elif percentage_list[student] in range(30, 41):
                    y[3] += 1
                elif percentage_list[student] in range(40, 51):
                    y[4] += 1
                elif percentage_list[student] in range(50, 61):
                    y[5] += 1
                elif percentage_list[student] in range(60, 71):
                    y[6] += 1
                elif percentage_list[student] in range(70, 81):
                    y[7] += 1
                elif percentage_list[student] in range(80, 91):
                    y[8] += 1
                elif percentage_list[student] in range(90, 101):
                    y[9] += 1

            return make_response(jsonify(x, y), 200)
            
        except Exception as error:

            return make_response(jsonify(error), 500)


class GetSchoolRank(Resource):
    def get(self, school_id):

        # connect to database
        conn = mysql.connect()
        cursor = conn.cursor()
        
        sql = 'select distinct category_id from intellify.school'
        cursor.execute(sql)
        data = cursor.fetchall()

        scores = {}
        for school in data:
            # sql query to get result scores
            sql = "select avg(score) from intellify.student as I, quizdb.history as E where I.category_id = %s and I.username = E.username"
            
            cursor.execute(sql, (school[0]))
            
            # fetch result data from cursor data
            data = cursor.fetchall()[0][0]

            if data:
                scores[school[0]] = round(data)
            else:
                scores[school[0]] = 0
        
        import operator
        school_list = sorted(scores.items(), key=operator.itemgetter(1), reverse = True)
        
        rank = 0
        for info in school_list:
            if info[0] == int(school_id):
                break
            else:
                rank += 1
                
        result = { 'overall_rank' : rank + 1}
        return make_response(jsonify(result), 200)
            
# okay - olympiad -- not in use currently
class GetOlympiadAverageSkillScore(Resource):
    def get(self, level, skill):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _skill = int(skill)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            skill_types = {1:'skill_1_score', 2:'skill_2_score', 3:'skill_3_score', 4:'skill_4_score', 5:'skill_5_score'}
            _skill_name = skill_types[int(skill)]
            
            # sql query to get result scores
            sql = "select " + _skill_name + " from intellify.student as I, quizdb.history as E where I.level = %s and I.username = E.username"
            
            cursor.execute(sql, (_level))
            
            # fetch result data from cursor data
            data = cursor.fetchall()

            scores = []
            for score in data:
               scores.append(score[0])
            
            if len(scores) == 0:
                average_score = { 'olympiad_average_' + _skill_name : 0 }
            else:
                average_score = { 'olympiad_average_' + _skill_name : sum(scores)//len(scores) }

            return make_response(jsonify(average_score), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - school overall
class GetParticipants(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            levels = ['0', '1', '2', '3']
            
            res = {}
            res['level_labels'] = []
            res['participants'] = []
            res['qualified'] = []
            res['qualified_for_round_3'] = []

            for level in levels:

                res['level_labels'].append('Level ' + str(level))

                # sql query to get result scores
                sql = "select count(*) from intellify.student where category_id = %s and level = %s"
                
                cursor.execute(sql, (_schoolID, level))
                
                # fetch result data from cursor data
                data = cursor.fetchall()[0][0]

                res['participants'].append(data)

                # sql query to get result scores
                sql = "select username from intellify.student where category_id = %s and level = %s and status = 1"
                cursor.execute(sql, (_schoolID, level))
                
                # fetch result data from cursor data
                data = cursor.fetchall()

                res['qualified'].append(len(data))

                # sql query to get result scores
                sql = "select username from intellify.student where category_id = %s and level = %s and status = 2"
                cursor.execute(sql, (_schoolID, level))
                
                # fetch result data from cursor data
                data = cursor.fetchall()

                res['qualified_for_round_3'].append(len(data))

            return make_response(jsonify(res), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - school
class GetLeaderBoard(Resource):
    def get(self, school_id, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            # sql = 'SELECT A.username, A.score from user_performance as A, intellify.student as B where B.username = A.username and category_id = %s and level = %s order by A.score desc limit 5;'
            sql = "select E.username, score from quizdb.history as I, intellify.student as E where E.category_id = %s and E.level = %s and I.username = E.username order by I.score desc, E.username asc limit 5"
            cursor.execute(sql, (_schoolID, _level))
            
            # fetch result data from cursor data
            data_x = cursor.fetchall()

            sql = 'select distinct A.username from quizdb.history as A, intellify.student as B where A.username = B.username and B.level = %s'
            cursor.execute(sql, (_level))
            rows = cursor.fetchall()
            
            list_ids = []
            for student in rows:
                list_ids.append(int(student[0]))
            
            score = {}
            for student in list_ids:
                sql = 'select avg(score) from quizdb.history where username = %s'
                cursor.execute(sql, (student))
                score[student] = round(cursor.fetchall()[0][0])

            import operator
            student_list = sorted(score.items(), key=operator.itemgetter(1), reverse = True)
            
            leaderboard = []
            i = 1
            for student in data_x:
                leaderboard_instance = {}
                leaderboard_instance['username'] = student[0]
                # leaderboard_instance['score'] = student[1]
                rank = 1
                flag = 0
                for info in student_list:
                    if info[0] == int(student[0]):
                        flag = 1
                        break
                    else:
                        rank += 1
                
                if flag and student_list:
                    leaderboard_instance['percentile'] = rank / len(student_list)
                    leaderboard_instance['rank'] = rank
                else:
                    leaderboard_instance['percentile'] = 100
                    leaderboard_instance['rank'] = 'NA'

                leaderboard.append(leaderboard_instance)
                i += 1

            if len(leaderboard) < 5 and len(leaderboard) > 0:

                for i in range(5 - 5%len(leaderboard)):

                    leaderboard_instance = {}
                    leaderboard_instance['username'] = '-'
                    leaderboard_instance['percentile'] = '-'
                    leaderboard_instance['rank'] = '-'
                    leaderboard.append(leaderboard_instance)

            return make_response(jsonify(leaderboard), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - school - not in use currently
class GetQualifiedStudents(Resource):
    def get(self, school_id, level):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)
            _level = int(level)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            # sql query to get result scores
            sql = "select username from intellify.student where category_id = %s and level = %s and status = 1"
            
            cursor.execute(sql, (_schoolID, _level))
            
            # fetch result data from cursor data
            data = cursor.fetchall()

            qualified_students = []
            for stud in data:
                qualified_students.append(stud[0])

            return make_response(jsonify(qualified_students), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - admin
class SetQualificationThreshold(Resource):
    def post(self, school_id, level, percentage):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # store arguments
            _schoolID = int(school_id)
            _level = int(level)
            _percent = float(percentage)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()
            
            # sql query to get result scores
            sql = "select count(*) from intellify.student where category_id = %s and level = %s"
            cursor.execute(sql, (_schoolID, _level))
            no_of_participants = int(cursor.fetchall()[0][0])

            # sql query to get result scores
            _limit = int(no_of_participants*(_percent/100)) + 1
            sql = "select E.username, score from quizdb.history as I, intellify.student as E where E.category_id = %s and E.level = %s and I.username = E.username order by score desc limit %s"
            
            cursor.execute(sql, (_schoolID, _level, _limit))
            
            # fetch result data from cursor data
            data = cursor.fetchall()

            for student in data:
                sql = 'update intellify.student set status = 1 where registrationno = %s'
                cursor.execute(sql, (student[0]))

            conn.commit()
            return make_response(jsonify('updated'), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - admin
class SetQualifications(Resource):
    def post(self):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }
            
            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql =  'select distinct category_id from intellify.student'
            cursor.execute(sql)
            data = cursor.fetchall()
            
            school_list = []
            for school in data:
                school_list.append(school[0])

            for _schoolID in school_list:
            
                sql = 'select distinct level from intellify.student where category_id = %s'
                cursor.execute(sql, (_schoolID))

                levels = cursor.fetchall()
                level_list = []
                for level in levels:
                    level_list.append(level)
                
                for _level in level_list:
               
                    # sql query to get result scores
                    sql = "select score from intellify.student as I, quizdb.history as E where I.category_id = %s and I.level = %s and I.username = E.username"
                    
                    cursor.execute(sql, (_schoolID, _level))
                    
                    # fetch result data from cursor data
                    data = cursor.fetchall()

                    scores = []
                    for score in data:
                        scores.append(score[0])
                    
                    if len(scores) != 0:
                        average_score = sum(scores)//len(scores)
                    else:
                        continue

                    if average_score > 40:

                        sql = 'select I.username from intellify.student as I, quizdb.history as E where I.category_id = %s and I.level = %s and E.score >= %s and I.username = E.username'
                        cursor.execute(sql, (_schoolID, _level, average_score))
                    
                    else:

                        sql = 'select I.username from intellify.student as I, quizdb.history as E where I.category_id = %s and I.level = %s and E.score >= 40 and I.username = E.username' 
                        cursor.execute(sql, (_schoolID, _level))       

                    qualified_students = cursor.fetchall()
                    
                    for student in qualified_students:
                        sql = 'update intellify.student set status = 1 where registrationno = %s'
                        cursor.execute(sql, (student[0]))
                    
            conn.commit()
            return make_response(jsonify('updated'), 200)
            
        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay - admin
class DeleteStudent(Resource):
    def post(self):
        try:
            # parse arguments
            parser = reqparse.RequestParser()
            parser.add_argument('student_id', type=str, help='Student ID')
            args = parser.parse_args()

            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _student_id = int(args['student_id'])

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'delete from intellify.stduent where username = %s'
            cursor.execute(sql, (_student_id))

            sql = 'delete from quizdb.user_answer where username = %s'
            cursor.execute(sql, (_student_id))

            sql = 'delete from quizdb.history where username = %s'
            cursor.execute(sql, (_student_id))

            conn.commit()
            make_response(jsonify('deleted'), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)         

# all-okay - school
class round1_result_detail(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _school_id = int(school_id)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select skill_id, skill_name from quizdb.skill where skill_id != 0 and round = 1'
            cursor.execute(sql)
            skill_data = cursor.fetchall()

            # skill_list = []
            # for info in skill_data:
            #     skill_list.append(info[0])
            
            res = {}
            sql = 'select A.username, A.firstname, A.lastname, A.class, A.status, B.skill_1_score, B.skill_2_score, B.skill_3_score, B.skill_4_score, B.skill_5_score, B.score from intellify.student as A, quizdb.history as B, quizdb.quiz as C where A.username = B.username and B.quizid = C.quizid and A.category_id = %s and C.belongs_to = 0 and A.status != -1;'
            cursor.execute(sql, (_school_id))

            data = cursor.fetchall()
            for info in data:
                student_id = info[0]
                name = info[1] + ' ' + info[2]
                stud_class = info[3]
                score = info[10]
                
                res[student_id] = {
                    'name' : name,
                    'class': stud_class,
                    'score': score
                }

                i = 5
                for skill in skill_data:
                    res[student_id][skill[1]] = info[i]
                    i += 1

                status = info[4]

                if status == 1:
                    res[student_id]['qualification_status'] = 'Qualified'
                else:
                    res[student_id]['qualification_status'] = 'Not Qualified'
            
            if not res:
                res = 'null'

            conn.commit()
            return make_response(jsonify(res), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

# all-okay
class round2_result_detail(Resource):
    def get(self, school_id):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _school_id = int(school_id)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            sql = 'select A.username, B.level, C.firstname, C.lastname, C.class, C.status from intellify.student as C, quizdb.history as A, quizdb.quiz as B where A.quizid = B.quizid and A.username = C.username and B.belongs_to = 1'
            cursor.execute(sql)
            student_data = cursor.fetchall()
                
            # student_list = []
            # for stud in data:
            #     student_list.append(stud[0])
            
            result = {}
            for student in student_data:

                sql = 'select quizid from quizdb.quiz where belongs_to = 1 and level = %s'
                cursor.execute(sql, student[1])
                quiz_data = cursor.fetchall()
                
                score = 0
                res = {}
                for quiz in quiz_data:
                    
                    quizid = quiz[0]

                    sql = 'select score from quizdb.history where username = %s and quizid = %s'
                    cursor.execute(sql, (student[0], quizid))
                    data = cursor.fetchall()
                    
                    if data:
                        score += data[0][0]

                    sql = 'select skill_name from quizdb.skill as A, quizdb.quiz as B where A.skill_id = B.skill_id and quizid = %s'
                    cursor.execute(sql, (quizid))
                    skill = cursor.fetchall()[0][0]

                    if data:
                        res[skill] = data[0][0]
                    else:
                        res[skill] = 0
                
                res['score'] = score
                res['name'] = student[2] + student[3]
                res['class'] = student[4]

                if student[5] == 2:
                    res['qualification_status'] = 'Qualified'
                else:
                    res['qualification_status'] = 'Not Qualified'

                result[student[0]] = res
            
            if not result:
                result = 'null'

            conn.commit()

            # sql = 'select A.username, A.firstname, A.lastname, A.class, B.score, B.skill_1_score, B.skill_2_score, B.skill_3_score, B.skill_4_score, B.skill_5_score, A.status from intellify.student as A, quizdb.history as B, quizdb.quiz as C where A.username = B.username and B.quizid = C.quizid and A.category_id = %s and C.belongs_to = 1 and A.status = 1;'
            # cursor.execute(sql, (_school_id))

            # data = cursor.fetchall()
            
            return make_response(jsonify(result), 200)

        except Exception as error:

            return make_response(jsonify(error), 500)

class SetR3Result(Resource):
    def post(self, gov, pri):
        try:
            # parse arguments
            # parser = reqparse.RequestParser()
            # parser.add_argument('apikey', type=str, help='API KEY FOR AUTHENTICATION')
            # args = parser.parse_args()
            
            # if not AUTHENTICATION(args['apikey']):
            #     return { 'auth_status': 'denied' }

            # store arguments
            _gov = int(gov)
            _pri = int(pri)

            # connect to database
            conn = mysql.connect()
            cursor = conn.cursor()

            school_type = ['private', 'government']
            levels = [0, 1, 2, 3]
            limit = [ _pri, _gov ]
            i = 0
            for school in school_type:
                
                for level in levels:
                    
                    sql = 'select A.username, A.score from intellify.student as C, quizdb.history as A, quizdb.quiz as B, intellify.school as D where C.category_id = D.category_id and A.quizid = B.quizid and A.username = C.username and B.belongs_to = 1 and D.school_type = %s and C.level = %s'
                    cursor.execute(sql, (school, level))
                    student_data = cursor.fetchall()
                    
                    result = {}
                    for student in student_data:

                        sql = 'select quizid from quizdb.quiz where belongs_to = 1 and level = %s'
                        cursor.execute(sql, student[1])
                        quiz_data = cursor.fetchall()
                        
                        score = 0
                        for quiz in quiz_data:
                            
                            quizid = quiz[0]

                            sql = 'select score from quizdb.history where username = %s and quizid = %s'
                            cursor.execute(sql, (student[0], quizid))
                            data = cursor.fetchall()
                            
                            if data:
                                score += data[0][0]
                        
                        result[student[0]] = score

                    import operator
                    student_list = sorted(result.items(), key=operator.itemgetter(1), reverse = True)
                    
                    if not student_list:
                        continue

                    student_list = student_list[ : limit[i]+1]
                    for student in student_list:
                        sql = 'update intellify.student set status = 2 where username = %s'
                        cursor.execute(sql, (student[0]))
                    i += 1
            
            conn.commit()

        except Exception as error:

            return make_response(jsonify(error), 500)

class SchoolSkillPerformanceChart(Resource):
    
    def get(self, school_id, level, skill_id):
        
            try :

                # store arguments
                _school_id = int(school_id)
                _level = int(level)
                _skill_id = int(skill_id)

                # connect to database
                conn = mysql.connect()
                cursor = conn.cursor()

                # sql = 'select username from intellify.student where category_id = %s and level = %s'
                # cursor.execute(sql, (_school_id, _level))
                # student_data = cursor.fetchall()

                # sql = 'select quizid from quizdb.quiz where skill_id = %s and level = %s'
                # cursor.execute(sql, (_skill_id, _level))
                # quiz_data = cursor.fetchall()

                # for student in student_data:
                #     student_id = student[0]

                sql = 'select quizid, title from quizdb.quiz where skill_id = %s and level = %s'
                cursor.execute(sql, (_skill_id, _level))
                quiz_data = cursor.fetchall()
                
                chart = {}
                chart['x'] = []
                chart['y'] = []
                for quiz in quiz_data:
                    chart['x'].append(quiz[1])

                    sql = 'select avg(score), D.total*D.correct as marks from intellify.student as A, intellify.school as B, quizdb.history as C, quizdb.quiz as D where A.category_id = B.category_id and A.username = C.username and D.quizid = C.quizid and A.category_id = %s and A.level = %s and D.quizid = %s'
                    cursor.execute(sql, (_school_id, _level, quiz[0]))
                    res = cursor.fetchall()
                    
                    if res:
                        chart['y'].append(str(res[0][0]/res[0][1]))
                    else:
                        chart['y'].append(0)
                
                return make_response(jsonify(chart), 200)

            except Exception as error:

                return make_response(jsonify(error), 500)


# for student result
api.add_resource(GetAllResult, '/api/GetAllResult/<registration_no>')
api.add_resource(GetOverallScore, '/api/GetOverallScore/<registration_no>')
# api.add_resource(GetSkillScores, '/api/GetSkillScores/<registration_no>/<quiz_id>')
api.add_resource(GetOverallSkillScores, '/api/GetOverallSkillScores/<registration_no>/<level>')
api.add_resource(GetPerformanceChart, '/api/GetPerformanceChart/<registration_no>')
api.add_resource(GetSkillPerformanceChart, '/api/GetSkillPerformanceChart/<registration_no>/<skill_id>')    # round-1-result not shown-here
api.add_resource(GetOverAllRank, '/api/GetOverAllRank/<registration_no>/<level>')
api.add_resource(GetOverAllSkillRanks, '/api/GetOverAllSkillRanks/<registration_no>/<level>')
api.add_resource(GetRound1Result, '/api/GetRound1Result/<registration_no>/<level>')
api.add_resource(GetRound2Result, '/api/GetRound2Result/<registration_no>/<level>')
api.add_resource(GetSkills, '/api/GetSkills/<round>')

# admin utility
api.add_resource(GetWrongOmr, '/api/GetWrongOmr/<school_id>')
api.add_resource(SetHistory, '/api/SetHistory')
# api.add_resource(SetHistoryPractice, '/api/SetHistoryPractise/<registration_no>/<quiz_id>/<skill_id>')
# api.add_resource(SetPerformance, '/api/SetPerformance')
# api.add_resource(SetPerformancePractice, '/api/SetPerformancePractice/<registration_no>')
api.add_resource(AddStudent, '/api/AddStudent')
api.add_resource(DeleteStudent, '/api/DeleteStudent')
api.add_resource(SetQualificationThreshold, '/api/SetQualificationThreshold/<school_id>/<level>/<percentage>')
api.add_resource(SetQualifications, '/api/SetQualifications')
api.add_resource(SetR3Result, '/api/SetR3Result/<gov>/<pri>')


# for school result
api.add_resource(GetSchoolRank, '/api/GetSchoolRank/<school_id>')
api.add_resource(Histogram, '/api/Histogram/<school_id>/<level>/<purpose>')
api.add_resource(round1_result_detail, '/api/round1_result_detail/<school_id>')
api.add_resource(round2_result_detail, '/api/round2_result_detail/<school_id>')
api.add_resource(GetParticipants, '/api/GetParticipants/<school_id>')
api.add_resource(GetLeaderBoard, '/api/GetLeaderBoard/<school_id>/<level>')
# api.add_resource(GetQualifiedStudents, '/api/GetQualifiedStudents/<school_id>/<level>')
api.add_resource(GetSchoolAverageSkillScore, '/api/GetSchoolAverageSkillScore/<school_id>')
api.add_resource(GetSchoolAverageScore, '/api/GetSchoolAverageScore/<school_id>')
# api.add_resource(GetOlympiadAverageSkillScore, '/api/GetOlympiadAverageSkillScore/<level>/<skill>')
api.add_resource(SchoolSkillPerformanceChart, '/api/SchoolSkillPerformanceChart/<school_id>/<level>/<skill_id>')    # round-1-result not shown-here


# driver function
if __name__ == '__main__':
    
    # get port as arg
    port = sys.argv[1]

    # start app
    app.run(port=port, debug=False)