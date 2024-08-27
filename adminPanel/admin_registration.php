<?php 
include('../include/connect.php'); 
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
         <h2 class="text-center mb-5">Admin Registration</h2>
         <div class="row d-flex justify-content-center">
               <div class="col-lg-6 col-xl-5">
                   <img src="../images/admin_reg.jpg" alt="Admin Registration" class="img-fluid">
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
                <!--email field-->
                <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" 
                      placeholder="Enter your email" autocomplete="off" name="email" required="required"/>
                </div>
                <div class="form-outline mb-4">
                <!--password field-->
                <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" 
                      placeholder="Enter your password" autocomplete="off" name="password" required="required"/>
                </div>
                <div class="form-outline mb-4">
                <!--confirm-password field-->
                <label for="conpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="conpassword" 
                      placeholder="Confirm password" autocomplete="off" name="conpassword" required="required"/>
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="admin_register">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="admin_login.php" class="text-danger">Login</a></p>
                </div>
                   </form>
               </div>
         </div>
    </div>
</body>
</html>

<!--php code-->
<?php
 if(isset($_POST['admin_register'])){
    $username=$_POST['admin_username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $conpassword=$_POST['conpassword'];

    //select_query
    $select_query="select * from `admin_table` where admin_name='$username' or admin_email='$email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Username and Email already exist!')</script>";
    }
    elseif ($password!=$conpassword) {
        echo "<script>alert('Passwords do not match!')</script>";
    }
    else{
       //insert query
       $insert_query="insert into `admin_table` (admin_name,admin_email,admin_password)
       values ('$username','$email','$hash_password')";
       $sql_execute=mysqli_query($con,$insert_query);
       if($sql_execute){
        echo "<script>alert('Admin Registered Successfully')</script>";
        }
        else{
        die(mysqli_error($con));
        }
    }
    
 }

?>