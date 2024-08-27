<!--connect database-->
<?php
   include ('../include/connect.php');
   include ('../functions/common_functions.php');
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E commerce System</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--font awesom link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files-->
    <link rel="stylesheet" href="../style.css">

    <style>
      body{
        overflow-x : hidden
      }

      .logo{
        width: 7%;
        height: 7%;
      }

      .profile-img{
       width: 90%;
       margin: auto;
       display: block;
       object-fit: contain;
      }

      .edit_image{
        width: 18%;
        height: 18%;
        object-fit: contain;
      }

    </style>
</head>
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
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price()?>/=</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<?php
//calling cart function
cart();

?>

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

<!-- fourth child -->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height: 100vh;" >
        <li class="nav-item bg-info">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
        </li>
        <?php
           $username = $_SESSION['username'];
           $user_image = "select * from `user_table` where username='$username'";
           $result_image=mysqli_query($con,$user_image);
           $row_image=mysqli_fetch_array($result_image);
           $user_image = $row_image["user_image"];
           echo "<li class='nav-item'>
           <img src='./user_images/$user_image' class='profile-img my-4' alt=''>
         </li>"
        ?>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php">Pending Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
    <div class="col-md-10 text-center">
        <?php get_user_order_details();
        if(isset($_GET['edit_account'])){
          include('edit_account.php');
        }
        if(isset($_GET['my_orders'])){
          include('my_orders.php');
        }
        if(isset($_GET['delete_account'])){
          include('delete_account.php');
        }
        ?>
    </div>
</div>


<!--last child-->
<!--include footer-->
<?php
     include('../include/footer.php');
?>
    </div>

<!--js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>