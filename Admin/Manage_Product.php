<?php
    ob_start();  //FOR STOP REPEATE THE ACTION WHEN WE REFRASH
    include('Includes/Header.php');
    require('Includes/Connection.php');
    if(isset($_POST['submit'])){            //Creat
        $Image_Name = $_FILES['img']['name'];
        $tmp_Name   = $_FILES['img']['tmp_name'];
        $Path       ='images/';
        move_uploaded_file($tmp_Name,$Path.$Image_Name);

        $prod_name =$_POST['name'];
        $prod_details =$_POST['details'];
        $prod_price =$_POST['price'];
        $select =$_POST['select'];
        $query="INSERT INTO product (Product_Name,Product_Image,Detalis,Price,Category_Id)
        VALUES('$prod_name','$Image_Name','$prod_details','$prod_price','$select')";       
       
        mysqli_query($Conn,$query);
        header("Location: Manage_Product.php");
       
        
        
    }
    if(isset($_POST['submit1'])){                   //Edit
        $Image_Name = $_FILES['img']['name'];
        $tmp_Name   = $_FILES['img']['tmp_name'];
        $Path       ='images/';
        move_uploaded_file($tmp_Name,$Path.$Image_Name);

        $prod_name =$_POST['name'];
        $prod_details =$_POST['details'];
        $prod_price =$_POST['price'];
        $select =$_POST['select'];

        $query   ="UPDATE product SET   Product_Name='$prod_name',
                                        Product_Image  ='$Image_Name',
                                        Detalis= '$prod_details',
                                        Price='$prod_price',
                                        Category_Id='$select'
                                       WHERE Product_Id ={$_GET['id']}";
        mysqli_query($Conn,$query);
        header("Location: Manage_Product.php");
    }
    if(isset($_GET['id1'])){
        $query ="DELETE FROM product WHERE Product_ID ={$_GET['id1']}";
        $Result=mysqli_query($Conn,$query);
        header("Location: Manage_Product.php");
    }
    if(isset($_GET['id'])){
        $query ="SELECT * FROM product WHERE Product_ID ={$_GET['id']}";
        $Result=mysqli_query($Conn,$query);
        $cat =mysqli_fetch_assoc($Result);
    }   
      
?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6"><!--FORM-->
                                <div class="card">
                                    <div class="card-header">Category Information</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="name" name="name" placeholder="Product Name" class="form-control" value="<?php if(isset($_GET['id'])){echo $product['Product_Name'];}?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="file" id="img" name="img" placeholder="Product Image" class="form-control" value="<?php if (isset($_GET['id'])) { echo $Image_Name; ?>" ><img src="images/<?php echo $product['Product_Image'];} ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="details" name="details" placeholder="Product Details" class="form-control" value="<?php if (isset($_GET['id'])){echo $product['Detalis'];}?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" id="price" name="price" placeholder="Product Price" class="form-control" value="<?php if (isset($_GET['id'])){echo $product['Price'];}?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select name="select" type="text" class="form-control" value="<?php if (isset($_GET['id'])){echo $Categoryname['Category_Name'];}?>">
                                                        <?php
                                                            $query4="SELECT * FROM category";
                                                            $result4=mysqli_query($Conn,$query4);
                                                            while($cat1=mysqli_fetch_assoc($result4)){
                                                                echo"<option value='$cat1[Category_Id]'>";
                                                                echo $cat1['Category_Name'];
                                                                echo"</option>";
                                                            
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
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Product Image</th>
                                                <th>Product details</th>
                                                <th>Product price</th>
                                                <th>Category name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $qr="SELECT * FROM product";
                                                $rs= mysqli_query($Conn,$qr);
                                                $query2="SELECT Category_Name FROM category
                                                INNER JOIN product ON Category.Category_Id = product.Category_Id ";
                                                $result2= mysqli_query($Conn,$query2);
                                                while($product= mysqli_fetch_assoc($rs)){
                                                    $Categoryname= mysqli_fetch_assoc($result2);
                                                    echo"<tr>";
                                                    echo "<td>{$product['Product_Id']}</td>";
                                                    echo "<td>{$product['Product_Name']}</td>";
                                                    echo "<td><img src='images/{$product["Product_Image"]}' width='120' height='120'></td>";
                                                    echo "<td>{$product['Detalis']}</td>";
                                                    echo "<td>{$product['Price']}</td>";
                                                    echo "<td>{$Categoryname['Category_Name']}</td>";
                                                    echo "<td><a href='Manage_Product.php?id={$product['Product_Id']}'> Edit</a></td>";
                                                    echo "<td><a href='Manage_Product.php?id1={$product['Product_Id']}'>Delete</a></td>";
                                                    echo "</tr>"; }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>



<?php
           include('Includes/Footer.php')
?>