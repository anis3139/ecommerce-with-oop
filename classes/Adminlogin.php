
<?php include "../lib/Session.php";

Session::checkLogin();
include "../lib/Database.php";
include "../helpers/format.php";

?>

<?php
class Adminlogin {
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }
    public function adminLogin($adminUser, $adminPass) {
        $adminUser=$this->fm->validation($adminUser);
        $adminPass=$this->fm->validation($adminPass);

        $adminUser=mysqli_real_escape_string( $this->db->link,$adminUser);
        $adminPass=mysqli_real_escape_string( $this->db->link,$adminPass);

        if(empty($adminUser) || empty($adminPass)){
            $loginmsg="Username or Password must not be empty";
            return $loginmsg;
        }else{
            $query= "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'"; 
            $result= $this->db->select($query);
            if($result != false){
                $value=$result->fetch_assoc();
                Session::set("adminlogin",true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                header("location:index.php");
            }else{
                $loginmsg="Username or Password Does not Match";
                return $loginmsg;
            }
        }
    }

}