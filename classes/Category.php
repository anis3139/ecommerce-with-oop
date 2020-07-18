<?php

include "../lib/Database.php";
include "../helpers/format.php";

class Category {
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }
    public function catInsert($catName) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $loginmsg = "Username or Password must not be empty";
            return $loginmsg;
        } else {
            $query = "INSERT INTO tbl_category(catName) values('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "Category insert successfully";
                return $msg;
            } else {
                $msg = "Category not inserted";
                return $msg;
            }
        }
    }
}