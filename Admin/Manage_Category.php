<?php
    ob_start();  //FOR STOP REPEATE THE ACTION WHEN WE REFRASH
    include('Includes/Header.php');
    require('Includes/Connection.php');
    if(isset($_POST['submit'])){            //Creat
        $Image_Name = $_FILES['img']['name'];
        $tmp_Name   = $_FILES['img']['tmp_name'];
        $Path       ='images/';
        move_uploaded_file($tmp_Name,$Path.$Image_Name);

        $Category_Name=$_POST['name'];
               
        $query   ="INSERT INTO category(Category_Name,Category_Image)
        VALUES('$Category_Name','$Image_Name')";

        mysqli_query($Conn,$query);
        header("Location: Manage_Category.php");
    }
    if(isset($_POST['submit1'])){                   //Edit
        $Image_Name = $_FILES['img']['name'];
        $tmp_Name   = $_FILES['img']['tmp_name'];
        $Path       ='images/';
        move_uploaded_file($tmp_Name,$Path.$Image_Name);

        $Category_Name=$_POST['name'];
               
        $query   ="UPDATE category SET Category_Name='$Category_Name',
                                       Category_Image  ='$Image_Name'
                                       WHERE Category_Id ={$_GET['id']}";
        mysqli_query($Conn,$query);
        header("Location: Manage_Category.php");
    }
    if(isset($_GET['id1'])){
        $query ="DELETE FROM category WHERE Category_ID ={$_GET['id1']}";
        $Result=mysqli_query($Conn,$query);
        header("Location: Manage_Category.php");
    }
    if(isset($_GET['id'])){
        $query ="SELECT * FROM category WHERE Category_ID ={$_GET['id']}";
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
                                                    <input type="text" id="name" name="name" placeholder="Category Name" class="form-control" value="<?php if(isset($_GET['id'])){echo $cat['Category_Name']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="file" id="img" name="img" placeholder="Category Image" class="form-control" value="<?php if(isset($_GET['id'])){echo $Image_Name; ?>"><img src="images/<?php echo $cat['Category_Image'];}?>" width='120px' hight='120px'>
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
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                <th>Category Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_1="SELECT * FROM category";
                                            $Result=mysqli_query($Conn,$query_1);
                                            while($Category=mysqli_fetch_assoc($Result)){
                                            echo "<tr>";
                                            echo "<td>{$Category['Category_Id']}</td>";
                                            echo "<td>{$Category['Category_Name']}</td>";
                                            echo "<td><img src='images/{$Category['Category_Image']}' width='120' hight='120'></td>";
                                            echo "<td><a href='Manage_Category.php?id={$Category['Category_Id']}'>Edit</a></td>";
                                            echo "<td><a href='Manage_Category.php?id1={$Category['Category_Id']}'>Delete</a></td>";
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
           include('Includes/Footer.php')
?>