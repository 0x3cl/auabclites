<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class FacultyController extends BaseController {

    public function validation($type)
    {
        $rules = [
            'add' => [
                'image' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[image]|max_size[image,5000]|is_image[image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
                'firstname' => [
                    'label' => 'First Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'lastname' => [
                    'label' => 'Last Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'position' => [
                    'label' => 'Position',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_numeric' => '{field} is invalid'
                    ]
                ]
            ],
            'update_image' => [
                'image' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[image]|max_size[image,5000]|is_image[image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
            ],
            'update_data' => [
                'firstname' => [
                    'label' => 'First Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'lastname' => [
                    'label' => 'Last Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'position' => [
                    'label' => 'Position',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_numeric' => '{field} is invalid'
                    ]
                ]
            ]
        ];

        if($this->validate($rules[$type]))
        {
            return true;
        }

        return false;
    }

    public function add() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('add')){
                $image = $this->request->getFile('image');
                $filename = $image->getRandomName();
                $path = './assets/home/images/faculty/';
                $data = [
                    'image' => $filename,
                    'first_name' => $this->request->getPost('firstname'),
                    'last_name' => $this->request->getPost('lastname'),
                    'position_id' => $this->request->getPost('position')
                ];

                $model = new CustomModel();

                try {
                    if($model->insertData('lites_faculty', $data)
                    && $image->move($path, $filename)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'faculty successfully added'
                        ];
                    } 
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'Error: ' . $e
                    ];
                }
               
            } else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'scrollTo' => 'update-banner'
                ];
            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->back();

        }
    }

    public function update_image() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('update_image')) {
                $id = $this->request->getPost('id');
                $image = $this->request->getFile('image');
                $filename = $image->getRandomName();
                $path = './assets/home/images/faculty/';

                $model = new CustomModel;

                $condition = [
                    [
                        'column' => 'lites_faculty.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ];

                $previous_image = $model->getData('lites_faculty', NULL, $condition)[0]->image;

                if(!empty($previous_image)) {
                    unlink($path . $previous_image);   
                }

                $data = [
                    'image' => $filename
                ];

                try  {
                    if($model->updateData('lites_faculty', 'lites_faculty.id', $id, $data)
                        && $image->move($path, $filename))
                    {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'image successfully updated'
                        ];
                    }
                } catch (Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage()
                    ];
                }
            } else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'scrollTo' => 'update-banner'
                ];
            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->back();

        }
    }

    public function update_data() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('update_data')) {
            
                $id = $this->request->getPost('id');                
                $data = [
                    'first_name' => $this->request->getPost('firstname'),
                    'last_name' => $this->request->getPost('lastname'),
                    'position_id' => $this->request->getPost('position')
                ];

                $model = new CustomModel;

                try {
                    if($model->updateData('lites_faculty', 'lites_faculty.id', $id, $data)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'faculty&apos;s information updated successfully'
                        ];
                    }
                } catch (Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage()
                    ];
                }

            } else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'scrollTo' => 'update-banner'
                ];
            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->back();

        }
    }

    public function delete() {
        if($this->request->getMethod() === 'post') {
            
            $id = $this->request->getPost('id');
            $model = new CustomModel;

            try {
                if($model->deleteData('lites_faculty', ['id' => $id])) {
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'faculty successfully deleted'
                    ];
                }
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage()
                ];
            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->to('/admin/manage/page/faculty');
            
        }
    }

}