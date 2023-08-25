<?php 

namespace App\Controllers\Admin;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;
use App\Models\CustomModel;

class ViewsController extends BaseController {

    protected $model;
    protected $error = [];
    protected $user_data = [];

    public function __construct() {
        $this->model = new CustomModel;
        $this->user_data = session()->get('session_token');
    }


    public function isPageNotExists($view) {
        if(is_array($view)) {

            $page = $view['page'];
            $isSubPage = $view['isSubPage'];
            
            $viewPath = APPPATH . 'Views/Admin/';
            if ($isSubPage === 'false') {
                $viewPath .= $page . '.php';
            } elseif ($isSubPage === 'true') {
                $viewPath .= 'sub-pages/' . $page . '.php';
            }
            
            if (!file_exists($viewPath)) {
                return true;
            } else {
                return false;
            }
            

        }
    }

    public function renderView($view, $data = null) {
        if ($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return 
        view('admin/templates/header') .
        view($view, $data) . 
        view('admin/templates/footer');
        
    }

    public function login($page = 'login') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $render = [
            'title' => 'Admin Login',
            'active' => '',
            'data' => [],
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function dashboard($page = 'dashboard') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['user_widgets'] = $this->model->get_data([
            'table' => 'lites_user_widgets',
            'order' => 'widget_id ASC'
        ]);

        $render = [
            'title' => 'Admin Dashboard',
            'active' => 'dashboard',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function widgets($page = 'widgets') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_widgets'] = $this->model->get_data(['table' => 'lites_site_widgets']);
        $data['get_user_widgets'] = $this->model->get_data(['table' => 'lites_user_widgets']);

        $render = [
            'title' => 'Admin Dashboard',
            'active' => 'widgets',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function manage_users($page = 'manage-users') {

        $view = [
            'page' => ''.$page.'',
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_other_users'] = $this->model->get_data(
            [
                'table' => 'lites_users',
                'select' => 'lites_users.id, lites_users.username, lites_users.fname, 
                            lites_users.lname, lites_users.image_url, lites_positions.name as position_name, 
                            lites_positions.id as position_id, lites_users.password',
                'condition' => [
                    'column' => 'lites_users.id !=',
                    'value' => $this->user_data['id']
                ],
                'join' => [
                    'table' => 'lites_positions',
                    'on' => 'lites_users.position = lites_positions.id',
                    'type' => 'inner'
                ]
            ]
        );

        $render = [
            'title' => 'Manage Users',
            'active' => 'accounts',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function add_users($page = 'add-users') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_positions'] = $this->model->get_data(['table' => 'lites_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'accounts',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function update_users($id, $page = 'update-users') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_all_users'] = $this->model->get_data(
            [
                'table' => 'lites_users',
                'select' => 'lites_users.id, lites_users.username, lites_users.fname, 
                            lites_users.lname, lites_users.image_url, lites_positions.name as position_name, 
                            lites_positions.id as position_id, lites_users.password',
                'condition' => [
                    'column' => 'lites_users.id',
                    'value' => $id
                ],
                'join' => [
                    'table' => 'lites_positions',
                    'on' => 'lites_users.position = lites_positions.id',
                    'type' => 'inner'
                ]
            ]
        );

        $data['get_positions'] = $this->model->get_data(['table' => 'lites_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'accounts',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function delete_users($id, $page = 'delete-users') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_all_users'] = $this->model->get_data(
            [
                'table' => 'lites_users',
                'select' => 'lites_users.id, lites_users.username, lites_users.fname, 
                            lites_users.lname, lites_users.image_url, lites_positions.name as position_name, 
                            lites_positions.id as position_id, lites_users.password',
                'condition' => [
                    'column' => 'lites_users.id',
                    'value' => $id
                ],
                'join' => [
                    'table' => 'lites_positions',
                    'on' => 'lites_users.position = lites_positions.id',
                    'type' => 'inner'
                ]
            ]
        );

        $render = [
            'title' => 'Manage Users',
            'active' => 'accounts',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function manage_home($page = 'manage-home') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_home_images'] = $this->model->get_data(['table' => 'lites_images']);
        $data['get_carousel_images'] = $this->model->get_data(['table' => 'lites_carousel_images']);


        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function manage_bulletin($page = 'manage-bulletin') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_bulletin'] = $this->model->get_data([
            'table' => 'lites_bulletin',
            'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title,
                        lites_bulletin.content, lites_bulletin.date_created, lites_bulletin_image.image',
            'condition' => [
                [
                    'column' => 'lites_bulletin_image.is_banner',
                    'value' => 1
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_bulletin_image',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => 'inner'
                ]
            ],
        ]);


        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function add_bulletin($page = 'add-bulletin') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_bulletin'] = $this->model->get_data([
            'table' => 'lites_bulletin',
            'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title,
                        lites_bulletin.content, lites_bulletin.date_created, lites_bulletin_image.image',
            'condition' => [
                'column' => 'lites_bulletin_image.is_banner',
                'value' => 1
            ],
            'join' => [
                [
                    'table' => 'lites_bulletin_image',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => 'inner'
                ]
            ],
        ]);


        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function update_bulletin($id, $page = 'update-bulletin') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_bulletin_data'] = $this->model->get_data([
            'table' => 'lites_bulletin',
            'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, 
                        lites_bulletin_image.is_banner, lites_bulletin.content, 
                        lites_bulletin_image.image, lites_bulletin.date_created',
            'condition' => [
                [
                    'column' => 'lites_bulletin_image.is_banner',
                    'value' => 1
                ],
                [
                    'column' => 'lites_bulletin.id',
                    'isNot' => 'false',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_bulletin_image',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $data['get_bulletin_images'] = $this->model->get_data([
            'table' => 'lites_bulletin',
            'select' => 'lites_bulletin.id, lites_bulletin_image.id as image_id, 
                        lites_bulletin_image.is_banner, lites_bulletin_image.image',
            'condition' => [
                [
                    'column' => 'lites_bulletin_image.is_banner !=',
                    'value' => 1
                ],
                [
                    'column' => 'lites_bulletin.id',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_bulletin_image',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => 'inner'
                ]
            ],
        ]);


        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function delete_bulletin($id, $page = 'delete-bulletin') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_bulletin_data'] = $this->model->get_data([
            'table' => 'lites_bulletin',
            'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, 
                        lites_bulletin_image.is_banner, lites_bulletin.content, 
                        lites_bulletin_image.image, lites_bulletin.date_created',
            'condition' => [
                [
                    'column' => 'lites_bulletin_image.is_banner',
                    'value' => 1
                ],
                [
                    'column' => 'lites_bulletin.id',
                    'isNot' => 'false',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_bulletin_image',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function manage_faculty($page = 'manage-faculty') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_faculty'] = $this->model->get_data([
            'table' => 'lites_faculty',
                'join' => [
                    [
                        'table' => 'lites_faculty_positions',
                        'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                        'on' => 'lites_faculty.position_id = lites_faculty_positions.id',
                        'type' => 'inner'
                    ]
                ],
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function add_faculty($page = 'add-faculty') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_faculty_positions'] = $this->model->get_data(['table' => 'lites_faculty_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function update_faculty($id, $page = 'update-faculty') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_faculty'] = $this->model->get_data([
            'table' => 'lites_faculty',
            'condition' => [
                [
                    'column' => 'lites_faculty.id',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_faculty_positions',
                    'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                    'on' => 'lites_faculty.position_id = lites_faculty_positions.id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $data['get_faculty_positions'] = $this->model->get_data(['table' => 'lites_faculty_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function delete_faculty($id, $page = 'delete-faculty') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_faculty'] = $this->model->get_data([
            'table' => 'lites_faculty',
            'condition' => [
                [
                    'column' => 'lites_faculty.id',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_faculty_positions',
                    'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                    'on' => 'lites_faculty.position_id = lites_faculty_positions.id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $data['get_faculty_positions'] = $this->model->get_data(['table' => 'lites_faculty_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function manage_officers($page = 'manage-officers') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_officers'] = $this->model->get_data([
            'table' => 'lites_officers',
            'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, 
                        lites_officers.last_name, lites_positions.id as position_id, 
                        lites_positions.name as position',
            'join' => [
                [
                    'table' => 'lites_positions',
                    'on' => 'lites_officers.position_id = lites_positions.id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function add_officers($page = 'add-officers') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_positions'] = $this->model->get_data(['table' => 'lites_positions']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function update_officers($id, $page = 'update-officers') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }
        
        $data['get_positions'] = $this->model->get_data(['table' => 'lites_positions']);
        $data['get_officers'] = $this->model->get_data([
            'table' => 'lites_officers',
            'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, 
                        lites_positions.id as position_id, lites_positions.name as position',
            'condition' => [
                'column' => 'lites_officers.id',
                'value' => $id
            ],                
            'join' => [
                [
                    'table' => 'lites_positions',
                    'on' => 'lites_officers.position_id = lites_positions.id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function delete_officers($id, $page = 'delete-officers') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }
        
        $data['get_positions'] = $this->model->get_data(['table' => 'lites_positions']);
        $data['get_officers'] = $this->model->get_data([
            'table' => 'lites_officers',
            'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, 
                        lites_positions.id as position_id, lites_positions.name as position',
            'condition' => [
                'column' => 'lites_officers.id',
                'value' => $id
            ],                
            'join' => [
                [
                    'table' => 'lites_positions',
                    'on' => 'lites_officers.position_id = lites_positions.id',
                    'type' => 'inner'
                ]
            ],
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function manage_research($page = 'manage-research') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_research_data'] = $this->model->get_data([
            'table' => 'lites_research',
            'select' => 'lites_research.*, lites_research_image.filename as image,
                        lites_research_platforms.platform_id, lites_research_repositories.repositories_id,
                        lites_research_repositories.link',
            'condition' => [
                [
                    'column' => 'lites_research_image.is_banner',
                    'value' => '1'
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_research_image',
                    'on' => 'lites_research.id = lites_research_image.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_platforms',
                    'on' => 'lites_research.id = lites_research_platforms.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_repositories',
                    'on' => 'lites_research.id = lites_research_repositories.research_id',
                    'type' => 'inner'
                ]
            ],
            'group' => 'lites_research.id'
            
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

    public function add_research($page = 'add-research') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }
        
        $data['get_platforms'] = $this->model->get_data(['table' => 'lites_platforms']);
        $data['get_technologies'] = $this->model->get_data(['table' => 'lites_technologies']);
        $data['get_repositories'] = $this->model->get_data(['table' => 'lites_repositories']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function update_research($id, $page = 'update-research') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }
        
        $data['get_research_data'] = $this->model->get_data([
            'table' => 'lites_research',
            'select' => 'lites_research.*, lites_research_image.filename as image,
                        lites_research_platforms.platform_id, lites_research_repositories.repositories_id, 
                        lites_research_repositories.link',
            'condition' => [
                [
                    'column' => 'lites_research_image.is_banner',
                    'value' => '1'
                ],
                [
                    'column' => 'lites_research.id',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_research_image',
                    'on' => 'lites_research.id = lites_research_image.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_platforms',
                    'on' => 'lites_research.id = lites_research_platforms.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_repositories',
                    'on' => 'lites_research.id = lites_research_repositories.research_id',
                    'type' => 'inner'
                ]
            ],
            'group' => 'lites_research.id'
        ]);
        $data['get_research_technologies'] = $this->model->get_data([
            'table' => 'lites_research_technologies',
            'condition' => [
                'column' => 'lites_research_technologies.research_id',
                'value' => $id
            ],
        ]);
        $data['get_research_images'] = $this->model->get_data([
            'table' => 'lites_research_image',
            'condition' => [
                [
                    'column' => 'lites_research_image.is_banner',
                    'value' => '0'
                ],
                [
                    'column' => 'lites_research_image.research_id',
                    'value' => $id
                ]
            ],
        ]);
        $data['get_research_authors'] = $this->model->get_data([
            'table' => 'lites_research_authors',
            'condition' => [
                'column' => 'lites_research_authors.research_id',
                'value' => $id
            ],
        ]);
        $data['get_platforms'] = $this->model->get_data(['table' => 'lites_platforms']);
        $data['get_technologies'] = $this->model->get_data(['table' => 'lites_technologies']);
        $data['get_repositories'] = $this->model->get_data(['table' => 'lites_repositories']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function delete_research($id, $page = 'delete-research') {

        $view = [
            'page' => $page,
            'isSubPage' => 'true',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }
        
        $data['get_research_data'] = $this->model->get_data([
            'table' => 'lites_research',
            'select' => 'lites_research.*, lites_research_image.filename as image,
                        lites_research_platforms.platform_id, lites_research_repositories.repositories_id, 
                        lites_research_repositories.link',
            'condition' => [
                [
                    'column' => 'lites_research_image.is_banner',
                    'value' => '1'
                ],
                [
                    'column' => 'lites_research.id',
                    'value' => $id
                ]
            ],
            'join' => [
                [
                    'table' => 'lites_research_image',
                    'on' => 'lites_research.id = lites_research_image.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_platforms',
                    'on' => 'lites_research.id = lites_research_platforms.research_id',
                    'type' => 'inner'
                ],
                [
                    'table' => 'lites_research_repositories',
                    'on' => 'lites_research.id = lites_research_repositories.research_id',
                    'type' => 'inner'
                ]
            ],
            'group' => 'lites_research.id'
        ]);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/sub-pages/'.$page.'', $render);
    }

    public function manage_contact($page = 'manage-contacts') {

        $view = [
            'page' => $page,
            'isSubPage' => 'false',
        ];

        if($this->isPageNotExists($view)) {
            throw PageNotFoundException::forPageNotFound();    
        }

        $data['get_contacts'] = $this->model->get_data(['table' => 'lites_contacts']);

        $render = [
            'title' => 'Manage Users',
            'active' => 'pages',
            'data' => $data,
        ];

        return $this->renderView('Admin/'.$page.'', $render);
    }

}