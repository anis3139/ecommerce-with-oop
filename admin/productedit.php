<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php";?>
<?php include "../classes/Brand.php";?>
<?php include "../classes/Product.php";?>

<?php
$cat = new Category();
$brand = new Brand();
?>

<?php
if (!isset($_GET['proedit']) || $_GET['proedit'] == NULL) {
    echo "<script>widow.location='catlist.php'</script>";
} else {
    $id = $_GET['proedit'];
}
?>

<?php
$pd = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
<?php
if (isset($updateProduct)) {
    echo $updateProduct;
}
?>

<?php
$getproduct = $pd->getProductById($id);
if ($getproduct):
    while ($result = $getproduct->fetch_assoc()):
    ?>
					         <form action="" method="post" enctype="multipart/form-data">
					            <table class="form">

					                <tr>
					                    <td>
					                        <label>Name</label>
					                    </td>
					                    <td>
					                        <input type="text" name="productName" value="<?php echo $result['productName']; ?>" class="medium" />
					                    </td>
					                </tr>
									<tr>
					                    <td>
					                        <label>Category</label>
					                    </td>
					                    <td>
			                                <select id="select" name="catId">
					                            <option>Select Category</option>
					                            <?php

    $getcat = $cat->getAllCat();
    if ($getcat):
        while ($result = $getcat->fetch_assoc()):

        ?>
														                            <option  <?php
        if ($result['catId'] == $result['catId']) {
            echo "selected";
        }

        ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
														                                <?php
    endwhile;
endif;
?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>

                            <?php

$getbrand = $brand->getAllBrand();
if ($getbrand):
    while ($result = $getbrand->fetch_assoc()):

    ?>
								                            <option <?php
        if ($result['brandId'] == $result['brandId']) {
            echo "selected";
        }

        ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
								                           <?php
endwhile;
endif;
?>
                        </select>
                    </td>
                </tr>

				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result['price']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                   <img src="<?php echo $result['image']; ?>" alt=""><br/>
                        <input type="file" name="image" />
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                           if($result['type'] == 0){
                            ?>
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                     <?php   }else{?>
                        
                        <option selected="selected" value="1">Non-Featured</option>
                        <option value="0">Featured</option>
                     <?php }?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
<?php endwhile;endif;?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


