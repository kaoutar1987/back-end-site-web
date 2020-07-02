<?php include "admin_header.php"; ?>
<?php  require_once "db.php"; ?>
<?php 

if (isset($_POST['add_product'])) {
    $title_prod = $_POST['title_prod'];
    $image_prod = $_FILES['image']['name'];
    $image_prod_temp = $_FILES['image']['tmp_name'];
    $desc_prod = $_POST['desc_prod'];
    $info_prod = $_POST['info_prod'];
    $price_prod = $_POST['price_prod'];

    move_uploaded_file($image_prod_temp, "../img/$image_prod");

    $title_prod = mysqli_real_escape_string($conn,$title_prod);
    $image_prod = mysqli_real_escape_string($conn,$image_prod);
    $desc_prod = mysqli_real_escape_string($conn,$desc_prod);
    $info_prod = mysqli_real_escape_string($conn,$info_prod);

    $query = "INSERT INTO product(title_prod,image_prod,desc_prod,info_prod,price_prod) VALUES ('$title_prod','$image_prod','$desc_prod','$info_prod','$price_prod')";
    $add_product_query = mysqli_query($conn,$query);

    if (!$add_product_query) {
        die("QUERY FAILED". mysqli_error($conn));
    }
}

?>




            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add a product
                            
                           
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
             <form action="add_product.php" method="post" enctype="multipart/form-data">    
     
     
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" class="form-control" name="title_prod">
                    </div>

                    <!-- <div class="form-group">
                        <select name="post_status" id="">
                            <option value="draft">Post Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div> -->
      
      
      
                    <div class="form-group">
                        <label for="product_image"> Image Product</label>
                        <input type="file"  name="image">
                    </div>

                    
                    <div class="form-group">
                        <label for="desc_prod"> Description Product</label>
                        <textarea class="form-control "name="desc_prod" id="" cols="30" rows="5">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="info_prod"> Infos product</label>
                        <textarea class="form-control "name="info_prod" id="" cols="30" rows="5">
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="price_prod"> Price product</label>
                        <input type="number" class="form-control" name="price_prod">
                    </div>
                    
                    

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="add_product" value="Add product">
                    </div>


            </form>


            </div>
            <!-- /.container-fluid -->

        

    <?php include "admin_footer.php" ?>