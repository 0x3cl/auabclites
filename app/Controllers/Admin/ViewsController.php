<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\Admin\DataController;

class ViewsController extends BaseController {

    public function renderPage($uri, $id = null) {
        
        // CONFIG FOR RENDERING PAGE 
        // SET TITILE
        // SET ACTIVE PAGE
        // SET IF MAIN PAGE OR SUB PAGE
        // SET VIEW NAME
        // SET THE DATA THAT WILL BE FETCHED FROM DB

        $config = [ 
            'admin/login' => [
                'title' => 'Login | SITES',
                'active' => '',
                'isSubPage' => false,
                'view' => 'login',
                'data' => [
                    '',
                ]
            ],
            'admin/dashboard' => [
                'title' => 'Dashboard | SITES',
                'isSubPage' => false,
                'active' => 'dashboard',
                'view' => 'dashboard',
                'data' => [
                    '',
                ]
            ],
            'admin/notify' => [
                'title' => 'Dashboard | SITES',
                'isSubPage' => false,
                'active' => '',
                'view' => 'notify',
                'data' => [
                    '',
                ]
            ],
            'admin/manage/users' => [
                'title' => 'Manage Users | SITES',
                'isSubPage' => true,
                'active' => 'accounts',
                'view' => 'manage-users',
                'data' => [
                    'id' => $id,
                    'get_other_users',
                ]
            ],
            'admin/manage/users/add' => [
                'title' => 'Create User | SITES',
                'isSubPage' => true,
                'active' => 'accounts',
                'view' => 'add-users',
                'data' => [
                    'get_positions',
                ]
            ],
            'admin/manage/users/update' => [
                'title' => 'Create User | SITES',
                'isSubPage' => true,
                'active' => 'accounts',
                'view' => 'update-users',
                'data' => [
                    'id' => $id,
                    'get_all_users',
                    'get_positions'
                ]
            ],
            'admin/manage/users/delete' => [
                'title' => 'Create User | SITES',
                'isSubPage' => true,
                'active' => 'accounts',
                'view' => 'delete-users',
                'data' => [
                    'id' => $id,
                    'get_all_users',
                ]
            ],
            'admin/manage/page/home' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-home',
                'data' => [
                    'get_home_images',
                    'get_carousel_images'
                ]
            ],
            'admin/manage/page/home/logo/update' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'update-logo',
                'data' => [
                    'id' => $id,
                    'get_home_images_by_id'
                ]
            ],
            'admin/manage/page/admission' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-admission',
                'data' => [
                    
                ]
            ],
            'admin/manage/page/bulletin' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-bulletin',
                'data' => [
                    'get_bulletin'
                ]
            ],
            'admin/manage/page/bulletin/add' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'add-bulletin',
                'data' => [
                    
                ]
            ],
            'admin/manage/page/bulletin/update' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'update-bulletin',
                'data' => [
                    'id' => $id,
                    'get_bulletin_data',
                    'get_bulletin_images'
                ]
            ],
            'admin/manage/page/bulletin/delete' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'delete-bulletin',
                'data' => [
                    'id' => $id,
                    'get_bulletin_data',
                ]
            ],
            'admin/manage/page/faculty' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-faculty',
                'data' => [
                    'get_faculty'
                ]
            ],
            'admin/manage/page/faculty/add' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'add-faculty',
                'data' => [
                    'get_faculty_positions'
                ]
            ],
            'admin/manage/page/faculty/update' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'update-faculty',
                'data' => [
                    'id' => $id,
                    'get_faculty_by_id',
                    'get_faculty_positions'
                ]
            ],
            'admin/manage/page/faculty/delete' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'delete-faculty',
                'data' => [
                    'id' => $id,
                    'get_faculty_by_id',
                    'get_faculty_positions'
                ]
            ],
            'admin/manage/page/officers' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-officers',
                'data' => [
                    'get_officers'
                ]
            ],
            'admin/manage/page/officers/add' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'add-officers',
                'data' => [
                    'get_positions'
                ]
            ],
            'admin/manage/page/officers/update' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'update-officers',
                'data' => [
                    'id' => $id,
                    'get_officers_by_id',
                    'get_positions'
                ]
            ],
            'admin/manage/page/officers/delete' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'delete-officers',
                'data' => [
                    'id' => $id,
                    'get_officers_by_id',
                    'get_positions'
                ]
            ],
            'admin/manage/page/research' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-research',
                'data' => [
                    
                ]
            ],
            'admin/manage/page/contacts' => [
                'title' => 'Manage Home Content | SITES',
                'isSubPage' => true,
                'active' => 'pages',
                'view' => 'manage-contacts',
                'data' => [
                    'get_contacts'
                ]
            ]

        ];

        // IF PAGE RETURNS / REDIRECT TO HOME ROUTE

        if($uri === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        if($uri === 'admin/signout') {
            session()->remove('session_token');
            return redirect()->to('/admin/login');
        }

        // PREPARE DATA TO BE PASSED TO VIEWS

        $page = $uri;
        $title = $config[$page]['title'];
        $active = $config[$page]['active'];
        $isSubPage = $config[$page]['isSubPage'];
        $view = $config[$page]['view'];
        $id = $config[$page]['data']['id'] ?? '';
        
        $dataController = new DataController();

        if(array_key_exists('id', $config[$page]["data"]) || !empty($config[$page]["data"]["id"])) {
            $db_data = $dataController->init($config[$page]['data'], $id);
        } else {
            $db_data = $dataController->init($config[$page]['data']);
        }
        
        $data = [
            'active' => $page,
            'title' => $title,
            'active' => $active,
            'data' => $db_data
        ];

        // IF ROUTE CONTAINS MAIN PAGES

        if(!$isSubPage) {
            return
            view('App\\Views\\Admin\\templates\\header.php', $data) .
            view('App\\Views\\Admin\\'.$view.'.php') .
            view('App\\Views\\Admin\\templates\\footer.php');
        } else
        {
            // IF ROUTE CONTAINS SUB PAGES

            return
            view('App\\Views\\Admin\\templates\\header.php', $data) .
            view('App\\Views\\Admin\\sub-pages\\'.$view.'.php') .
            view('App\\Views\\Admin\\templates\\footer.php');
        }

    }

    public function index($id = null) {
        
        $uri = $this->request->uri->getPath();

        // IF NOT EMPTY ID MEANING
        // THE CURRENT ROUTE HAS A DATA TO BE FETCHED

        if(!empty($id)) {
            $uri = explode('/', $uri);
            if(is_numeric(end($uri))) {
                array_pop($uri);
            }
            $uri = implode('/', $uri);
        } else {
            $id = session()->get('session_token')["id"] ?? '';
        }

        // PREPARE CONTENT DATA TO BE PASSED TO
        // RENDER PAGE METHOD
        
        return $this->renderPage($uri, $id);
    }

}