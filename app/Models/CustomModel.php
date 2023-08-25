<?php

namespace App\Models;
use CodeIgniter\Model;

class CustomModel extends Model {

    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function get_data($data) {

        $builder = $this->db->table($data['table']);

        if(isset($data['select'])) {
            $builder->select($data['select']);
        }

        if(isset($data['join']) && is_array($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if(is_array($value)) {
                    $builder->join($value['table'], $value['on'], $value['type']);
                } else {
                    $builder->join($data['join']['table'], $data['join']['on'], $data['join']['type']);
                    break;
                }
            }
        }

        if(isset($data['condition']) && is_array($data['condition'])) {
            foreach ($data['condition'] as $key => $value) {
                if(is_array($value)) {
                    $builder->where($value['column'], $value['value']);
                } else {
                    $builder->where($data['condition']['column'], $data['condition']['value']);
                    break;
                }
            }
        }

        if(isset($data['order'])) {
            $builder->orderBy($data['order']);
        }

        if(isset($data['group'])) {
            $builder->groupBy($data['group']);
        }

        return $builder->get()->getResult();
    }

    public function getData($table, $join = NULL, $conditions = NULL, $group = NULL, $order = NULL) {
        $builder = $this->db->table($table);
        if(is_array($join)) {
            foreach ($join as $value) {
                if(array_key_exists('select', $value)) {
                    $builder->select($value['select']);
                }
                $builder->join($value['table'], $value['on'], $value['type']);
            }
        }
        if(is_array($conditions)) {
            foreach($conditions as $value) {
                if(array_key_exists('column', $value) && array_key_exists('value', $value)) {
                    if(array_key_exists('isNot', $value) && $value['isNot'] === 'false') {
                        $builder->where($value['column'], $value['value']);
                    } else {
                        $builder->where($value['column'] . '!=', $value['value']);
                    }
                }
            }
        }
        if(is_array($group)) {
            foreach ($group as $value) {
                if(array_key_exists('by', $value)) {
                    $builder->groupBy($value['by']);
                }
            }
        }
        if($order) {
            $builder->orderBy($order);
        }
        return $builder->get()->getResult();

    }

    public function insertData($table, $data) {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function insertDataBatch($table, $data) {
        $builder = $this->db->table($table);
        return $builder->insertBatch($data);
    }

    public function deleteData($table, $condition) {
        $builder = $this->db->table($table);
        if(is_array($condition)) {
            foreach($condition as $key => $value) {
                $builder->where($key, $value);
            }
        }
        
        return $builder->delete();
    }

    public function updateData($table, $where, $value, $data) {
        $builder = $this->db->table($table);
        $builder->where($where, $value);
        return $builder->update($data);
    }

    public function updateDataBatch($table, $data, $param) {
        $builder = $this->db->table($table);
        $builder->updateBatch($data, $param);
        return $this->db->affectedRows();
    } 


}

