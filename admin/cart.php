<?php include "admin_header.php" ?>
<?php require_once "db.php";?>
<?php session_start(); ?>

<?php 
    //getting the session id
    if (isset($_SESSION['id'])) {
        $id_client = $_SESSION['id'];
    }
    //getting the item id
    if (isset($_GET['articl'])) {
        $articl_id = $_GET['articl'];
        //getting all items from cart table
    $cart_query = "SELECT * FROM cart WHERE articl_id = $articl_id AND id_client = $id_client";
    $cart_search_query = mysqli_query($conn,$cart_query);
    if (!$cart_search_query) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($cart_search_query)) {
        $articl_title = $row['articl_title'];
        $articl_image = $row['articl_image'];
        $articl_price = $row['articl_price'];
        $articl_quantity = $row['articl_quantity'];
    }
    $row_count = mysqli_num_rows($cart_search_query);

    if($row_count > 0){
        $update_query = "UPDATE cart SET articl_quantity = articl_quantity+1 WHERE articl_id = $articl_id AND id_client = $id_client";
        $update_articl_query = mysqli_query($conn,$update_query);
        header('Location: cart.php');

    }else{
         //getting the item infos from products table
        $articl_query = "SELECT * FROM product WHERE id_prod = $articl_id";
        $articl_search_query = mysqli_query($conn,$articl_query);

        while ($row = mysqli_fetch_array($articl_search_query)) {
            $articl_title = $row['title_prod'];
            $articl_image = $row['image_prod'];
            $articl_price = $row['price_prod'];
            
        }

        if (!$articl_search_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

         //adding the item to cart if it doesn't already exist
        $add_query = "INSERT INTO cart(id_client,articl_id,articl_title,articl_image,articl_price) VALUES ($id_client,$articl_id,'$articl_title','$articl_image',$articl_price)";
        $add_to_cart_query = mysqli_query($conn,$add_query);

        if (!$add_to_cart_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        header('Location: cart.php');
    }
    }
?>

           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cart
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                
                        <th>Id</th>
                        <th>Title</th>                       
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Add</th>
                        <th>Reduce</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                
                      <tbody>
                      <?php 
                            
                            $cart_query = "SELECT * FROM cart WHERE id_client = $id_client";
                            $cart_search_query = mysqli_query($conn,$cart_query);
                            while ($row = mysqli_fetch_array($cart_search_query)) {
                                
                                $articl_id = $row['articl_id'];
                                $articl_title = $row['articl_title'];
                                $articl_image = $row['articl_image'];
                                $articl_price = $row['articl_price'];
                                $articl_quantity = $row['articl_quantity'];

                                $total =$articl_quantity * $articl_price  ;

                                echo "<tr>";
                                echo "<td>$articl_id</td>";
                                echo "<td>$articl_title</td>";
                                echo "<td><img class= 'img-responsive' src='../img/$articl_image' alt=''></td>";
                                echo "<td>$articl_price</td>";
                                echo "<td>$articl_quantity</td>";
                                echo "<td>$total</td>";
                                echo "<td><a href='cart.php?add=$articl_id&user=$id_client'>Add</a></td>";
                                echo "<td><a href='cart.php?reduce=$articl_id&user=$id_client'>Reduce</a></td>";
                                echo "<td><a href='cart.php?remove=$articl_id&user=$id_client'>Remove</a></td>";
                                echo "</tr>";

                            }

                                
                            if (isset($_GET['remove'])) {
                                $removed_articl_id = $_GET['remove'];

                                $remove_query = "DELETE FROM cart WHERE articl_id = $removed_articl_id AND id_client = $id_client";
                                $removed_articl_query = mysqli_query($conn,$remove_query);

                                header('Location: cart.php');
                            }
                            if (isset($_GET['add'])) {
                                $added_articl_id = $_GET['add'];

                                $add_articl_query = "UPDATE cart SET articl_quantity = articl_quantity + 1 WHERE articl_id = $added_articl_id AND id_client = $id_client";
                                $added_articl_query = mysqli_query($conn,$add_articl_query);

                                header('Location: cart.php');
                            }

                            if (isset($_GET['reduce'])) {
                                $reduced_articl_id = $_GET['reduce'];

                                $check_query = "SELECT * FROM cart WHERE articl_id = $reduced_articl_id AND id_client = $id_client";
                                $check_quantity_query = mysqli_query($conn,$check_query);
                                $check_row = mysqli_fetch_array($check_quantity_query);
                                $quantity = $check_row['articl_quantity'];

                                if ($quantity == 1 ) {
                                    $reduce_articl_query = "DELETE FROM cart WHERE articl_id = $reduced_articl_id AND id_client = $id_client";
                                    $reduced_articl_query = mysqli_query($conn,$reduce_articl_query);
                                }else{
                                    $reduce_articl_query = "UPDATE cart SET articl_quantity = articl_quantity - 1 WHERE articl_id = $reduced_articl_id AND id_client = $id_client";
                                    $reduced_articl_query = mysqli_query($conn,$reduce_articl_query);
                                }

                                

                                header('Location: cart.php');
                            }
                            

                            
                        ?>

                      </tbody>
            </table>
            <a href = "../blog.php" class="btn btn-success btn-lg" data-dismiss="modal">Back to store</a>
            <a href = "#" class="btn btn-success btn-lg" data-dismiss="modal">Proceed to checkout</a>
            
            </form>

            </div>
            <!-- /.container-fluid -->

        

    <?php include "admin_footer.php" ?>