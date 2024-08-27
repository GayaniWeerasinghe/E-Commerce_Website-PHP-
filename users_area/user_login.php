<?php 

include('../include/connect.php'); 
include('../functions/common_functions.php');
@session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Login</title>
     <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
     <style>

      body{
        overflow-x : hidden
      }
     </style>

</head>
<body>
    
  <div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <!--username field-->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="user_username" 
                      placeholder="Enter your username" autocomplete="off" name="user_username" required="required"/>    
                </div>
                <div class="form-outline mb-4">
                <!--password field-->
                <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" 
                      placeholder="Enter your password" autocomplete="off" name="user_password" required="required"/>
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
                </div>
            </form>
        </div>
    </div>
  </div>

</body>
</html>

<?php

if(isset($_POST['user_login'])){
   $user_username = $_POST['user_username'];
   $user_password = $_POST['user_password'];
   $user_ip=getIPAddress();

   $select_query = "select * from `user_table` where username='$user_username'";
   $result=mysqli_query($con,$select_query);
   $rows_count=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);

   //cart item
   $select_query_cart = "select * from `cart_details` where ip_address='$user_ip'";
   $result_cart=mysqli_query($con,$select_query_cart);
   $rows_count_cart=mysqli_num_rows($result_cart);


   if($rows_count>0){
       $_SESSION['username'] = $user_username;
    if(password_verify($user_password,$row_data['password'])){
      // echo "<script>alert('Login Successful!')</script>";
      if($rows_count==1 and $rows_count_cart==0){
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Login Successful!')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
      }else{
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Login Successful!')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
      }
    }else{
      echo "<script>alert('Invalid Credentials!')</script>";
    }

   }else{
      echo "<script>alert('Invalid Credentials!')</script>";
   }
}


?>