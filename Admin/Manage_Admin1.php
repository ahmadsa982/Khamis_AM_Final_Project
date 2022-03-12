<?php
           include('Includes/Header.php');
           include('Includes/Connection.php');
           if(isset($_POST['submit'])){
               $fullname=$_POST['name'];
               $email   =$_POST['Email'];
               $password=$_POST['password'];
               
               $query   ="INSERT INTO Admin(Admin_Name,Email,Password)
               VALUES('$fullname','$email','$password')";

               mysqli_query($Conn,$query);
               header("Location: Manage_Admin.php");
           }
           
?>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6"><!--FORM-->
                                <div class="card">
                                    <div class="card-header">ِAdmin Information</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="name" name="name" placeholder="Admin Name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <?php
                                                if(isset($_GET['id'])){
                                                    echo '<button type="submit" name="submit" value="Create" class="btn btn-success btn-sm">Add Admin</button>';
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
                                                <th>Admin ID</th>
                                                <th>Admin Name</th>
                                                <th>Email</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query="SELECT * FROM Admin";
                                            $Result=mysqli_query($Conn,$query);
                                            while($Admin=mysqli_fetch_assoc($Result)){
                                            echo "<tr>";
                                            echo "<td>{$Admin['Admin_Id']}</td>";
                                            echo "<td>{$Admin['Admin_Name']}</td>";
                                            echo "<td>{$Admin['Email']}</td>";
                                            echo "<td class='btn btn-warning'>Edit</td>";
                                            echo "<td class='btn btn-warning'>Delete</td>";
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


</div>
<?php
           include('Includes/Footer.php')
?>