<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/format.php");
?>

<?php
class Brand {
    public $db;
    public $fm;
    public function __construct() {

        $this->db = new Database();
        $this->fm = new format();
    }

    public function brandInsert($brandName) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) values('$brandName')";
            $insertBrand = $this->db->insert($query);
            if ($insertBrand) {
                $msg = "Brand insert successfully";
                return $msg;
            } else {
                $msg = "Brand not inserted";
                return $msg;
            }
        }
    }

    public function getAllBrand() {
        $query = "SELECT * FROM tbl_brand order by brandId desc";
        $result = $this->db->insert($query);
        return $result;
    }

    public function getBrandById($id) {
        $query = "SELECT * FROM tbl_brand where brandId = '$id' ";
        $result = $this->db->insert($query);
        return $result;
    }

    public function brandUpdate($brandName, $id) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $msg = "Field must not be empty";
            return $msg;
        } else {
            $query = "UPDATE tbl_brand
            SET
            brandName='$brandName'
            WHERE brandId='$id'";
            $updated_row=$this->db->update($query);
            if ($updated_row) {
                $msg = "Brand updated successfully";
                return $msg;
            } else {
                $msg = "Brand not Updated";
                return $msg;
            }
        }
    }

    public function delBrandById($id){
    $query="DELETE FROM tbl_brand WHERE brandId='$id'";
    $delData=$this->db->delete($query);
    if ($delData) {
        $msg = "Brand Deleted Successfully";
        return $msg;
    } else {
        $msg = "Brand not Deleted";
        return $msg;
    }

}
}

?>