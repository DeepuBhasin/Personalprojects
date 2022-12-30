<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = 'ErrorPage';
$route['translate_uri_dashes'] = FALSE;

// Api Controller
$route['check']['get'] = 'ApiController/index';
$route['add_user']['post'] = 'ApiController/addUser';
$route['login_user']['post'] = 'ApiController/loginUser';
$route['my_profile/(:num)']['get'] = 'ApiController/myProfile/$1';
$route['update_profile']['post'] = 'ApiController/updateProfile';
$route['all_users/(:num)']['get'] = 'ApiController/allUsers/$1';
$route['search_user/(:num?)/(:any?)']['get'] = 'ApiController/searchUser/$1/$2';
$route['create_post']['post'] = 'ApiController/createPost';
$route['get_all_post_data/(:num)']['get'] = 'ApiController/getAllPostData/$1';
$route['like_comment_post']['post'] = 'ApiController/likeCommentPost';
$route['post_comment_comment']['post'] = 'ApiController/postCommentComment';