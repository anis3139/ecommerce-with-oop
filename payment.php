<?php include("inc/header.php")?>
<?php
$login=Session::get("custlogin"); 
if($login== false){
	header("Location:order.php");
}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">  
        <dib>
            <h2>Choose Payment Option</h2>
            <a href="online.php">Online Payment</a>
            <br/>
            <a href="offline.php">Offline Payment</a>
        </dib>
        <div class="back">
            <a href="carrt.php"Previous></a>
        </div>	
    </div>
 </div>
</div>
<?php include("inc/footer.php")?>