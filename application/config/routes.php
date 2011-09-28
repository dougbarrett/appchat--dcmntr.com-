<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['404_override'] = '';
$route['welcome'] = 'main/welcome';
$route['add-app'] = 'main/add_app';
$route['home'] = 'main';
$route['sign-up'] = 'main/sign_up';
$route['apps'] = 'main/apps';
$route['logout'] = 'main/logout';
$route['login'] = 'main/login';
$route['user-profile/(:any)'] = 'main/user_profile/$1';
$route['app-profile/(:any)'] = 'main/app_profile/$1';
$route['edit-app/(:any)'] = 'main/edit_app/$1';
$route['delete-app/(:any)'] = 'main/delete_app/$1';
$route['add-topic/(:any)'] = 'main/add_topic/$1';
$route['view-discussion/(:any)/(:any)/(:any)'] = 'main/view_discussion/$2/$1';
$route['view-discussion/(:any)/(:any)'] = 'main/view_discussion/$2/$1';
$route['add-bug/(:any)'] = 'main/add_bug/$1';
$route['add-faq/(:any)'] = 'main/add_faq/$1';
$route['view-bug/(:any)/(:any)/(:any)'] = 'main/view_bug/$2/$1';
$route['view-bug/(:any)/(:any)'] = 'main/view_bug/$2/$1';
$route['view-faq/(:any)/(:any)/(:any)'] = 'main/view_faq/$2/$1';
$route['view-faq/(:any)/(:any)'] = 'main/view_faq/$2/$1';
$route['edit-faq/(:any)/(:any)'] = 'main/edit_faq/$2/$1';
$route['login-failed'] = 'main/login_failed';
$route['profile'] = 'main/profile';

/* End of file routes.php */
/* Location: ./application/config/routes.php */