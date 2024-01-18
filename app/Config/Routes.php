<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Auth Routes
 * --------------------------------------------------------------------
 */

//$routes->match(['get', 'post'], 'login', 'Auth::login'); // LOGIN PAGE
$routes->match(['get', 'post'], 'register', 'Auth::register'); // REGISTER PAGE
$routes->match(['get', 'post'], 'forgotpassword', 'Auth::forgotPassword'); // FORGOT PASSWORD
$routes->match(['get', 'post'], 'activate/(:num)/(:any)', 'Auth::activateUser/$1/$2'); // INCOMING ACTIVATION TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'resetpassword/(:num)/(:any)', 'Auth::resetPassword/$1/$2'); // INCOMING RESET TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'updatepassword/(:num)', 'Auth::updatepassword/$1'); // UPDATE PASSWORD
$routes->match(['get', 'post'], 'lockscreen', 'Auth::lockscreen'); // LOCK SCREEN
$routes->get('logout', 'Auth::logout'); // LOGOUT







/**
 * --------------------------------------------------------------------
 * Home Routes
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Auth::login');


/**
 * --------------------------------------------------------------------
 * SUPER ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '1'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,1'], function ($routes) {

	$routes->get('superadmin', 'Superadmin::index'); // SUPER ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'superadmin/profile', 'Auth::profile'); 
	$routes->get('degree', 'Degree::index'); // Degree
    $routes->match(['get', 'post'], 'degree/add', 'Degree::add'); // LOCK SCREEN
	$routes->match(['get', 'post'], 'degree/edit/(:num)', 'Degree::edit/$1'); // LOCK SCREEN
$routes->get('university', 'UniversityController::index');
$routes->get('university/create', 'UniversityController::create');
$routes->post('university/store', 'UniversityController::store');
$routes->get('university/edit/(:num)', 'UniversityController::edit/$1');
$routes->post('university/update/(:num)', 'UniversityController::update/$1');
$routes->get('university/delete/(:num)', 'UniversityController::delete/$1');

$routes->get('college', 'CollegeController::index');
$routes->get('college/create', 'CollegeController::create');
$routes->post('college/store', 'CollegeController::store');
$routes->get('college/edit/(:num)', 'CollegeController::edit/$1');
$routes->post('college/update/(:num)', 'CollegeController::update/$1');
$routes->get('college/delete/(:num)', 'CollegeController::delete/$1');

$routes->get('castecategory', 'CasteCategoryController::index');
$routes->get('castecategory/create', 'CasteCategoryController::create');
$routes->post('castecategory/store', 'CasteCategoryController::store');
$routes->get('castecategory/edit/(:num)', 'CasteCategoryController::edit/$1');
$routes->post('castecategory/update/(:num)', 'CasteCategoryController::update/$1');
$routes->get('castecategory/delete/(:num)', 'CasteCategoryController::delete/$1');

});


/**
 * --------------------------------------------------------------------
 * ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '2'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,2'], function ($routes){

	$routes->get('dashboard', 'Dashboard::index'); // ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'dashboard/profile', 'Auth::profile');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
