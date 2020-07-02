<?php include "admin_header.php" ?>
<?require_once "db.php";?>
<?php 

if (isset($_GET['edit'])) {
    $id_prod = $_GET['edit']; 
}

$edit_query = "SELECT * FROM product WHERE id_prod = $id_prod ";
$load_product_query = mysqli_query($conn,$edit_query);

while($row = mysqli_fetch_array($load_product_query)){
$id_prod = $row['id_prod'];
$title_prod = $row['title_prod'];
$image_prod = $row['image_prod'];
$desc_prod = $row['desc_prod'];
$info_prod = $row['info_prod'];
$price_prod = $row['price_prod'];
}

if (isset($_POST['edit_product'])) {
    $title_prod = $_POST['title_prod'];
    $image_prod = $_FILES['image']['name'];
    $image_prod_temp = $_FILES['image']['tmp_name'];
    $desc_prod = $_POST['desc_prod'];
    $info_prod = $_POST['info_prod'];
    $price_prod = $_POST['price_prod'];

    move_uploaded_file($image_prod_temp, "../img/$image_prod");

    $product_title = mysqli_real_escape_string($conn,$title_prod);
    $image_prod = mysqli_real_escape_string($conn,$image_prod);
    $desc_prod = mysqli_real_escape_string($conn,$desc_prod);
    $info_prod = mysqli_real_escape_string($conn,$info_prod);

    $query = "UPDATE product SET title_prod = '$title_prod' ,image_prod ='$image_prod', desc_prod = '$desc_prod', info_prod = '$info_prod', price_prod = '$price_prod'  WHERE id_prod = $id_prod ";
    $edit_product_query = mysqli_query($conn,$query);

    if (!$edit_product_query) {
        die("QUERY FAILED". mysqli_error($conn));
    }

    
}

?>


<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit product
        </h1>
    </div>
</div>
<!-- /.row -->
<form action="edit_product.php?edit=<?php echo $id_prod ?>" method="post" enctype="multipart/form-data">    


    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" value = "<?php echo $title_prod ?>" class="form-control" name="title_prod">
    </div>

    <!-- <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div> -->



    <div class="form-group">
        <label for="image_prod">Product Image</label>
        <input type="file"  name="image">
    </div>

    
    <div class="form-group">
        <label for="desc_prod">Product Description</label>
        <textarea class="form-control" name="desc_prod" id="" cols="30" rows="5"><?php echo $desc_prod ?></textarea>
    </div>
    <div class="form-group">
        <label for="info_prod">Product Infos</label>
        <textarea class="form-control" name="info_prod" id="" cols="30" rows="5"><?php echo $info_prod ?></textarea>
    </div>

    <div class="form-group">
        <label for="price_prod">Product Price</label>
        <input type="number" value = "<?php echo $price_prod ?>" class="form-control" name="price_prod">
    </div>
    
    

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_product" value="Edit product">
    </div>


</form>


</div>
<!-- /.container-fluid -->



<?php include "admin_footer.php" ?>