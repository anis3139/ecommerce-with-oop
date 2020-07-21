<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Database.php";
include_once $filepath . "/../helpers/format.php";
?>


<?php

class Customer {
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }

    public function customerRegistration($data) {
        $name = $this->fm->validation($data['name']);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = $this->fm->validation($data['address']);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = $this->fm->validation($data['city']);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = $this->fm->validation($data['country']);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = $this->fm->validation($data['zip']);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = $this->fm->validation($data['phone']);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = $this->fm->validation($data['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = $this->fm->validation($data['pass']);
        $pass = mysqli_real_escape_string($this->db->link, md5($pass));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
            $msg = "Field must not be empty";
            return $msg;
        }
        $mailcheck = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $mailchk = $this->db->select($mailcheck);
        if ($mailchk != false) {
            $msg = "mail Allready Exist";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass)
            VALUES('$name','$address', '$city', '$country',' $zip', '$phone', '$email', '$pass')";
            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                echo "<span class='success'>Customer Data Inserted Successfully.
               </span>";
            } else {
                echo "<span class='error'>Customer Data Not Inserted !</span>";
            }
        }
    }


    public function customerLogin($data){
        $email = $this->fm->validation($data['email']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = $this->fm->validation($data['pass']);
        $pass = mysqli_real_escape_string($this->db->link, md5($pass));
        if (empty($email)|| empty($pass)) {
            $msg = "Field must not be empty";
            return $msg;
        }


        $query = "SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value= $result->fetch_assoc();
            Session::set("custlogin", true);
            Session::set("cmrId", $value['id']);
            Session::set("cmrName", $value['name']);
            header("location:cart.php");
        } else{
            $msg = "Email or Password not match";
            return $msg;
        }

    }


    public function getCustomerData($id){
        $query = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }

public function customerUpdate($data, $cmrId){
    $name = $this->fm->validation($data['name']);
    $name = mysqli_real_escape_string($this->db->link, $name);
    $address = $this->fm->validation($data['address']);
    $address = mysqli_real_escape_string($this->db->link, $address);
    $city = $this->fm->validation($data['city']);
    $city = mysqli_real_escape_string($this->db->link, $city);
    $country = $this->fm->validation($data['country']);
    $country = mysqli_real_escape_string($this->db->link, $country);
    $zip = $this->fm->validation($data['zip']);
    $zip = mysqli_real_escape_string($this->db->link, $zip);
    $phone = $this->fm->validation($data['phone']);
    $phone = mysqli_real_escape_string($this->db->link, $phone);
    $email = $this->fm->validation($data['email']);
    $email = mysqli_real_escape_string($this->db->link, $email);

    if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
        $msg = "Field must not be empty";
        return $msg;
    }
     else {
        $query = "UPDATE tbl_customer
            SET
            name='$name',
            address='$address',
            city='$city',
            country='$country',
            zip='$zip',
            phone='$phone',
            email='$email'
            WHERE id='$cmrId'";
            $updated_row=$this->db->update($query);
            if ($updated_row) {
                $msg = "Profile updated successfully";
                return $msg;
            } else {
                $msg = "Profile not Updated";
                return $msg;
            }
    }
}











}

?>