<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/format.php");
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
            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                echo "<span class='success'>Image Inserted Successfully.
                </span>";
            } else {
                echo "<span class='error'>Image Not Inserted !</span>";
            }
        }
    }

    public function productList() {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_category
        ON tbl_product.catId= tbl_category.catId
        INNER JOIN tbl_brand
        on tbl_product.brandID= tbl_brand.brandId
        order by tbl_product.productId desc";
        $result = $this->db->insert($query);
        return $result;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM tbl_product where productId = '$id' ";
        $result = $this->db->insert($query);
        return $result;
    }

    public function productUpdate($data, $file, $id) {
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

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            if (!empty($file_name)) {

                if ($file_size > 1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-"
                    . implode(', ', $permited) . "</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET
                productName='$productName',
                catId='$catId',
                brandId='$brandId',
                body='$body',
                price='$price',
                image='$uploaded_image',
                type='$type'
                WHERE productId='$id'";
                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        $msg = "<span class='success'>Data Updated Successfully.
                </span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Data Not Updated !</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product SET
                productName='$productName',
                catId='$catId',
                brandId='$brandId',
                body='$body',
                price='$price',
                type='$type'
                WHERE productId='$id'";
                $updated_rows = $this->db->update($query);
                if ($updated_rows) {
                    $msg = "<span class='success'>Data Updated Successfully.
                </span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Data Not Updated !</span>";
                    return $msg;
                }
            }
        }

    }


    public function delProById($id){
        $query="SELECT * FROM tbl_product Where productId='id'";
        $getData= $this->db->select($query);
        if($getData){
            while($delImg=$getData->fetch_assoc()){
                $delLink=$delImg['image'];
                unlink($delLink);
            }

        }
        $query="DELETE FROM tbl_product WHERE productId='$id'";
        $delData=$this->db->delete($query);
        if ($delData) {
            $msg = "Product Deleted Successfully";
            return $msg;
        } else {
            $msg = "Product not Deleted";
            return $msg;
        }
    
    }


    public function getFeaturedProduct(){
        $query = "SELECT * FROM tbl_product where type='0' order by productId desc limit 4";
        $result = $this->db->insert($query);
        return $result; 
    }
    public function getNewProduct(){
        $query = "SELECT * FROM tbl_product order by productId desc limit 4";
        $result = $this->db->insert($query);
        return $result; 
    }
    
    public function getSingleProduct($id){
        $query ="SELECT p.*, c.catName, b.brandName
        FROM tbl_product as p, tbl_category as c, tbl_brand as b
        WHERE p.catId=c.catId AND p.brandId= b.brandId AND p.productId='$id'";
        $result=$this->db->select($query);
        return $result;
    }

    public function getLatestlaptop(){
        $query = "SELECT * FROM tbl_product where brandId='2' order by productId desc limit 1";
        $result = $this->db->insert($query);
        return $result; 
    }
    public function getLatestDesktop(){
        $query = "SELECT * FROM tbl_product where brandId='3' order by productId desc limit 1";
        $result = $this->db->insert($query);
        return $result; 
    }
    public function getLatestTablet(){
        $query = "SELECT * FROM tbl_product where brandId='5' order by productId desc limit 1";
        $result = $this->db->insert($query);
        return $result; 
    }
    public function getLatestMobile(){
        $query = "SELECT * FROM tbl_product where brandId='6' order by productId desc limit 1";
        $result = $this->db->insert($query);
        return $result; 
    }

public function productByCat($id){
    $catId = mysqli_real_escape_string($this->db->link, $id);
    $query="SELECT * FROM tbl_product Where catId='$catId'";
    $result= $this->db->select($query);
    return $result;
}





    }



?>