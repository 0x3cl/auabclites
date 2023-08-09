<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;

class ViewsController extends BaseController {

    public function renderPage($content) {
        
        // CONFIG FOR RENDERING PAGE
        // INCLUDES TITLE OF EVERY ROUTES
        // IF PAGE IS SUB PAGE OR MAIN PAGE
        // AND VIEW NAME UNDER ITS DESIGNATED VIEWS FOLDER

        $config = [
            'home' => [
                'title' => 'SITES | LITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'home'
            ],
            'admission' => [
                'title' => 'ADMISSION | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'admmission'
            ],
            'news' => [
                'title' => 'NEWS | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'news'
            ],
            'faculty' => [
                'title' => 'FACULTY | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'faculty'
            ],
            'officers' => [
                'title' => 'OFFICERS | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'officers'
            ],
            'research' => [
                'title' => 'RESEARCH | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => false,
                'view' => 'research'
            ],
            'research/view' => [
                'title' => 'RESEARCH | SITES | Arellano University - Andres Bonifacio Campus',
                'isSubPage' => true,
                'view' => 'view-research'
            ],
        ];

        // IF PAGE RETURNS / REDIRECT TO HOME ROUTE

        if($content['page'] === '/') {
            return redirect()->to('/home');
        }

        // PREPARE DATA TO BE PASSED TO VIEWS

        $page = $content['page'];
        $title = $config[$page]['title'];
        $isSubPage = $config[$page]['isSubPage'];
        $view = $config[$page]['view'];

        $data = [
            'active' => $page,
            'title' => $title,
            'data' => $content['data']
        ];

        // IF ROUTE CONTAINS MAIN PAGES

        if(!$isSubPage) {
            return
            view('App\\Views\\Home\\templates\\header.php', $data) .
            view('App\\Views\\Home\\'.$view.'.php') .
            view('App\\Views\\Home\\templates\\footer.php');
        }

        // IF ROUTE CONTAINS SUB PAGES

        return
            view('App\\Views\\Home\\templates\\header.php', $data) .
            view('App\\Views\\Home\\sub-pages\\'.$view.'.php') .
            view('App\\Views\\Home\\templates\\footer.php');

    }

    public function fetchData($req) {
        $page = $req['page'];
        $id = $req['id'];
        
        if($page == 'research/view') {

            // MODEL 
            // DO QUERY
            // RETRIEVE DATA
            // RETURN DATA
        }

        // OTHER FETCH 

    }

    public function index($id = null) {
        $segments = $this->request->uri->getSegments();
        $page = $segments[0] . (isset($segments[1]) ? '/' . $segments[1] : '');

        // IF NOT EMPTY ID MEANING
        // THE CURRENT ROUTE HAS A DATA TO BE FETCHED

        if(!empty($id)) {
            $req = [
                'page' => $page,
                'id' => $id
            ];
            $data = $this->fetchData($req);
        }

        // PREPARE CONTENT DATA TO BE PASSED TO
        // RENDER PAGE METHOD

        $content = [
            'page' => $page,
            'data' => '',
        ];

        return $this->renderPage($content);
    }

}