<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class BulletinController extends BaseController {

    protected $validation;

    public function __construct() {
        $this->validation = \Config\Services::validation();
    }

    public function validation($category = NULL) {
                    
        $initRule = [
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} cannot be blank',
                ]
            ]
        ];
    
        $ruleType = [
            'announcements' => [
                'category' => [
                    'label' => 'Category',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                    ]
                ],
                'title' => [
                    'label' => 'Title',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'content' => [
                    'label' => 'Content',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'banner-image' => [
                    'label' => 'Banner Image',
                    'rules' => 'uploaded[banner-image]|max_size[banner-image,5000]|is_image[banner-image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
            ],
            'news' => [
                'category' => [
                    'label' => 'Category',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                    ]
                ],
                'title' => [
                    'label' => 'Title',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'content' => [
                    'label' => 'Content',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'banner-image' => [
                    'label' => 'Banner Image',
                    'rules' => 'uploaded[banner-image]|max_size[banner-image,5000]|is_image[banner-image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
                'content-image[]' => [
                    'label' => 'Content Image',
                    'rules' => 'uploaded[content-image]|max_size[content-image,5000]|is_image[content-image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
                
            ],
            'update_announcements' => [
                'category' => [
                    'label' => 'Category',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                    ]
                ],
                'title' => [
                    'label' => 'Title',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
                'content' => [
                    'label' => 'Content',
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => '{field} cannot be blank',
                        'min_length' => '{field} must be atleast 4 characters'
                    ]
                ],
            ],
            'update_banner' => [
                'banner-image' => [
                    'label' => 'Banner Image',
                    'rules' => 'uploaded[banner-image]|max_size[banner-image,5000]|is_image[banner-image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
            ],
            'add_image' => [
                'content-image[]' => [
                    'label' => 'Content Image',
                    'rules' => 'uploaded[content-image]|max_size[content-image,5000]|is_image[content-image]',
                    'errors' => [
                        'uploaded' => '{field} is required',
                        'max_size' => '{field} size exceeds the allowed limit',
                        'is_image' => '{field} must be a valid image file'
                    ]
                ],
            ]
        ];
   
        if(!$category) {
            if($this->validate($initRule)) {
                $category = $this->request->getPost('category');
                if($this->validate($ruleType[$category])) {
                    return true;
                }
                return false;
            } 
        } else {
            if($this->validate($ruleType[$category])) {
                return true;
            }
        }

        return false;
    }
    
    public function add() {
        if($this->request->getMethod() === 'post') {
            if($this->validation()) {

                $data = $this->request->getPost();
                $category = $this->request->getPost('category');

                switch($category) {
                    case 'announcements':
                        $files = $this->request->getFile('banner-image');
                        return $this->upload_announcements($data, $files);
                        break;
                    case 'news': 
                        $files = [
                            'banner-image' => $this->request->getFile('banner-image'),
                            'content-image' => $this->request->getFileMultiple('content-image')
                        ];
                        return $this->upload_news($data, $files);
                        break;
                }
            } else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'isNews' => $this->request->getPost('category') == 'news' ? 'true' : 'false'
                ];

                session()->setFlashData('flashdata', $flashdata);
                return redirect()->back();
            }

            
        }
    }

    public function upload_announcements($data, $files) {
    
        $filename = $files->getRandomName();
        $uploadPath = './assets/home/images/bulletin/announcements';
    
        $data_content = [
            'category' => '1',
            'title' => $data['title'],
            'content' => $data['content'],
        ];

        $model = new CustomModel();

        $insert_id = $model->insertData('lites_bulletin', $data_content);
    
        if ($insert_id) {
            $data = [
                'bulletin_id' => $insert_id,
                'image' => $filename,
                'is_banner' => 1
            ];
    
            try {
                $model->insertData('lites_bulletin_image', $data);
                $files->move($uploadPath, $filename);
                $flashdata = [
                    'status' => 'success',
                    'message' => 'bulletin for announcement created successfully',
                ];
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage(),
                ];
            }

        } else {
            $flashdata = [
                'status' => 'error',
                'message' => 'An error occurred during insertion process',
            ];
        }
    
        session()->setFlashData('flashdata', $flashdata);
        return redirect()->back(); 
    }
    
    public function upload_news($data, $files) {

        $banner_file = $files["banner-image"];
        $content_file = $files["content-image"];
        $banner_filename = $banner_file->getRandomName();
        $uploadPath = './assets/home/images/bulletin/news';

        $data_content = [
            'category' => '2',
            'title' => $data['title'],
            'content' => $data['content']
        ];
    
        $model = new CustomModel();
    
        try {
            $insert_id = $model->insertData('lites_bulletin', $data_content);
            if ($insert_id && $banner_file->move($uploadPath, $banner_filename)) {

                $images[] = [
                    'bulletin_id' => $insert_id,
                    'image' => $banner_filename,
                    'is_banner' => 1,
                ];
    
                foreach($content_file as $files) {
                    $filename = $files->getRandomName();
                    $images[] = [
                        'bulletin_id' => $insert_id,
                        'image' => $filename,
                        'is_banner' => 0
                    ];
                    $files->move($uploadPath, $filename);
                }
    
                try {
                    $model->insertDataBatch('lites_bulletin_image', $images);
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'Bulletin for news created successfully',
                    ];
                } catch (\Execption $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }        
               
            }
        } catch (\Exception $e) {
            $flashdata = [
                'status' => 'error',
                'message' => 'error: ' . $e->getMessage(),
            ];
        }

       
        session()->setFlashData('flashdata', $flashdata);
        return redirect()->back(); 
    }

    public function update() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('update_announcements')) {

                $data = $this->request->getPost();
                $cat_id = ($data['category'] == 'announcements' ?  1 : ($data['category']  == 'news' ? 2 : ''));
                $prepared_data = [
                    'category' => $cat_id,
                    'title' => $data['title'],
                    'content' => $data['content']
                ];

                try {
                    $model = new CustomModel;
                    $model->updateData('lites_bulletin', 'lites_bulletin.id', $data['id'], $prepared_data);
                    $flashdata = [
                        'status' => 'success',
                        'message' => $data['category'] . ' successfully updated',
                        'fields' => $this->request->getPost(),
                        'isNews' => $this->request->getPost('category') == 'news' ? 'true' : 'false',
                        'scrollTo' => 'form-details'
                    ];
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                        'fields' => $this->request->getPost(),
                        'isNews' => $this->request->getPost('category') == 'news' ? 'true' : 'false',
                        'scrollTo' => 'form-details'
                    ];
                }

            } else {

                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'isNews' => $this->request->getPost('category') == 'news' ? 'true' : 'false',
                    'scrollTo' => 'form-details'
                ];

            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->back();
            
        }
    }

    public function update_banner() {
        if($this->request->getMethod() === 'post') {
            if($this->validation('update_banner')) {

                $id = $this->request->getPost('id');
                $file = $this->request->getFile('banner-image');
                
                $join = [
                    [
                        'table' => 'lites_bulletin',
                        'select' => 'lites_bulletin.category, lites_bulletin_image.image, lites_bulletin_image.id',
                        'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => ''
                    ]
                ];

                $condition = [
                    [
                        'field' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'false',
                        'value' => 1
                    ],
                    [
                        'field' => 'lites_bulletin_image.bulletin_id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ];

                $model = new CustomModel;

                try {
                    $temp_data = $model->getData('lites_bulletin_image', $join, $condition);
                    $previous_id = $temp_data[0]->id;
                    $previous_image = $temp_data[0]->image;
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error ' . $e->getMessage(),
                        'scrollTo' => 'form-banner'
                    ];
                }

                $path = format_bulletin_category($temp_data[0]->category);
                $uploadPath = './assets/home/images/bulletin/'.$path.'/';

                if(!empty($temp_data[0]->image)) {
                    unlink($uploadPath . $previous_image);
                }

                $filename = $file->getRandomName();

                $prepared_data = [
                    'image' => $filename
                ];

                try {
                    $model->updateData('lites_bulletin_image', 'lites_bulletin_image.id', $previous_id, $prepared_data);
                    if($file->move($uploadPath, $filename)) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'image banner updated successfully',
                            'scrollTo' => 'form-banner'
                        ];
                    } else {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'error: failed to move image banner',
                            'scrollTo' => 'form-banner'
                        ];
                    }
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                        'scrollTo' => 'form-banner'
                    ];
                }

            } else {

                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'isNews' => $this->request->getPost('category') == 'news' ? 'true' : 'false',
                    'scrollTo' => 'form-banner'
                ];
                
            }

            session()->setFlashdata('flashdata', $flashdata);
            return redirect()->back();
            
        }
        
    }

    public function delete_image() {
        if($this->request->getMethod() === 'post') {

            $id = $this->request->getPost('id');
            $join = [
                [
                    'table' => 'lites_bulletin',
                    'select' => 'lites_bulletin.category, lites_bulletin_image.image, lites_bulletin_image.id',
                    'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                    'type' => ''
                ]
            ];

            $condition = [
                [
                    'column' => 'lites_bulletin_image.id',
                    'isNot' => 'false',
                    'value' => $id
                ]
            ];

            $model = new CustomModel;

            try {
                $temp_data = $model->getData('lites_bulletin_image', $join, $condition);
                $previous_id = $temp_data[0]->id;
                $previous_image = $temp_data[0]->image;
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage(),
                    'scrollTo' => 'form-image'
                ];
            }

            $path = format_bulletin_category($temp_data[0]->category);
            $uploadPath = './assets/home/images/bulletin/'.$path.'/';

            try {

                $model->deleteData('lites_bulletin_image', ['id' => $id]);
                unlink($uploadPath . $previous_image);
                $flashdata = [
                    'status' => 'success',
                    'message' => 'Image content deleted successfully',
                    'scrollTo' => 'form-image'
                ];

            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage(),
                    'scrollTo' => 'form-image'
                ];
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back();

        }
    }  

    public function add_image() {
        if($this->request->getMethod() === 'post') {

            if($this->validation('add_image')) {
                
                $id = $this->request->getPost('id');
                $files = $this->request->getFileMultiple('content-image');
                $uploadPath = './assets/home/images/bulletin/news';

                $model = new CustomModel;

                foreach($files as $file) {
                    $filename = $file->getRandomName();
                    $images[] = [
                        'bulletin_id' => $id,
                        'image' => $filename,
                        'is_banner' => 0
                    ];
                    $file->move($uploadPath, $filename);
                }

                try {
                    $model->insertDataBatch('lites_bulletin_image', $images);
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'Bulletin images for news added successfully',
                        'scrollTo' => 'form-add-image'
                    ];
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                        'scrollTo' => 'form-add-image'
                    ];
                }

            } else {

                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                    'fields' => $this->request->getPost(),
                    'scrollTo' => 'form-add-image'
                ];
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back(); 
            
        }
    }
  
    public function delete() {
        if($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');

            $model = new CustomModel;

            try {
                if($model->deleteData('lites_bulletin', ['id' => $id])
                    && $model->deleteData('lites_bulletin_image', ['bulletin_id' => $id])) {
                
                    $flashdata = [
                        'status' => 'success',
                        'message' => 'Bulletin deleted successfully',
                    ];    
                }
            } catch (\Exception $e) {
                $flashdata = [
                    'status' => 'error',
                    'message' => 'error: ' . $e->getMessage(),
                ];    
            }

            session()->setFlashData('flashdata', $flashdata);
            return redirect()->to('/admin/manage/page/bulletin'); 

        }
    }

}