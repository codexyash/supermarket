<?php

namespace Application\Models;

class Products extends Model {

    public $table = 'products';

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        return $this->db
                        ->ObjectBuilder()
                        ->orderBy('id', 'desc')
                        ->get($this->table);
    }

    public function getById($id) {
        return $this->db
                        ->ObjectBuilder()
                        ->where('id', $id)
                        ->getOne($this->table);
    }

}
