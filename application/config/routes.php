<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['articles'] = 'articles/index';
$route['authors'] = 'authors/index';
$route['users'] = 'users/index';
$route['volumes'] = 'volumes/index'; 

$route['login'] = 'login';
$route['register'] = 'register';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

$route['users'] = 'users/index';
$route['view'] = 'users/view';
$route['users/update_profile'] = 'users/update_profile';
$route['users/edit']['POST'] = 'users/edit_process';  
$route['users/add'] = 'users/add';  
$route['users/delete'] = 'users/delete';
$route['users/(:any)'] = 'users/view/$1';

$route['volumes'] = 'volumes/index'; 
$route['view'] = 'volumes/view';

$route['volumes/add'] = 'volumes/add';
$route['volumes/update'] = 'volumes/update';
$route['edit'] = 'volumes/edit';
$route['volumes/delete'] = 'volumes/delete';
$route['volumes/(:any)'] = 'volumes/view/$1';
$route['volumes/edit']['POST'] = 'volumes/edit_process';  

$route['articles'] = 'articles/index'; 
$route['articles/add']['GET'] = 'articles/add_volume';
$route['articles/add']['POST'] = 'articles/add';
$route['articles/edit']['POST'] = 'articles/edit_process';
$route['articles/delete'] = 'articles/delete';
$route['articles/download(:any)'] = 'articles/download/$1'; 
$route['articles/(:any)'] = 'articles/view/$1'; 
$route['toggle-archive']['POST'] = 'Articles/toggle_archive';
$route['toggle-publish']['POST'] = 'Articles/toggle_publish';


$route['authors'] = 'authors/index'; 
$route['view'] = 'authors/view';
$route['authors/update_profile'] = 'authors/update_profile';
$route['authors/edit'] ['POST']= 'authors/edit_process'; 
$route['authors/add'] = 'authors/add';
$route['authors/delete'] = 'authors/delete';
$route['authors/(:any)'] = 'authors/view/$1'; 
