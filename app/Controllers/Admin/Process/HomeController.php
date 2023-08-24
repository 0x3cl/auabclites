<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class HomeController extends BaseController {

    public function validation($type) {
        $rules = [
            'single_image' => [
                'id' => [
                    'label' => 'ID',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required',
                    ]
                ],
                'image' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[image]|max_size[image,5000]|is_image[image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ]
            ],
            'multiple_image' => [
                'images[]' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[images]|max_size[images,5000]|is_image[images]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ]
            ]
        ];

        if($this->validate($rules[$type])) {
            return true;
        }

        return false;

    }

    public function update_banner() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('single_image')) {
                
                $id = $this->request->getPost('id');
                $target = $this->request->getPost('target');
                $file = $this->request->getFile('image');
                $filename = $file->getRandomName();

                $model = new CustomModel;

                $filter = [
                    '0' => [
                        'field' => 'lites_images.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ];

                try {
                    $previous_image = $model->getData('lites_images', $filter)[0]->image;
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }


                if($target == 'banner') {
                    $path = './assets/home/images/banner/';
                } else if ($target == 'logo') {
                    $path = './assets/home/images/logo/';
                }

                $data = [
                    'image' => $filename
                ];

                if(!empty($previous_image)) {
                    unlink($path . $previous_image);
                }
                
                try {
                    $model->updateData('lites_images', 'lites_images.id', $id, $data);
                    if($file->move($path, $filename)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'image banner updated successfully',
                        ];
                    } else {
                        $flashdata = [
                            'status' => 'error',
                            'message' => 'error: failed to move image banner',
                        ];
                    }
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                        'scrollTo' => ''
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

    public function add_carousel() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('multiple_image')) {

                $files = $this->request->getFileMultiple('images');
                $path = './assets/home/images/carousel/';

                $data = [];

                foreach($files as $file) {
                    $filename = $file->getRandomName();
                    $data[] = [
                        'image' => $filename
                    ];
                    
                    $file->move($path, $filename);
                }
                
                $model = new CustomModel;

                try {
                    $model->insertDataBatch('lites_carousel_images', $data);
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'carousel image successfully added',
                        'scrollTo' => ''
                    ];
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                        'scrollTo' => ''
                    ];
                }

            } else {
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

    public function delete_carousel() {
        if($this->request->getMethod() === 'post') {

            $id = $this->request->getPost('id');
            $path = './assets/home/images/carousel/';
            $model = new CustomModel;

            $filter = [
                '0' => [
                    'field' => 'lites_carousel_images.id',
                    'isNot' => 'false',
                    'value' => $id
                ]
            ];

            try {
                $previous_image = $model->getData('lites_carousel_images', $filter)[0]->image;
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error :' . $e->getMessage()
                ];
            }

            if(!empty($previous_image)) {
                unlink($path . $previous_image);
            }

            try {
                $model->deleteData('lites_carousel_images', ['id' => $id]);
                $flashdata = [
                    'status' => 'success',
                    'message' => 'carousel image successfully deleted',
                ];
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error :' . $e->getMessage(),
                ];
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back();
        }
    }

}