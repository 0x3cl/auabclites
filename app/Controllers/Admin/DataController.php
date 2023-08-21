<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class DataController extends BaseController {

    
    public function init($target, $id = null) {
        return $this->fetchData($target, $id);
    }

    public function listData($target, $id = null) {
        
        $data = [
            'get_positions' => [
                'table' => 'lites_positions',
            ],
            'get_faculty' => [
                'table' => 'lites_faculty',
                'filter' => '',
                'join' => [
                    '0' => [
                        'table' => 'lites_faculty_positions',
                        'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                        'join' => 'lites_faculty.position_id = lites_faculty_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_faculty_by_id' => [
                'table' => 'lites_faculty',
                'filter' => [
                    '0' => [
                        'field' => 'lites_faculty.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_faculty_positions',
                        'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                        'join' => 'lites_faculty.position_id = lites_faculty_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_faculty_positions' => [
                'table' => 'lites_faculty_positions',
            ],
            'get_home_images' => [
                'table' => 'lites_images',
            ],
            'get_home_images_by_id' => [
                'table' => 'lites_images',
                'filter' => [
                    '0' => [
                        'field' => 'lites_images.id',
                        'isNot' => 'false',
                        'value' => $id
                    ],

                ],
                'join' => '',
                'group' => ''
            ],
            'get_all_users' => [
                'table' => 'lites_users',
                'filter' => [
                    '0' => [
                        'field' => 'lites_users.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_positions',
                        'select' => 'lites_users.id, lites_users.username, lites_users.fname, lites_users.lname, lites_users.image_url, lites_positions.name as position_name, lites_positions.id as position_id, lites_users.password',
                        'join' => 'lites_users.position = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_other_users' => [
                'table' => 'lites_users',
                'filter' => [
                    '0' => [
                        'field' => 'lites_users.id',
                        'isNot' => 'true',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_positions',
                        'select' => 'lites_users.id, lites_users.username, lites_users.fname, lites_users.lname, lites_users.image_url, lites_positions.name as position_name, lites_positions.id as position_id, lites_users.password',
                        'join' => 'lites_users.position = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_contacts' => [
                'table' => 'lites_contacts',
            ],
            'get_carousel_images' => [
                'table' => 'lites_carousel_images',
            ],
            'get_bulletin' => [
                'table' => 'lites_bulletin',
                'filter' => [
                    '0' => [
                        'field' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'false',
                        'value' => 1
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_bulletin_image',
                        'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, lites_bulletin.content, lites_bulletin.date_created, lites_bulletin_image.image',
                        'join' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => ''
                    ]
                ],
                'group' => ''
            ],
            'get_bulletin_data' => [
                'table' => 'lites_bulletin',
                'filter' => [
                    '0' => [
                        'field' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'false',
                        'value' => 1
                    ],
                    '1' => [
                        'field' => 'lites_bulletin.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_bulletin_image',
                        'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, lites_bulletin_image.is_banner, lites_bulletin.content, lites_bulletin_image.image, lites_bulletin.date_created',
                        'join' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    '0' => [
                        'by' => 'lites_bulletin.id'
                    ]
                ]
            ],
            'get_bulletin_images' => [
                'table' => 'lites_bulletin',
                'filter' => [
                    '0' => [
                        'field' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'true',
                        'value' => 1
                    ],
                    '1' => [
                        'field' => 'lites_bulletin.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_bulletin_image',
                        'select' => 'lites_bulletin.id, lites_bulletin_image.id as image_id, lites_bulletin_image.is_banner, lites_bulletin_image.image',
                        'join' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    
                ]
            ],
            'get_officers' => [
                'table' => 'lites_officers',
                'filter' => '',
                'join' => [
                    '0' => [
                        'table' => 'lites_positions',
                        'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, lites_positions.id as position_id, lites_positions.name as position',
                        'join' => 'lites_officers.position_id = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_officers_by_id' => [
                'table' => 'lites_officers',
                'filter' => [
                    '0' => [
                        'field' => 'lites_officers.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    '0' => [
                        'table' => 'lites_positions',
                        'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, lites_positions.id as position_id, lites_positions.name as position',
                        'join' => 'lites_officers.position_id = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ]

        ];

        $data_origin = [];

        if(array_key_exists('id', $target)) {
            unset($target["id"]);
        }

        foreach($target as $value) {
            if(array_key_exists($value, $data)) {
                $data_origin[] = $data[$value];
            } else {
                $data_origin[] = [];
            }
        }


        return $data_origin;

    }

    public function fetchData($target, $id = null) {
        
        $model = new CustomModel;

        $list = $this->listData($target, $id);
        $data = [];

        if (!empty($list)) {
            foreach ($list as $key => $value) {
                if (array_key_exists($key, $target) && array_key_exists('table', $value)) {
                    if (array_key_exists('filter', $value) || array_key_exists('join', $value) || array_key_exists('group', $value)) {
                        $data[$target[$key]] = $model->getData($value['table'], $value["filter"], $value["join"], $value['group']);
                    } else {
                        $data[$target[$key]] = $model->getData($value['table']);
                    }
                }
            }
        }
        
        return $data;

    }

}