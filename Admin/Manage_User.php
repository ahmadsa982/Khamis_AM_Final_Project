<?php
    ob_start();  //FOR STOP REPEATE THE ACTION WHEN WE REFRASH
    include('Includes/Header.php');
    require('Includes/Connection.php');
    if(isset($_POST['submit'])){
        $fullname=$_POST['name'];
        $email   =$_POST['email'];
        $password=$_POST['password'];
               
        $query   ="INSERT INTO user(User_Name,Email,Password)
        VALUES('$fullname','$email','$password')";

        mysqli_query($Conn,$query);
        header("Location: Manage_User.php");
    }
    if(isset($_POST['submit1'])){
        $fullname=$_POST['name'];
        $email   =$_POST['email'];
        $password=$_POST['password'];
               
        $query   ="UPDATE user SET User_Name='$fullname',
                                    Email     ='$email',
                                    Password  ='$password'
                                    WHERE User_ID ={$_GET['id']}";

        mysqli_query($Conn,$query);
        header("Location: Manage_User.php");
    }
    if(isset($_GET['id1'])){
        $query ="DELETE FROM user WHERE User_ID ={$_GET['id1']}";
        $Result=mysqli_query($Conn,$query);
        header("Location: Manage_User.php");
    }
    if(isset($_GET['id'])){
        $query ="SELECT * FROM user WHERE User_ID ={$_GET['id']}";
        $Result=mysqli_query($Conn,$query);
        $User =mysqli_fetch_assoc($Result);
    }   
      
?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6"><!--FORM-->
                                <div class="card">
                                    <div class="card-header">User Information</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="name" name="name" placeholder="User Name" class="form-control" value="<?php if(isset($_GET['id'])){echo $User['User_Name']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php if(isset($_GET['id'])){echo $User['Email']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control"value="<?php if(isset($_GET['id'])){echo $User['Password']; }?>">
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
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_1="SELECT * FROM user";
                                            $Result=mysqli_query($Conn,$query_1);
                                            while($User=mysqli_fetch_assoc($Result)){
                                            echo "<tr>";
                                            echo "<td>{$User['User_Id']}</td>";
                                            echo "<td>{$User['User_Name']}</td>";
                                            echo "<td>{$User['Email']}</td>";
                                            echo "<td><a href='Manage_User.php?id={$User['User_Id']}'>Edit</a></td>";
                                            echo "<td><a href='Manage_User.php?id1={$User['User_Id']}'>Delete</a></td>";
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