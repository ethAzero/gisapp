<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//$route['admin/peraturan/kategori'] = 'admin/peraturan/kategori';



$route['admin/progress/(:any)'] = 'admin/progress/index/$1';
$route['admin/progress/apill/view/(:any)/(:any)'] = 'admin/progress/viewapill/$1/$2';
$route['admin/progress/delinator/view/(:any)/(:any)'] = 'admin/progress/viewdelinator/$1/$2';
$route['admin/progress/cermin/view/(:any)/(:any)'] = 'admin/progress/viewcermin/$1/$2';
$route['admin/progress/pju/view/(:any)/(:any)'] = 'admin/progress/viewpju/$1/$2';
$route['admin/progress/flash/view/(:any)/(:any)'] = 'admin/progress/viewflash/$1/$2';
$route['admin/progress/rambu/view/(:any)/(:any)'] = 'admin/progress/viewrambu/$1/$2';
$route['admin/progress/rppj/view/(:any)/(:any)'] = 'admin/progress/viewrppj/$1/$2';
$route['admin/progress/daerahrawan/view/(:any)/(:any)'] = 'admin/progress/viewdrk/$1/$2';

$route['admin/apil/view/(:any)/(:any)'] = 'admin/apil/viewapil/$1/$2';
$route['admin/delinator/view/(:any)/(:any)'] = 'admin/delinator/viewdelinator/$1/$2';
$route['admin/cermin/view/(:any)/(:any)'] = 'admin/cermin/viewcermin/$1/$2';
$route['admin/rambu/view/(:any)/(:any)'] = 'admin/rambu/viewrambu/$1/$2';
$route['admin/rppj/view/(:any)/(:any)'] = 'admin/rppj/viewrppj/$1/$2';
$route['admin/flash/view/(:any)/(:any)'] = 'admin/flash/viewflash/$1/$2';
$route['admin/pju/view/(:any)/(:any)'] = 'admin/pju/viewpju/$1/$2';
$route['admin/guardrail/view/(:any)/(:any)'] = 'admin/guardrail/viewguardrail/$1/$2';
$route['admin/marka/view/(:any)/(:any)'] = 'admin/marka/viewmarka/$1/$2';



//$route['apiservice/token'] = 'api/restapikey/loginuser';


$route['apiservice/gettoken'] = 'api/users/login';

$route['apiservice/showapil'] = 'api/restapikey/getapil';
$route['apiservice/showdelinator'] = 'api/restapikey/getdelinator';
$route['apiservice/showcermin'] = 'api/restapikey/getcermin';
$route['apiservice/showflash'] = 'api/restapikey/getflash';
$route['apiservice/showguardrail'] = 'api/restapikey/getguardrail';
$route['apiservice/showmarka'] = 'api/restapikey/getmarka';
$route['apiservice/showlpju'] = 'api/restapikey/getlpju';
$route['apiservice/showrppj'] = 'api/restapikey/getrppj';
$route['apiservice/showrambu'] = 'api/restapikey/getrambu';

$route['apiservice/showpelabuhan'] = 'api/restapikey/getpelabuhan';
$route['apiservice/showperlintasan'] = 'api/restapikey/getperlintasan';
$route['apiservice/showshelter'] = 'api/restapikey/getshelter';
$route['apiservice/showstasiun'] = 'api/restapikey/getstasiun';
$route['apiservice/showbandara'] = 'api/restapikey/getbandara';
$route['apiservice/showterminal'] = 'api/restapikey/getterminal';
$route['apiservice/showsdp'] = 'api/restapikey/getsdp';
$route['apiservice/showdaerahrawan'] = 'api/restapikey/getdaerahrawan';


$route['apiservice/countapil'] = 'api/restapikey/getcountapil';
$route['apiservice/countcermin'] = 'api/restapikey/getcountcermin';
$route['apiservice/countflash'] = 'api/restapikey/getcountflash';
$route['apiservice/countguardrail'] = 'api/restapikey/getcountguardrail';
$route['apiservice/countmarka'] = 'api/restapikey/getcountmarka';
$route['apiservice/countlpju'] = 'api/restapikey/getcountlpju';
$route['apiservice/countrppj'] = 'api/restapikey/getcountrppj';
$route['apiservice/countrambu'] = 'api/restapikey/getcountrambu';
$route['apiservice/countterminal'] = 'api/restapikey/getcountterminal';
$route['apiservice/countsdp'] = 'api/restapikey/getcountsdp';
$route['apiservice/countstasiun'] = 'api/restapikey/getcountstasiun';
$route['apiservice/countdaerahrawan'] = 'api/restapikey/getcountdaerahrawan';

//route survay
// $routes->post('/apill', 'admin\survayapill::index');
$route['apill'] = 'admin/survayapill/add';
$route['cermin'] = 'admin/survaycermin/add';
$route['delinator'] = 'admin/surveidelinator/add';
$route['flash'] = 'admin/surveiflash/add';
$route['guardrail'] = 'admin/surveiguardrail/add';
$route['marka'] = 'admin/surveimarka/add';
$route['pju'] = 'admin/surveipju/add';
$route['rppj'] = 'admin/surveirppj/add';
$route['jl'] = 'admin/survay/jalan';
$route['tipe'] = 'admin/survay/tipe';


// // User API Routes
// $route['api/user/register'] = 'api/users/register';
// $route['api/user/login'] = 'api/users/login';

// // Users Article Routes
// $route['api/article/create'] = 'api/articles/createArticle';

// // Deleta an Article Routes
// # https://codeigniter.com/user_guide/general/routing.html#using-http-verbs-in-routes
// $route['api/article/(:num)/delete']["DELETE"] = 'api/articles/deleteArticle/$1';

// // Update and Article Route :: PUT API Request
// $route['api/article/update']["put"] = 'api/articles/updateArticle';