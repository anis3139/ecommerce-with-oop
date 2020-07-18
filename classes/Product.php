<?php
include_once "../lib/Database.php";
include_once "../helpers/format.php";
?>

<?php

class Product {
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }

    public function productInsert($data, $file) {
        $productName = $this->fm->validation($data['productName']);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId = $this->fm->validation($data['catId']);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $brandId = $this->fm->validation($data['brandId']);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        //$body = $this->fm->validation($data['body']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = $this->fm->validation($data['price']);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = $this->fm->validation($data['type']);
        $type = mysqli_real_escape_string($this->db->link, $type);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $uploaded_image == "") {
            $msg = "Field must not be empty";
            return $msg;
        } elseif ($file_size > 1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            . implode(', ', $permited) . "</span>";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, brandId, catId, body, price, image, type)
             VALUES('$productName','$brandId', '$catId', '$body',' $price', '$uploaded_image', '$type')";
            $inserted_rows =  $this->db ->insert($query);
            if ($inserted_rows) {
                echo "<span class='success'>Image Inserted Successfully.
                </span>";
            } else {
                echo "<span class='error'>Image Not Inserted !</span>";
            }
        }
    }
}

?>