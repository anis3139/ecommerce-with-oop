<?php include "inc/header.php"?>
<?php
$login = Session::get("custlogin");
if ($login == false) {
    header("Location:order.php");
}
?>
<style>
    .tbltwo:{float: right; text-align: left;}
    .division:{ width: 50%; float: left; }
   .tblone:{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
   .tblone tr td{text-align: justify; }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="division">
            
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>
							<?php 
								$getPro=$ct->getCartProduct();
								
								if($getPro){
									$sum=0;
									$i=0;
									while($result=$getPro->fetch_assoc()){
										$i++;
								?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>Tk. <?php echo $result['price']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>Tk. <?php
								$total= $result['price'] *  $result['quantity'];
								echo $total; 
                                ?>
                                </td>
							</tr>
							<?php 
								$sum= $sum+$total;
								 Session::set("sum", $sum);
								 ?>
									<?php }}?>
							
						</table>
						<?php 
						$cartData= $ct->getCartData();
						if(isset($cartData)){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. 10% </td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php 
								$vat=$sum*0.1;
								$gtotal=$sum+$vat;
								echo $gtotal;
								?></td>
							</tr>
                       </table>
                        <?php }?>
        </div>





       <div class="division tbltwo">
       <?php
$id = Session::get("cmrId");
$getData = $cmr->getCustomerData($id);
if ($getData) {
    while ($result = $getData->fetch_assoc()) {

        ?>

		<table class="tblone">
        <tr>
            <td colspan="3" style="text-align: center;">Your Details</td>
         </tr>
         <tr>
            <td width="20%">Name</td>
            <td>:</td>
            <td><?php echo $result['name']; ?></td>
         </tr>
         <tr>
            <td width="5%">Address</td>
            <td>:</td>
            <td><?php echo $result['address']; ?></td>
         </tr>
         <tr>
            <td>City</td>
            <td>:</td>
            <td><?php echo $result['city']; ?></td>
         </tr>
         <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $result['country']; ?></td>
         </tr>
         <tr>
            <td>Zip</td>
            <td>:</td>
            <td><?php echo $result['zip']; ?></td>
         </tr>
         <tr>
            <td>Phone</td>
            <td>:</td>
            <td><?php echo $result['phone']; ?></td>
         </tr>
         <tr>
            <td>E-Mail</td>
            <td>:</td>
            <td><?php echo $result['email']; ?></td>
         </tr>
          <tr>
            <td colspan="3" style="text-align: center;"><a href="editprofile.php">Your Details</a></td>
         </tr>
      </table>
          <?php }}?>
    	</div>

    </div>
 </div>
 <div  class="ordernow"><a href="orderrnow" style="margin:20px; background:red; padding:10px; color:seashell; font-size:30px; font-weight:bold; ">Order Now</a></div>
</div>
<?php include "inc/footer.php"?>