<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class DataController extends BaseController {

    
    public function init($target, $id = NULL) {
        return $this->getData($target, $id);
    }

    public function dataHandler($target, $id = NULL) {
        
        $builder = [
            'get_positions' => [
                'table' => 'lites_positions',
            ],
            'get_faculty' => [
                'table' => 'lites_faculty',
                'conditions' => '',
                'join' => [
                    [
                        'table' => 'lites_faculty_positions',
                        'select' => 'lites_faculty.id, lites_faculty.image, lites_faculty.first_name, lites_faculty.last_name, lites_faculty_positions.id as position_id, lites_faculty_positions.position as position',
                        'on' => 'lites_faculty.position_id = lites_faculty_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_faculty_by_id' => [
                'table' => 'lites_faculty',
                'conditions' => [
                    [
                        'column' => 'lites_faculty.id',
                        'isNot' => 'false',
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
                'conditions' => [
                    [
                        'column' => 'lites_images.id',
                        'isNot' => 'false',
                        'value' => $id
                    ],

                ],
                'on' => '',
                'group' => ''
            ],
            'get_all_users' => [
                'table' => 'lites_users',
                'conditions' => [
                    [
                        'column' => 'lites_users.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_positions',
                        'select' => 'lites_users.id, lites_users.username, lites_users.fname, lites_users.lname, lites_users.image_url, lites_positions.name as position_name, lites_positions.id as position_id, lites_users.password',
                        'on' => 'lites_users.position = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_other_users' => [
                'table' => 'lites_users',
                'conditions' => [
                    [
                        'column' => 'lites_users.id',
                        'isNot' => 'true',
                        'value' => $id
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_positions',
                        'select' => 'lites_users.id, lites_users.username, lites_users.fname, lites_users.lname, lites_users.image_url, lites_positions.name as position_name, lites_positions.id as position_id, lites_users.password',
                        'on' => 'lites_users.position = lites_positions.id',
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
                'conditions' => [
                    [
                        'column' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'false',
                        'value' => 1
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_bulletin_image',
                        'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, lites_bulletin.content, lites_bulletin.date_created, lites_bulletin_image.image',
                        'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => ''
                    ]
                ],
                'group' => ''
            ],
            'get_bulletin_data' => [
                'table' => 'lites_bulletin',
                'conditions' => [
                    [
                        'column' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'false',
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
                        'select' => 'lites_bulletin.id, lites_bulletin.category, lites_bulletin.title, lites_bulletin_image.is_banner, lites_bulletin.content, lites_bulletin_image.image, lites_bulletin.date_created',
                        'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    [
                        'by' => 'lites_bulletin.id'
                    ]
                ]
            ],
            'get_bulletin_images' => [
                'table' => 'lites_bulletin',
                'conditions' => [
                    [
                        'column' => 'lites_bulletin_image.is_banner',
                        'isNot' => 'true',
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
                        'select' => 'lites_bulletin.id, lites_bulletin_image.id as image_id, lites_bulletin_image.is_banner, lites_bulletin_image.image',
                        'on' => 'lites_bulletin.id = lites_bulletin_image.bulletin_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    
                ]
            ],
            'get_officers' => [
                'table' => 'lites_officers',
                'conditions' => '',
                'join' => [
                    [
                        'table' => 'lites_positions',
                        'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, lites_positions.id as position_id, lites_positions.name as position',
                        'on' => 'lites_officers.position_id = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_officers_by_id' => [
                'table' => 'lites_officers',
                'conditions' => [
                    [
                        'column' => 'lites_officers.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_positions',
                        'select' => 'lites_officers.id, lites_officers.image, lites_officers.first_name, lites_officers.last_name, lites_positions.id as position_id, lites_positions.name as position',
                        'on' => 'lites_officers.position_id = lites_positions.id',
                        'type' => 'inner'
                    ]
                ],
                'group' => ''
            ],
            'get_platforms' => [
                'table' => 'lites_platforms'
            ],
            'get_technologies' => [
                'table' => 'lites_technologies'
            ],
            'get_repositories' => [
                'table' => 'lites_repositories'
            ],
            'get_research_data' => [
                'table' => 'lites_research',
                'conditions' => [
                    [
                        'column' => 'lites_research_image.is_banner',
                        'isNot' => 'false',
                        'value' => '1'
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_research_image',
                        'select' => 'lites_research.*, lites_research_image.filename as image',
                        'on' => 'lites_research.id = lites_research_image.research_id',
                        'type' => 'inner'
                    ],
                    [
                        'table' => 'lites_research_platforms',
                        'select' => 'lites_research_platforms.platform_id',
                        'on' => 'lites_research.id = lites_research_platforms.research_id',
                        'type' => 'inner'
                    ],
                    [
                        'table' => 'lites_research_repositories',
                        'select' => 'lites_research_repositories.repositories_id, lites_research_repositories.link',
                        'on' => 'lites_research.id = lites_research_repositories.research_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    [
                        'by' => 'lites_research.id'
                    ]
                ]
            ],
            'get_research_data_by_id' => [
                'table' => 'lites_research',
                'conditions' => [
                    [
                        'column' => 'lites_research_image.is_banner',
                        'isNot' => 'false',
                        'value' => '1'
                    ],
                    [
                        'column' => 'lites_research.id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [
                    [
                        'table' => 'lites_research_image',
                        'select' => 'lites_research.*, lites_research_image.filename as image',
                        'on' => 'lites_research.id = lites_research_image.research_id',
                        'type' => 'inner'
                    ],
                    [
                        'table' => 'lites_research_platforms',
                        'select' => 'lites_research_platforms.platform_id',
                        'on' => 'lites_research.id = lites_research_platforms.research_id',
                        'type' => 'inner'
                    ],
                    [
                        'table' => 'lites_research_repositories',
                        'select' => 'lites_research_repositories.repositories_id, lites_research_repositories.link',
                        'on' => 'lites_research.id = lites_research_repositories.research_id',
                        'type' => 'inner'
                    ]
                ],
                'group' => [
                    [
                        'by' => 'lites_research.id'
                    ]
                ]
            ],
            'get_research_technologies' => [
                'table' => 'lites_research_technologies',
                'conditions' => [
                    [
                        'column' => 'lites_research_technologies.research_id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [],
                'group' => []
            ],
            'get_research_images' => [
                'table' => 'lites_research_image',
                'conditions' => [
                    [
                        'column' => 'lites_research_image.is_banner',
                        'isNot' => 'false',
                        'value' => '0'
                    ],
                    [
                        'column' => 'lites_research_image.research_id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [],
                'group' => []
            ],
            'get_research_authors' => [
                'table' => 'lites_research_authors',
                'conditions' => [
                    [
                        'column' => 'lites_research_authors.research_id',
                        'isNot' => 'false',
                        'value' => $id
                    ]
                ],
                'join' => [],
                'group' => []
            ],
            'get_widgets' => [
                'table' => 'lites_site_widgets'
            ],
            'get_user_widgets' => [
                'table' => 'lites_user_widgets',
                'order_by' => 'widget_id ASC'
            ]


        ];

        $clean_data = [];

        if(array_key_exists('id', $target)) {
            unset($target["id"]);
        }

        foreach($target as $value) {
            if(array_key_exists($value, $builder)) {
                $clean_data[] = $builder[$value];
            } else {
                $clean_data[] = [];
            }
        }

        return $clean_data;
    }

    public function getData($target, $id = NULL) {
        $model = new CustomModel;
        $list = $this->dataHandler($target, $id);
        $data = [];
        if (!empty($list)) {
            foreach ($list as $key => $value) {                 

                if (array_key_exists($key, $target) && array_key_exists('table', $value) || array_key_exists('order_by', $value)) {
                    if (array_key_exists('conditions', $value) || array_key_exists('join', $value) || array_key_exists('group', $value)) {
                        $data[$target[$key]] = $model->getData($value['table'], $value["join"], $value["conditions"], $value['group'], $value["order_by"]);
                    } else {
                        $data[$target[$key]] = $model->getData($value['table']);
                    }
                    if(array_key_exists('table', $value) && array_key_exists('order_by', $value)) {
                        $data[$target[$key]] = $model->getData($value['table'], NULL, NULL, NULL, $value['order_by']);
                    }
                }
            }
        }
        
        return $data;
    }

}