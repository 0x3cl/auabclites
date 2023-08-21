<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class UserController extends BaseController {

    protected $validation;

    public function __construct() {
        $this->validation = \Config\Services::validation();
    }

    public function validation($type) {
        
        $ruleType = [
            'createUserRules' => [
                'firstname' => [
                    'label' => 'First Name',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'lastname' => [
                    'label' => 'Last Name',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'position' => [
                    'label' => 'Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|min_length[4]|is_unique[lites_users.username]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters',
                        'is_unique' => '{field} is already taken'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[4]|matches[confirm-password]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters',
                        'matches' => 'Passwords do not match'
                    ]
                ],
                'confirm-password' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'avatar' => [
                    'label' => 'Profile Image',
                    'rules' => 'uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ]
            ],
            'updateProfileRules' => [
                'firstname' => [
                    'label' => 'First Name',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'lastname' => [
                    'label' => 'Last Name',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'position' => [
                    'label' => 'Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                    ]
                ],
            ],
            'updateProfileImageRules' => [
                'file' => [
                    'label' => 'Profile Image',
                    'rules' => 'uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ]
            ]
        ];
   
        if($this->validate($ruleType[$type])) {
           return true;
        } 
        
        return false;

    }
    
    public function add() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('createUserRules')) {

                $files = $this->request->getFile('avatar');
                $filename = $files->getRandomName();
                $table = 'lites_users';
                $uploadPath = './assets/admin/uploads/avatar';
                $model = new CustomModel();
                $data = [
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                    'fname' => $this->request->getPost('firstname'),
                    'lname' => $this->request->getPost('lastname'),
                    'position' => $this->request->getPost('position'),
                    'image_url' => $filename
                ];

                try {
                    if($model->insertData($table, $data) && $files->move($uploadPath, $filename)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'User created successfully',
                        ];
                    }
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }

            }  else {
                $message = array_values($this->validator->getErrors());

                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                ];
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back();
        }
    }

    public function delete() {
        if($this->request->getMethod() === 'post') {
            $model = new CustomModel();
            $id = $this->request->getPost('id');
            try {
                $model->deleteData('lites_users', 'id', $id);
                $flashdata = [
                    'status' => 'success',
                    'message' => 'User deleted successfully',
                ];
            } catch (\Throwable $th) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage(),
                ];
            }
            session()->setFlashData('flashdata', $flashdata);
            return redirect()->to('/admin/manage/users');
        }
    }

    public function update_profile() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('updateProfileRules')) {

                $id = $this->request->getPost('id');                
                $table = 'lites_users';
                $uploadPath = './assets/admin/uploads/avatar';
                $model = new CustomModel();
                $data = [
                    'fname' => $this->request->getPost('firstname'),
                    'lname' => $this->request->getPost('lastname'),
                    'position' => $this->request->getPost('position'),
                ];


                try {
                    $model->updateData($table, 'lites_users.id', $id, $data);
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'user&apos;s profile information updated successfully',
                    ];
                } catch (\Exception $e) {
                    
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }
                    
                session()->setFlashData('flashdata', $flashdata);
                return redirect()->back();
            }    
            
        }
    }

    public function update_profile_image() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('updateProfileImageRules')) {

                $id = $this->request->getPost('id');
                $files = $this->request->getFile('avatar');
                $filename = $files->getRandomName();
                $table = 'lites_users';
                $uploadPath = './assets/admin/uploads/avatar';
                $model = new CustomModel();

                $data = [
                    'image_url' => $filename
                ];

                $filter = [
                    '0' => [
                        'field' => 'id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ];

                try {
                    $previous_image = $model->getData('lites_users', $filter)[0]->image_url;
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }

                if (!empty($previous_image)) {
                    if(file_exists($uploadPath . '/' . $previous_image)) {
                        unlink($uploadPath . '/' . $previous_image);
                    }
                }
                
                try {
                    if($model->updateData($table, 'id', $id, $data) && $files->move($uploadPath, $filename)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'user&apos;s profile image updated successfully',
                        ];
                    } else {
                        $flashdata = [
                            'status' => 'error',
                            'message' => 'error: failed to move user&apos;s profile image',
                        ];
                    }
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }
                    
            }  else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                ];
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back();
        }
    }

}