<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthAdminFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
    
        $session_token = session()->get('session_token');
        
        $route = $request->uri->getPath();

        if ($route === 'admin/login') {
            return;
        }
        
        $config  = [
            '1' => [
                'admin/dashboard',
                'admin/manage/users',
                'admin/manage/page',
                'admin/manage/report',
                'admin/signout'
            ],
            '2' => [
                'admin/dashboard',
                'admin/manage/users',
                'admin/manage/page',
                'admin/manage/report',
                'admin/signout'
            ],
            '3' => [
                'admin/dashboard',
                'admin/manage/users',
                'admin/manage/page',
                'admin/manage/report',
                'admin/signout'
            ],
            '4' => [
                'admin/dashboard',
                'admin/manage/users',
                'admin/manage/page',
                'admin/manage/report',
                'admin/signout'
            ],
            '5' => [
                'admin/dashboard',
                'admin/manage/page',
                'admin/signout'
            ],
            '6' => [
                'admin/dashboard',
                'admin/manage/page',
                'admin/signout'
            ],
            '7' => [
                'admin/dashboard',
                'admin/manage/page',
                'admin/signout'
            ],
            '8' => [
                'admin/dashboard',
                'admin/manage/page',
                'admin/signout'
            ],
            '9' => [
                'admin/dashboard',
                'admin/manage/page',
                'admin/signout'
            ]
        ];

        if (empty($session_token)) {
            return redirect()->to('/admin/login');
        } else {
            $user_position = $session_token["position"];
        
            // Check if the user's position exists in the configuration
            if (!array_key_exists($user_position, $config)) {
                // Handle invalid user position here
                // For example, redirect to a default page or show an error message
            }
        
            $allowed = $config[$user_position];

            $isAllowed = false;
        
            if ($route !== 'admin/notify') {
                $isAllowed = false;
        
                foreach ($allowed as $value) {
                    if (strpos($route, $value) === 0) {
                        $isAllowed = true;
                        break;
                    }
                }
        
                if (!$isAllowed) {
                    $flashdata = [
                        'route_visited' => $route,
                        'position' => $user_position,
                        'allowed' => $allowed
                    ];
                    session()->setFlashData('notify', $flashdata);
                    return redirect()->to('/admin/notify');
                }
            }
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Code to execute after the route has been accessed
    }
}
