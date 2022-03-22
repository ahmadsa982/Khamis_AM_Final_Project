<?php
    ob_start();  //FOR STOP REPEATE THE ACTION WHEN WE REFRASH
    include('Includes/Header.php');
    require('includes/Connection.php');
    if(isset($_POST['submit'])){
        $Image_Name =$_FILES['img']['name'];
        $tmp_name =$_FILES['img']['tmp_name'];
        $path = 'images/';
        move_uploaded_file($tmp_name,$path.$Image_Name);
        $Product_Name =$_POST['name'];
        $Product_Details =$_POST['details'];
        $Product_Price =$_POST['price'];
        $Select =$_POST['select'];
        $query="INSERT INTO product (Product_Name,Product_Image,Detalis,Price,Category_Id)
        VALUES('$Product_Name','$Image_Name','$Product_Details','$Product_Price','$Select')";
        mysqli_query($Conn,$query);
        header("Location: Manage_Product.php");
    }
    if(isset($_GET['id'])){
        $query ="SELECT * FROM product WHERE Product_Id ={$_GET['id']}";
        $Result=mysqli_query($Conn,$query);
        $admin =mysqli_fetch_assoc($Result);
    }   
?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Product Information</div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" placeholder="Product name" class="form-control" value="<?php if(isset($_GET['id'])){echo $cat['category_name'];}?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="file" id="img" name="img" placeholder="Product image" class="form-control" value="<?php if (isset($_GET['id'])) { echo $img_name; ?>" ><img src="images/<?php echo $cat['cat_img'];} ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="details" name="details" placeholder="Product details" class="form-control" value="<?php if (isset($_GET['id'])) { echo $img_name; ?>" ><img src="images/<?php echo $cat['cat_img'];} ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" id="price" name="price" placeholder="Product price" class="form-control" value="<?php if (isset($_GET['id'])) { echo $img_name; ?>" ><img src="images/<?php echo $cat['cat_img'];} ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select name="select" type="text" class="form-control">
                                                <?php
                                                $query="SELECT * FROM category WHERE category_id={$product['category_id']}";
                                                $result=mysqli_query($conn,$query);
                                                $catname=mysqli_fetch_assoc($result);
                                                echo "<option>";
                                                echo $catname['category_name'];
                                                echo "</option>";
                                                $query2="SELECT * FROM category";
                                                $result2=mysqli_query($conn,$query2);
                                                while($cat=mysqli_fetch_assoc($result2)){
                                                    if($product['category_name'] != $catname['category_id']){
                                                        echo "<option>". $product['category_name']. "</option>";
                                                    }
                                                    echo"<option value='$cat[category_id]'>$cat[category_name]</option>";

                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
                                        <?php
                                            if(isset($_GET['id'])){
                                                echo '<button type="submit" name="submit1" value="Edit" class="btn btn-success btn-sm">Edit</button>';
                                            }
                                            else if(!isset($_GET['id'])){
                                                echo '<button type="submit" name="submit" value="Create" class="btn btn-success btn-sm">Create</button>';
                                            }
                                            ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Product Details</th>
                                    <th>Product Price</th>
                                    <th>Category Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qr="SELECT * FROM product";
                                $rs= mysqli_query($Conn,$qr);
                                $query2="SELECT Category_Name FROM category
                                INNER JOIN product ON category.Category_Id = product.Category_Id ";
                                $result2= mysqli_query($Conn,$query2);
                                while($product= mysqli_fetch_assoc($rs)){
                                    $categoryname= mysqli_fetch_assoc($result2);
                                    echo"<tr>";
                                    echo "<td>{$product['Product_Id']}</td>";
                                    echo "<td>{$product['Product_Name']}</td>";
                                    echo "<td><img src='images/{$product['Product_Image']}' width='120' height='120'></td>";
                                    echo "<td>{$product['Details']}</td>";
                                    echo "<td>{$product['Price']}</td>";
                                    echo "<td>{$categoryname['Category_Name']}</td>";
                                    echo "<td><a href='manage_category.php?id={$product['Product_Id']}'> Edit</a></td>";
                                    echo "<td><a href='manage_category.php?id1={$product['Product_Id']}'>Delete</a></td>";
                                echo "</tr>"; }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/Footer.php');
?>