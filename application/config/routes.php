<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/e

|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method

 */

//mock test route
/*$route['MockQuizzes/Quizlist/(:num)'] = 'MockQuizzes/Quizlist/index/$1';
$route['MockQuizzes/Quiz/(:num)'] = 'MockQuizzes/Quiz/index/$1';
$route['MockQuizzes/Result/(:num)'] = 'MockQuizzes/Result/index/$1';

// sample quiz
$route['sampleQuiz/QuizDashboard/(:num)'] = 'sampleQuiz/QuizDashboard/index/$1';
$route['sampleQuiz/Quiz/(:num)'] = 'sampleQuiz/Quiz/index/$1';
$route['sampleQuiz/Result/(:num)'] = 'sampleQuiz/Result/index/$1';

//tutorial route
$route['StudyResource/Tutorial1Resource/(:num)'] = 'StudyResource/Tutorial1Resource/index/$1';*/
/*$route['StudyResource/Tutorial1Resource/(:num)'] = 'MockQuizzes/Quiz/index/$1';
$route['StudyResource/Tutorial1Resource/(:num)'] = 'MockQuizzes/Result/index/$1';*/

/*$route['WeeklyQuiz/Result/(:num)'] = 'WeeklyQuiz/Result/index/$1';
$route['WeeklyQuiz/Quiz/(:num)'] = 'WeeklyQuiz/Quiz/index/$1';
$route['WeeklyQuiz/Quizlist/(:num)'] = 'WeeklyQuiz/Quizlist/index/$1';
$route['WeeklyQuiz/Quizlist/top5/(:num)'] = 'WeeklyQuiz/Quizlist/getTop5/$1';
$route['admin/ManageSkills/delete/(:num)'] = 'admin/ManageSkills/delete/$1';
$route['NSCP/Round2/Quiz/(:num)'] = 'NSCP/Round2/Quiz/index/$1';
$route['NSCP/Year/(:num)'] = 'NSCP/Year/index/$1';
$route['admin/EditExam/(:num)'] = 'admin/EditExam/index/$1';*/
// $route['admin/Managepopup/delete/(:num)'] = 'admin/Managepopup/delete/$1';

/*$route['api/school/login'] = 'api/schools/login';
$route['api/student/login'] = 'api/students/login';
$route['api/schools/(:num)/students/(:num)/poems/(:num)'] = 'api/poems/$3';
$route['api/schools/(:num)/students/(:num)/poems'] = 'api/poems';
$route['api/schools/(:num)/students/(:num)/help'] = 'api/students/$2/help';
$route['api/schools/(:num)/students/(:num)/changepass'] = 'api/students/$2/changepass';
$route['api/schools/(:num)/students/(:num)'] = 'api/students/$2';
$route['api/schools/(:num)/students'] = 'api/students';*/
$route['default_controller'] = 'Home';

$route['admin'] = adminpath . '/login';
$route['NSCP/Round2'] = round2path . '/login';
$route['newsandevent/(:any)'] = 'news/details/$1';
$route['newsandevent'] = 'news';
$route['products/(:any)'] = 'products/details/$1';
$route['products'] = 'products';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*$route['Answer/addAns/(:num)'] = 'Answer/addAns/$1';
$route['Answer/(:num)'] = 'Answer/index/$1';
$route['admin/Manage_ans/(:num)'] = 'admin/Manage_ans/index/$1';
$route['admin/Posts/delete/(:num)'] = 'admin/Posts/delete/$1';
$route['admin/Posts/disable/(:num)'] = 'admin/Posts/disable/$1';
$route['admin/Manage_ans/disable/(:num)'] = 'admin/Manage_ans/disable/$1';
$route['StudyMaterial/student/lg/(:num)'] = 'StudyMaterial/student/$1';
$route['StudyMaterial/studentCritical/lg/(:num)'] = 'StudyMaterial/studentCritical/$1';
$route['discussionforum/page'] = 'discussionforum/index';
$route['discussionforum/page/(:num)'] = 'discussionforum/index/$1';
$route['discussionforum'] = 'Redirectpost/index/';*/
/*$route['NSCP/21stcentury/Article'] = 'article_first';*/
