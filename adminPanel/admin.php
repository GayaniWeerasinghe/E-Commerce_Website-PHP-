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
    <title>Admin Panel</title>
     <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <!--font awesom link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap js link-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--css files-->
    <link rel="stylesheet" href="../style.css">
    <style>
     .admin_img{
         width:100px;
         object-fit: contain;
     }
     
     .footer{
          position:absolute;
          bottom:0;
     }
     body{
        overflow-x:hidden;
     }
     .prod_image{
        width: 100px;
        object-fit: contain;
     }
     .user_image{
        width: 100px;
        object-fit: contain;
     }
     </style>
    </head>
<body>
   

   <div class="container-fluid p-0">
       <!--first child-->
       <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
             <img src="../images/logo.png" class="logo">
             <nav class="navbar navbar-expand-lg">
                  <ul class="navbar-nav">
                  <?php

if(!isset($_SESSION['admin_username'])){
   echo "<li class='nav-item'>
   <a class='nav-link' href='#'>Welcome Admin</a>
   </li>";
}else{
   echo "<li class='nav-item'>
   <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_username']."</a>
   </li>";
}

if(!isset($_SESSION['admin_username'])){
    echo "<li class='nav-item'>
    <a class='nav-link' href='admin_login.php'>Login</a>
    </li>";
 }else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='logout.php'>Logout</a>
  </li>";
 } 
?>
                  </ul>
             </nav>
        </div>
        </nav>

        <!--2nd child-->
        <div class="bg-light">
           <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!--3rd child-->
        <div class="row">
          <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
               <div class="px-5">
                  <a href="#"><img src="../images/admin.webp" alt="" class="admin_img"></a>
                  <?php

           if(!isset($_SESSION['admin_username'])){
              echo "<p class='text-center text-light'>Admin</p>";
           }else{
              echo "<p class='text-center text-light'>".$_SESSION['admin_username']."</p>";
          }
          ?>
                  
               </div>
               <div class="button text-center">
                    <button class="my-3"><a href="insertProduct.php" class="nav-link text-light bg-info my-1 mx-1">Insert Products</a></button>
                    <button><a href="admin.php?view_products" class="nav-link text-light bg-info my-1 mx-1">View Products</a></button>
                    <button><a href="admin.php?insert_category" class="nav-link text-light bg-info my-1 mx-1">Insert Categories</a></button>
                    <button><a href="admin.php?view_category" class="nav-link text-light bg-info my-1 mx-1">View Categories</a></button>
                    <button><a href="admin.php?insert_brand" class="nav-link text-light bg-info my-1 mx-1">Insert Brands</a></button>
                    <button><a href="admin.php?view_brands" class="nav-link text-light bg-info my-1 mx-1">View Brands</a></button>
                    <button><a href="admin.php?view_orders" class="nav-link text-light bg-info my-1 mx-1">All Orders</a></button>
                    <button><a href="admin.php?view_payment" class="nav-link text-light bg-info my-1 mx-1">All Payments</a></button>
                    <button><a href="admin.php?view_users" class="nav-link text-light bg-info my-1 mx-1">User List</a></button>
               </div>
          </div>
        </div>

        <!--forth child-->
        <div class="container my-3">
            <?php
                if(isset($_GET['insert_product'])){
                    include ('insertProduct.php');
                }
                if(isset($_GET['insert_category'])){
                    include ('insertCategories.php');
                }
                if(isset($_GET['insert_brand'])){
                    include ('insertBrands.php');
                }
                if(isset($_GET['view_products'])){
                    include ('view_products.php');
                }
                if(isset($_GET['edit_products'])){
                    include ('edit_products.php');
                }
                if(isset($_GET['delete_products'])){
                    include ('delete_products.php');
                }
                if(isset($_GET['view_category'])){
                    include ('view_category.php');
                }
                if(isset($_GET['edit_category'])){
                    include ('edit_category.php');
                }
                if(isset($_GET['delete_category'])){
                    include ('delete_category.php');
                }
                if(isset($_GET['view_brands'])){
                    include ('view_brands.php');
                }
                if(isset($_GET['edit_brand'])){
                    include ('edit_brand.php');
                }
                if(isset($_GET['delete_brand'])){
                    include ('delete_brand.php');
                }
                if(isset($_GET['view_orders'])){
                    include ('view_orders.php');
                }
                if(isset($_GET['delete_order'])){
                    include ('delete_order.php');
                }
                if(isset($_GET['view_payment'])){
                    include ('view_payment.php');
                }
                if(isset($_GET['delete_payment'])){
                    include ('delete_payment.php');
                }
                if(isset($_GET['view_users'])){
                    include ('view_users.php');
                }
                if(isset($_GET['delete_user'])){
                    include ('delete_user.php');
                }
            ?>
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