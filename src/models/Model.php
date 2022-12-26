<?php

namespace Models;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = \Config\Database::getConnection();
    }
}