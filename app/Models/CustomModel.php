<?php

namespace App\Models;
use CodeIgniter\Model;

class CustomModel extends Model {

    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function getData($table, $hasFilter = null, $hasJoin = null, $hasGroup = null) {
        $builder = $this->db->table($table);

        if(is_array($hasJoin)) {
            foreach ($hasJoin as $join) {
                if(array_key_exists('select', $join)) {
                    $builder->select($join['select']);
                }
                $builder->join($join['table'], $join['join'], $join['type']);
            }
        }

        if(is_array($hasFilter)) {
            foreach($hasFilter as $filter) {
                if(array_key_exists('field', $filter) && array_key_exists('value', $filter)) {
                    if(array_key_exists('isNot', $filter) && $filter["isNot"] === 'false') {
                        $builder->where($filter["field"], $filter["value"]);
                    } else {
                        $builder->where($filter["field"] . '!=', $filter["value"]);
                    }
                }
            }
        }

        if(is_array($hasGroup)) {
            foreach ($hasGroup as $group) {
                if(array_key_exists('by', $group)) {
                    $builder->groupBy($group['by']);
                }
            }
        }

        // print_r($builder->getCompiledSelect());
    
        $result = $builder->get()->getResult();
    
        return $result;
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

    public function deleteData($table, $where, $value) {
        $builder = $this->db->table($table);
        $builder->where($where, $value);
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

