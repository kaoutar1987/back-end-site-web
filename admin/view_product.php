<?php include "admin_header.php"; ?>
<?php  require_once "db.php"; ?>





            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Product List
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
                        <th>Description</th>
                        <th>Info</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                      <tbody>
                      <?php 
                            $query = "SELECT * FROM product";
                            $load_product_query = mysqli_query($conn,$query);

                            if (!$load_product_query) {
                                die("QUERY FAILED". mysqli_error($conn));
                            }

                            while ($row = mysqli_fetch_array($load_product_query)) {
                                $id_prod = $row['id_prod'];
                                $title_prod = $row['title_prod'];
                                $image_prod = $row['image_prod'];
                                $desc_prod = $row['desc_prod'];
                                $info_prod = $row['info_prod'];
                                $price_prod = $row['price_prod'];
                                $date_prod = $row['date_prod'];


                                echo "<tr>";
                                echo "<td>$id_prod</td>";
                                echo "<td>$title_prod</td>";
                                echo "<td><img class= 'img-responsive' src='../img/$image_prod' alt=''></td>";
                                echo "<td>$desc_prod</td>";
                                echo "<td>$info_prod</td>";
                                echo "<td>$price_prod</td>";
                                echo "<td>$date_prod</td>";
                                echo "<td> <a href='edit_product.php?edit=$id_prod'>Edit</a></td>";
                                echo "<td><a href='view_product.php?delete=$id_prod'>Delete</a></td>";
                                echo "</tr>";
                            }

                            if (isset($_GET['delete'])) {
                                $deleted_id_prod = $_GET['delete'];

                                $delete_query = "DELETE FROM product WHERE id_prod = $deleted_id_prod";
                                $deleted_product_query = mysqli_query($conn,$delete_query);

                                header('Location: view_product.php');
                            }

                        ?>

                      </tbody>
            </table>
            
            </form>

            </div>
            <!-- /.container-fluid -->

        

    <?php include "admin_footer.php" ?>