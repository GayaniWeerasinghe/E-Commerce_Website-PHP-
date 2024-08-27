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
    <title>Admin Login</title>
     <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <!--font awesom link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow-x: hidden;
        }
        .img-fluid{
            width: 90%;
            height: 90%;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
         <h2 class="text-center mb-5">Admin Login</h2>
         <div class="row d-flex justify-content-center">
               <div class="col-lg-6 col-xl-5">
                   <img src="../images/admin_log.avif" alt="Admin Login" class="img-fluid">
               </div>
               <div class="col-lg-6 col-xl-4">
                   <form action="" method="post">
                   <div class="form-outline mb-4">
                    <!--username field-->
                    <label for="admin_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="admin_username" 
                      placeholder="Enter your username" autocomplete="off" name="admin_username" required="required"/>    
                </div>
                <div class="form-outline mb-4">
                <!--password field-->
                <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" 
                      placeholder="Enter your password" autocomplete="off" name="password" required="required"/>
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="admin_login">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Dont't you have an account? <a href="admin_registration.php" class="text-danger">Register</a></p>
                </div>
                   </form>
               </div>
         </div>
    </div>
</body>
</html>

<?php

if(isset($_POST['admin_login'])){
   $username = $_POST['admin_username'];
   $password = $_POST['password'];

   $select_query = "select * from `admin_table` where admin_name='$username'";
   $result=mysqli_query($con,$select_query);
   $rows_count=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);

   if($rows_count>0){
       $_SESSION['admin_username'] = $username;
    if(password_verify($password,$row_data['admin_password'])){
      // echo "<script>alert('Login Successful!')</script>";
      if($rows_count==1 and $rows_count_cart==0){
        $_SESSION['admin_username'] = $username;
        echo "<script>alert('Login Successful!')</script>";
        echo "<script>window.open('admin.php','_self')</script>";
    }else{
      echo "<script>alert('Invalid Credentials!')</script>";
    }

   }else{
      echo "<script>alert('Invalid Credentials!')</script>";
   }
}
}


?>