<?php namespace lil\App\Models;


use lil\Lib\Database;

abstract class Models{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
}