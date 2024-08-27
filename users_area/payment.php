<?php 

include('../include/connect.php'); 
include('../functions/common_functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <!--font awesom link-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files-->
    <link rel="stylesheet" href="../style.css">
</head>
<style>
    img{
        width: 90%;
        margin: auto;
        display: block;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .img2{
        width: 90%;
        height: 325px;
        margin: auto;
        display: block;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
<body>
    <!--first child-->
   <!--navbar-->
   <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
    <img src="../images/logo.png" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
   <ul class="navbar-nav me-auto">
    
        <?php

            if(!isset($_SESSION['username'])){
               echo "<li class='nav-item'>
              <a class='nav-link' href='#'>Welcome Guest</a>
              </li>";
            }else{
                echo "<li class='nav-item'>
                <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                </li>";
            }
           if(!isset($_SESSION['username'])){
              echo "<li class='nav-item'>
              <a class='nav-link' href='user_login.php'>Login</a>
              </li>";
           }else{
              echo "<li class='nav-item'>
              <a class='nav-link' href='logout.php'>Logout</a>
              </li>";
           }

        ?>
        
   </ul>
</nav>

<!--third child-->
<div class="bg-light">
   <h3 class="text-center">Hidden Store</h3>
   <p class="text-center">Communication is at the heart of e-commerce</p>
</div>
    <!-- php code to access user id -->
    <?php
      $user_ip=getIPAddress();
      $get_user= "select * from `user_table` where user_ip='$user_ip'";
      $result= mysqli_query($con,$get_user);
      $run_query=mysqli_fetch_array($result);
      $user_id=$run_query['user_id'];
    ?>
     
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
            <a href="http://www.paypal.com" target="_blank"><img src="../images/payment.jpg" alt=""></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><img class="img2" src="../images/offline.jpg" alt=""></a>
            </div>
        </div>
    </div>

    <!--last child-->
<!--include footer-->
<?php
     include('../include/footer.php');
?>

</body>
</html>