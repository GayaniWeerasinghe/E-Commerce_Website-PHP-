<?php 
include('../include/connect.php'); 
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Registration</title>
     <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>
    
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <!--username field-->
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="user_username" 
                      placeholder="Enter your username" autocomplete="off" name="user_username" required="required"/>    
                </div>
                <div class="form-outline mb-4">
                <!--email field-->
                <label for="user_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user_email" 
                      placeholder="Enter your email" autocomplete="off" name="user_email" required="required"/>
                </div>
                <div class="form-outline mb-4">
                <!--image field-->
                <label for="image" class="form-label">User Image</label>
                <input type="file" class="form-control" id="image" name="image" required="required"/>
                </div>
                <div class="form-outline mb-4">
                <!--password field-->
                <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" 
                      placeholder="Enter your password" autocomplete="off" name="user_password" required="required"/>
                </div>
                <div class="form-outline mb-4">
                <!--confirm-password field-->
                <label for="user_conpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="user_conpassword" 
                      placeholder="Confirm password" autocomplete="off" name="user_conpassword" required="required"/>
                </div>
                <div class="form-outline mb-4">
                    <!--address field-->
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="user_address" 
                      placeholder="Enter your address" autocomplete="off" name="user_address" required="required"/>    
                </div>
                <div class="form-outline mb-4">
                    <!--contact field-->
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="user_contact" 
                      placeholder="Enter your contact" autocomplete="off" name="user_contact" required="required"/>    
                </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                </div>
            </form>
        </div>
    </div>
  </div>

</body>
</html>

<!--php code-->
<?php
 if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $user_conpassword=$_POST['user_conpassword'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['image']['name'];
    $user_image_tmp=$_FILES['image']['tmp_name'];
    $user_ip=getIPAddress();

    //select_query
    $select_query="select * from `user_table` where username='$user_username' or user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('Username and Email already exist!')</script>";
    }
    elseif ($user_password!=$user_conpassword) {
        echo "<script>alert('Passwords do not match!')</script>";
    }
    else{
       //insert query
       move_uploaded_file($user_image_tmp,"./user_images/$user_image");
       $insert_query="insert into `user_table` (username,user_email,password,user_image,user_ip,user_address,user_mobile)
       values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
       $sql_execute=mysqli_query($con,$insert_query);
       if($sql_execute){
        echo "<script>alert('User Registered Successfully')</script>";
        }
        else{
        die(mysqli_error($con));
        }
    }
    
    //selecting cart items
    $select_cart_item= "select * from `cart_details` where ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_item);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
      $_SESSION['username'] = $user_username;
      echo "<script>alert('You have items in your cart')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
    }else{
      echo "<script>window.open('../index.php','_self')</script>";
    }
 }

?>
