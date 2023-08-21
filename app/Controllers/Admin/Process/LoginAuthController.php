<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\LoginAuthModel;

class LoginAuthController extends BaseController {

    public function login() {
        if($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            if(empty($username || empty($password))) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'username and password cannot be blanked',
                ];                
            } else {
                $model = new LoginAuthModel;
                $data = $model->fetchData('username', $username);
                if(count($data) > 0 && !empty($data)) {
                    $db_password = $data[0]->password;
                    $is_matched = password_verify($password, $db_password);
                    if($is_matched) {
                        $session_token = [
                            'id' => $data[0]->id,
                            'fname' => $data[0]->fname,
                            'lname' => $data[0]->lname,
                            'position' => $data[0]->position,
                            'uname' => $username,
                            'image_url' => $data[0]->image_url
                        ];
                        session()->set('session_token', $session_token);
                        return redirect()->to('/admin/dashboard');
                    } else {
                        $flashdata = [
                            'status' => 'error',
                            'message' => 'invalid username or password',
                        ];
                    }   
                } else {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'username does not exists',
                    ];
                }
            }
            session()->setFlashData('flashdata', $flashdata);
            return redirect()->to('admin/login');

        }
    }

}