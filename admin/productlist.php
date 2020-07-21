<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Product.php";?>
<?php include_once "../helpers/format.php";?>


<?php
$pl = new Product();
$getProductList = $pl->productList();
?>

<?php
if(isset($_GET['delpro'])){
	$id=$_GET['delpro'];
	$delPro=$pl->delProById($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
		<?php
				if(isset($delPro)){
					echo $delPro;
				}
				?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Body</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$fm=new format();
if ($getProductList):
    $i = 0;
    while ($result = $getProductList->fetch_assoc()):
        $i++;
        ?>
																				<tr class="odd gradeX">
																					<td><?php echo $result['productId']; ?></td>
																					<td><?php echo $result['productName']; ?></td>
																					<td><?php echo $result['catName']; ?></td>
																					<td><?php echo $result['brandName']; ?></td>
																					<td><?php echo $fm->textShorten($result['body'], 200); ?></td>
																					<td><?php echo $result['price']; ?></td>
																					<td>
																					<img src="<?php echo $result['image']; ?>" width="100px" height="auto" alt="">
																					</td>
																					<td><?php
        if ($result['type'] == 0) {
            echo "Featured";
        } else {
            echo "Non-Featured";
        }
        ?></td>
																					<td><a href="productedit.php?proedit=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure?')" href="?delpro=<?php echo $result['productId']; ?>">Delete</a></td>
																				</tr>
																					<?php
    endwhile;
endif;?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
