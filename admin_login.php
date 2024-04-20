
<?php
   include('../includes/connect.php');
   include('../functions/common_functions.php');
   @session_start();

  

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="conatiner-fluid m-3">
        <h2 class="text-center mb-3 m-4">Admin Login</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/registration_logo.png" alt="" class="img-fluid">
            </div>


         <div class="col-lg-6 col-xl-5">
            <form action="" method="post">
                <div class="form-outline mb-3">
                    <label for="username" class="form-label m-3">User Name</label>
                    <input type="text" name="username" id="username" placeholder="Enter your user name" required="required" class="form-control">
                </div>
            
        

                <div class="form-outline mb-3">
                    <label for="password" class="form-label m-3">User password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your user password" required="required" class="form-control">
                </div>

                <div>
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                    <p class="small  mt-2 pt-1"><b>Don't have an account? <a href="admin_regrastation.php" class="text-danger">Register</a></b></p>
                </div>
            </div>
         </form>
        </div>
    </div>
</body>
</html>





<?php

if(isset($_POST['admin_login']))
{

  $username=$_POST['username'];
  $password=$_POST['password'];
 

  //selection for password hash
 $select_query="select * from `admin_data` where admin_name='$username'";

 $result=mysqli_query($con,$select_query) ;
 $row_count=mysqli_num_rows($result);
 $row_data=mysqli_fetch_assoc($result);
// echo $row_data_hash;
 //$user_ip=getIPaddress();

 
 // checking the number of the rows

 if($row_count>0){
 // $_SESSION['username']=$admin_name;
        if(password_verify($password,$row_data['admin_password']))
        {
          echo "<script> alert('Login Successfully')</script>";
          echo "<script> window.open('admin_profile.php','_self')</script>";
        
           
        
        }
        else{
          
          echo "<script> alert('Invalid Password')</script>";
          echo "<script> window.open('admin_profile.php','_self')</script>";
        }

  

 }
 
 else{
  echo "<script> alert('Invalid username and Password')</script>";
  echo "<script> window.open('admin_profile.php','_self')</script>";

 }



}



?>