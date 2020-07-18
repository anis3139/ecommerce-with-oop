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
    public function getAllCat() {
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->insert($query);
        return $result;
    }

    public function getCatById($id) {
        $query = "SELECT * FROM tbl_category where catId = '$id' ";
        $result = $this->db->insert($query);
        return $result;
    }

    public function catUpdate($catName, $id) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            $query = "UPDATE tbl_category
            SET
            catName='$catName'
            WHERE catId='$id'";
            $updated_row=$this->db->update($query);
            if ($updated_row) {
                $msg = "Category updated successfully";
                return $msg;
            } else {
                $msg = "Category not Updated";
                return $msg;
            }
        }
    }

    public function delCatById($id){
    $query="DELETE FROM tbl_category WHERE catId='$id'";
    $delData=$this->db->delete($query);
    if ($delData) {
        $msg = "Category Deleted Successfully";
        return $msg;
    } else {
        $msg = "Category not Deleted";
        return $msg;
    }
    }


}