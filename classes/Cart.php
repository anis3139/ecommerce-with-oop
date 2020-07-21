<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/format.php");
?>


<?php

class Cart{
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }

    public function addToCart($quantity, $id){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId= session_id();

        $squery="SELECT * FROM tbl_product WHERE productId='$productId'";
        $result=$this->db->select($squery)->fetch_assoc();

        $productName=$result['productName'];
        $price=$result['price'];
        $image=$result['image'];

        
        $chquery="SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
        $getpro=$this->db->select($chquery);
        if($getpro){
            $msg="Product Allready Added";
            return $msg;
        }else{

        $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image)
        VALUES('$sId','$productId', '$productName', '$price',' $quantity', '$image')";
       $inserted_rows = $this->db->insert($query);
       if ($inserted_rows) {
           header("Location: cart.php");
       } else {
        header("Location:404.php");
       }
    }
    }



    public function getCartProduct(){
    $sId=session_id();
    $query = "SELECT * FROM tbl_cart where sId = '$sId' ";
    $result = $this->db->insert($query);
    return $result;
    }




    public function updateCartQuantity($cartId, $quantity){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = $this->fm->validation($cartId);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart
            SET
            quantity='$quantity'
            WHERE cartId='$cartId'";
            $updated_row=$this->db->update($query);
            if ($updated_row) {
                $msg = "Quantity updated successfully";
                return $msg;
            } else {
                $msg = "Quantity not Updated";
                return $msg;
            }
    }

    public function delProductByCart($delId){
        
    $query="DELETE FROM tbl_cart WHERE cartId='$delId'";
    $delId = $this->fm->validation($delId);
    $delId = mysqli_real_escape_string($this->db->link, $delId);
    $delData=$this->db->delete($query);
    if ($delData) {
        
    //    echo "<script>window.location='cart.php';</script>";
    header("Location:cart.php");
    } else {
        $msg = "Product not Deleted";
        return $msg;
    }
    }


    public function getCartData(){
        $sId=session_id();
        $query = "SELECT * FROM tbl_cart where sId = '$sId' ";
        $result = $this->db->insert($query);
        return $result;
    }
    public function delCustomerCart(){
        $sId=session_id();
        $query="DELETE FROM tbl_cart WHERE sid='$sId'";
        $this->db->delete($query);
    }


    public function checkCart(){
        $sId=session_id();
        $query = "SELECT * FROM tbl_cart where sId = '$sId' ";
        $result = $this->db->insert($query);
        return $result;
    }









}


?>