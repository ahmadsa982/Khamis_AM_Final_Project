<?php
    ob_start();  //FOR STOP REPEATE THE ACTION WHEN WE REFRASH
    include('Includes/Header.php');
    require('Includes/Connection.php');
    if(isset($_POST['submit'])){
        $Product_Image=$_FILES['img']['productname'];
        $tmp_Name     =$_FILES['img']['tmp_name'];
        $Path         ='images/';
        move_uploaded_file($tmp_Name,$Path.$Product_Image);

        $Product_Name =$_POST['productname'];
        $Detalis =$_POST['detalis'];
        $Price =$_POST['price'];
       
        $Select =$_POST['select'];

               
        $query   ="INSERT INTO product(Product_Name,Product_Image,Detalis,Price,Category_Id)
        VALUES('$Product_Name','$Product_Image','$Detalis','$Price','$Select')";

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
                            <div class="col-lg-6"><!--FORM-->
                                <div class="card">
                                    <div class="card-header">Product Information</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="" enctype="multipart/form-data"><!--enctype="multipart/form-data" for image form-->
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="productname" name="productname" placeholder="Product Name" class="form-control" value="<?php if(isset($_GET['id'])){echo $Product['Product_Name']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="file" id="img" name="img" placeholder="Product Image" class="form-control" value="<?php if(isset($_GET['id'])){echo $Product_Name; ?>"><img src="images/<?php echo $Product['Product_Image'];}?>" width='120px' hight='120px' > 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="details" name="details" placeholder="Product Details" class="form-control" value="<?php if(isset($_GET['id'])){echo $Product['Details']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" id="price" name="price" placeholder="Product Price" class="form-control" value="<?php if(isset($_GET['id'])){echo $Product['Price']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select  type="text" name="select" class="form-control">
                                                        <?php
                                                        $query="SELECT * FROM category WHERE Category_Id={$Pruduct['Category_Id']}";
                                                        $result= mysqli_query($Conn,$query);
                                                        $CatName=mysqli_fetch_assoc($result);
                                                        echo "<option>";
                                                        echo $CatName['Category_Name'];
                                                        echo "</option>";
                                                        $query2="SELECT * FROM category";
                                                        $result2= mysqli_query($Conn,$query2);
                                                        while($Cat=mysqli_fetch_assoc($result2)){
                                                            if ($Pruduct['Category_Name'] != $CatName['Category_Id']) {
                                                                echo "<option>".$Pruduct['Category_Name']."</option>";
                                                            }  
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <?php
                                                if (isset($_GET['id'])){
                                                    echo '<button type="submit" name="submit1" value="Edit" class="btn btn-success btn-sm">Edit</button>';
                                                }
                                                else if (!isset($_GET['id'])){
                                                    echo '<button type="submit" name="submit" value="Create" class="btn btn-success btn-sm">Create</button>';
                                                }
                                                   ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-9"><!--TABLE-->
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning" >
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
                                            $query="SELECT * FROM product";
                                            $Result=mysqli_query($Conn,$query);
                                            $query2="SELECT Category_Name FROM category
                                            INNER JOIN product ON category.Category_Id=product.Category_Id";
                                            $Result2=mysqli_query($Conn,$query2);
                                            while($Pruduct=mysqli_fetch_assoc($Result)){
                                                $CategoryName=mysqli_fetch_assoc($Result2);
                                            echo "<tr>";
                                            echo "<td>{$Pruduct['Pruduct_Id']}</td>";
                                            echo "<td>{$Pruduct['Pruduct_Name']}</td>";
                                            echo "<td><img src='images/{$Pruduct['Pruduct_Image']}' width='120' hight='120'></td>";
                                            echo "<td>{$Pruduct['Detalis']}</td>";
                                            echo "<td>{$Pruduct['Price']}</td>";
                                            echo "<td>{$CategoryName['Category_Name']}</td>";
                                            echo "<td><a href='Manage_Pruduct.php?id={$Pruduct['Pruduct_Id']}'>Edit</a></td>";
                                            echo "<td><a href='Manage_Pruduct.php?id1={$Pruduct['Pruduct_Id']}'>Delete</a></td>";
                                            echo "</tr>";
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

<?php
           include('Includes/Footer.php');
           ?>