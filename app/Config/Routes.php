<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// API ROUTES

$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->group('view', function($routes) {
        $routes->get('overview', 'ApiController::get_overview');
        $routes->get('visitors', 'ApiController::get_visitors');
        $routes->get('referrers', 'ApiController::get_referrers');   
    });
});


// HOME ROUTES

$routes->group('', ['namespace' => 'App\Controllers\Home'], function($routes) {
    $routes->get('/', 'ViewsController::index');
    $routes->get('home', 'ViewsController::index');
    $routes->get('admission', 'ViewsController::index');
    $routes->get('news', 'ViewsController::index');
    $routes->get('faculty', 'ViewsController::index');
    $routes->get('officers', 'ViewsController::index');
    
    // GROUP ROUTES
    $routes->group('/', function($routes) {
        $routes->get('research', 'ViewsController::index');
        $routes->get('research/view/(:num)', 'ViewsController::index/$1');
    });
});

// ADMIN ROUTES

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'ViewsController::index');
    $routes->get('signout', 'ViewsController::index');

    $routes->group('login', function($routes) {
        $routes->get('/', 'ViewsController::index');
        $routes->post('/', 'Process\LoginAuthController::login');
    });

    $routes->group('widgets', function($routes) {
        $routes->get('/', 'ViewsController::index'); 
        $routes->post('toggle', 'Process\WidgetController::index'); 
    });

    $routes->get('dashboard', 'ViewsController::index');
    $routes->get('notify', 'ViewsController::index');

    // MANAGE USERS

    $routes->group('manage', function($routes) {
        $routes->get('users', 'ViewsController::index');
        $routes->get('users/add', 'ViewsController::index');
        $routes->post('users/add', 'Process\UserController::add');
        
        $routes->get('users/update/(:num)', 'ViewsController::index/$1');
        $routes->get('users/delete/(:num)', 'ViewsController::index/$1');
        $routes->post('users/update/profile/image', 'Process\UserController::update_profile_image');
        $routes->post('users/update/profile', 'Process\UserController::update_profile');
        $routes->post('users/delete', 'Process\UserController::delete');
    });

    // MANAGE PAGE CONTENT

    $routes->group('manage', function($routes) {
        $routes->group('page/home', function($routes) {
            $routes->get('/', 'ViewsController::index');
            $routes->get('logo/update/(:num)', 'ViewsController::index/$1');
            $routes->get('carousel', 'ViewsController::index');
            $routes->get('courses', 'ViewsController::index');

            $routes->post('logo/update', 'Process\HomeController::update_banner');
            $routes->post('banner/update', 'Process\HomeController::update_banner');
            $routes->post('carousel', 'Process\HomeController::add_carousel');
            $routes->post('carousel/delete', 'Process\HomeController::delete_carousel');
            
        });
        $routes->get('page/admission', 'ViewsController::index');

        $routes->group('page/bulletin', function($routes) {
            $routes->get('/', 'ViewsController::index');
            $routes->get('view', 'ViewsController::index');
            $routes->get('add', 'ViewsController::index');
            $routes->get('update/(:num)', 'ViewsController::index/$1');
            $routes->get('delete/(:num)', 'ViewsController::index/$1');

            $routes->post('add', 'Process\BulletinController::add');
            $routes->post('update/(:num)', 'Process\BulletinController::update/$1');
            $routes->post('update/banner/(:num)', 'Process\BulletinController::update_banner/$1');
            $routes->post('image/add', 'Process\BulletinController::add_image');
            $routes->post('image/delete', 'Process\BulletinController::delete_image');
            $routes->post('delete', 'Process\BulletinController::delete'); 

        });

        $routes->group('page/faculty', function($routes) {
            $routes->get('/', 'ViewsController::index');
            $routes->get('add', 'ViewsController::index');
            $routes->get('update/(:num)', 'ViewsController::index/$1');
            $routes->get('delete/(:num)', 'ViewsController::index/$1');

            $routes->post('add', 'Process\FacultyController::add');
            $routes->post('update/image', 'Process\FacultyController::update_image');
            $routes->post('update/data', 'Process\FacultyController::update_data');
            $routes->post('delete', 'Process\FacultyController::delete');
        });

        $routes->group('page/officers', function($routes) {
            $routes->get('/', 'ViewsController::index');
            $routes->get('add', 'ViewsController::index');
            $routes->get('update/(:num)', 'ViewsController::index/$1');
            $routes->get('delete/(:num)', 'ViewsController::index/$1');

            $routes->post('add', 'Process\OfficersController::add_data');
            $routes->post('update/image', 'Process\OfficersController::update_image');
            $routes->post('update/data', 'Process\OfficersController::update_data');
            $routes->post('delete', 'Process\OfficersController::delete_data');

        });
        $routes->group('page/research', function($routes) {
            $routes->get('/', 'ViewsController::index');
            $routes->get('add', 'ViewsController::index');
            $routes->get('update/(:num)', 'ViewsController::index/$1');
            $routes->get('delete/(:num)', 'ViewsController::index/$1');


            $routes->post('add', 'Process\ResearchController::add_data');

            $routes->post('update/data', 'Process\ResearchController::update_data');
            $routes->post('update/banner', 'Process\ResearchController::update_banner');
            $routes->post('add/images', 'Process\ResearchController::add_image');
            $routes->post('add/author', 'Process\ResearchController::add_author');
            $routes->post('delete/author', 'Process\ResearchController::delete_author');
            $routes->post('delete', 'Process\ResearchController::delete_data');
            $routes->post('delete/image', 'Process\ResearchController::delete_image');

        });
        $routes->get('page/contacts', 'ViewsController::index');
        $routes->post('page/contacts', 'Process\ContactController::update');
    });

});


/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
