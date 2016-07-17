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

$route['default_controller'] = 'home/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'admin/user/index';
$route['admin/signup'] = 'admin/user/signup';
$route['admin/create_member'] = 'admin/user/create_member';
$route['admin/login'] = 'admin/user/index';
$route['admin/logout'] = 'admin/user/logout';
$route['admin/login/validate_credentials'] = 'admin/user/validate_credentials';
$route['admin/changepassword'] = 'admin/user/changepassword';

$route['admin/users'] = 'admin/users/index';
$route['admin/users/add'] = 'admin/users/add';
$route['admin/users/update'] = 'admin/users/update';
$route['admin/users/update/(:any)'] = 'admin/users/update/$1';
$route['admin/users/delete/(:any)'] = 'admin/users/delete/$1';
$route['admin/users/(:any)'] = 'admin/users/index/$1'; //$1 = page number

$route['admin/challenge'] = 'admin/challenge/index';
$route['admin/challenge/add'] = 'admin/challenge/add';
$route['admin/challenge/update'] = 'admin/challenge/update';
$route['admin/challenge/update/(:any)'] = 'admin/challenge/update/$1';
$route['admin/challenge/updatestatus/(:any)'] = 'admin/challenge/updatestatus/$1';
$route['admin/challenge/delete/(:any)'] = 'admin/challenge/delete/$1';
$route['admin/challenge/(:any)'] = 'admin/challenge/index/$1'; //$1 = page number

$route['admin/country'] = 'admin/country/index';
$route['admin/country/add'] = 'admin/country/add';
$route['admin/country/update'] = 'admin/country/update';
$route['admin/country/update/(:any)'] = 'admin/country/update/$1';
$route['admin/country/updatestatus/(:any)'] = 'admin/country/updatestatus/$1';
$route['admin/country/delete/(:any)'] = 'admin/country/delete/$1';
$route['admin/country/(:any)'] = 'admin/country/index/$1'; //$1 = page number

$route['admin/earnmore'] = 'admin/earnmore/index';
$route['admin/earnmore/add'] = 'admin/earnmore/add';
$route['admin/earnmore/update'] = 'admin/earnmore/update';
$route['admin/earnmore/update/(:any)'] = 'admin/earnmore/update/$1';
$route['admin/earnmore/updatestatus/(:any)'] = 'admin/earnmore/updatestatus/$1';
$route['admin/earnmore/delete/(:any)'] = 'admin/earnmore/delete/$1';
$route['admin/earnmore/(:any)'] = 'admin/earnmore/index/$1'; //$1 = page number

$route['admin/feedback'] = 'admin/feedback/index';
$route['admin/feedback/add'] = 'admin/feedback/add';
$route['admin/feedback/update'] = 'admin/feedback/update';
$route['admin/feedback/update/(:any)'] = 'admin/feedback/update/$1';
$route['admin/feedback/updatestatus/(:any)'] = 'admin/feedback/updatestatus/$1';
$route['admin/feedback/delete/(:any)'] = 'admin/feedback/delete/$1';
$route['admin/feedback/(:any)'] = 'admin/feedback/index/$1'; //$1 = page number

$route['admin/invitemore'] = 'admin/invitemore/index';
$route['admin/invitemore/add'] = 'admin/invitemore/add';
$route['admin/invitemore/update'] = 'admin/invitemore/update';
$route['admin/invitemore/update/(:any)'] = 'admin/invitemore/update/$1';
$route['admin/invitemore/updatestatus/(:any)'] = 'admin/invitemore/updatestatus/$1';
$route['admin/invitemore/delete/(:any)'] = 'admin/invitemore/delete/$1';
$route['admin/invitemore/(:any)'] = 'admin/invitemore/index/$1'; //$1 = page number

$route['admin/inviteunlimited'] = 'admin/inviteunlimited/index';
$route['admin/inviteunlimited/add'] = 'admin/inviteunlimited/add';
$route['admin/inviteunlimited/update'] = 'admin/inviteunlimited/update';
$route['admin/inviteunlimited/update/(:any)'] = 'admin/inviteunlimited/update/$1';
$route['admin/inviteunlimited/updatestatus/(:any)'] = 'admin/inviteunlimited/updatestatus/$1';
$route['admin/inviteunlimited/delete/(:any)'] = 'admin/inviteunlimited/delete/$1';
$route['admin/inviteunlimited/(:any)'] = 'admin/inviteunlimited/index/$1'; //$1 = page number

/* End of file routes.php */
/* Location: ./application/config/routes.php */