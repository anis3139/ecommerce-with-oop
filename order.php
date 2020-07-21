<?php include("inc/header.php")?>
<?php
$login=Session::get("custlogin"); 
if($login== false){
	header("Location:order.php");
}

?>
<style>
    .notfound{}
    .notfound{font-size: 100px; line-height: 130px; text-align: center;}
    .notfound h2 span{display: block; color: red; font-size: 170px;}
</style>

 <div class="main">
    <div class="content">
    	<div class="notfound">		
			<h2><span>Order</span> Not Found</h2>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include("inc/footer.php")?>