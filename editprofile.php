<?php include("inc/header.php")?>
<?php
$login=Session::get("custlogin"); 
if($login== false){
	header("Location:order.php");
}
?>
<?php
$cmrId=Session::get("cmrId"); 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $custUpdate = $cmr->customerUpdate($_POST, $cmrId);
}
?>

<style>
   .tblone:{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
   .tblone tr td{text-align: justify; }
   .tblone input[type="text"]{width: 400px; padding: 5px; font-size: 15px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
          
       <?php 
       $id=Session::get("cmrId");
       $getData=$cmr->getCustomerData($id);
       if($getData){
          while($result=$getData->fetch_assoc()){
       
       ?>
<form action="" method="post">
		<table class="tblone">
          <tr>
            <td colspan="3" style="text-align: center;">Your Profile Details</td>
         </tr>
         <?php 
            if(isset($custUpdate)){
               echo $custUpdate;
            }
         ?>
         <tr>
            <td width="20%">Name</td>
            <td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
         </tr>
         <tr>
            <td width="5%">Address</td>
            <td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
         </tr>
         <tr>
            <td>City</td>
            <td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
         </tr>
         <tr>
            <td>Country</td>
            <td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
         </tr>
         <tr>
            <td>Zip</td>
            <td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
         </tr>
         <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
         </tr>
         <tr>
            <td>E-Mail</td>
            <td><input readonly type="text" name="email" value="<?php echo $result['email'];?>"></td>
         </tr>        
          <tr>
            <td colspan="3" style="text-align: center;"><input style="padding: 10px 20px;"  type="submit" name="submit" value="save"></td>
         </tr>
      </table>
      </form>
          <?php }}?>
    	
    </div>
 </div>
</div>
<?php include("inc/footer.php")?>