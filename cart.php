<!--connect database-->
<?php
   include ('include/connect.php');
   include ('functions/common_functions.php');
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E commerce System - Cart details</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--font awesom link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files-->
    <link rel="stylesheet" href="./style.css">
    <style>
      .cart_image{
    width: 80px;
    height: 80px;
    object-fit: contain;
    }

    .td{
      text-align: center;
    }

    </style>

</head>
<body>
  <!--first child-->
   <!--navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
    <img src="./images/logo.png" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a>
        </li>
      </ul>
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
 <a class='nav-link' href='./users_area/user_login.php'>Login</a>
 </li>";
}else{
echo "<li class='nav-item'>
<a class='nav-link' href='./users_area/logout.php'>Logout</a>
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

<!--fourth child-table-->
<div class="container">
   <form action="" method="post">
   <table class="table table-bordered">
       
        <!--php code to display dynamic data-->
            <?php
                $ip = getIPAddress();
                $total_price= 0;
                $cart_query= "select * from `cart_details` where ip_address='$ip'";
                $result= mysqli_query($con,$cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>0){
                  echo "<thead>
                  <tr>
                      <th>Product Title</th>
                      <th>Product Image</th>
                      <th>Quantity</th>
                      <th>Total Price</th>
                      <th>Remove</th>
                      <th colspan='2'>Operations</th>
                  </tr>
             </thead>
             <tbody>";
                while($row=mysqli_fetch_array($result)){
                    $prod_id= $row['prod_id'];
                    $select_products="select * from `products` where prod_id=$prod_id";
                    $result_products= mysqli_query($con,$select_products);
                    while($row_price=mysqli_fetch_array($result_products)){
                          $product_price=array($row_price['price']); //[200,500]
                          $price_table=$row_price['price'];
                          $prod_title=$row_price['title'];
                          $prod_image=$row_price['image1'];
                          $product_values=array_sum($product_price);  //[700]
                          $total_price+=$product_values; //700
            ?>
            <tr>
                <td class="td"><?php echo $prod_title ?></td>
                <td class="td"><img src="./adminPanel/product_images/<?php echo $prod_image ?>" alt="" class="cart_image"></td>
                <td class="td"><input type="text" class="form-input w-50" name="qty">
                <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
    <?php
        $ip = getIPAddress();
        if(isset($_POST['update_cart'])){
            $quantities = (int) $_POST['qty']; // Convert quantity to an integer
            $product_id = $_POST['prod_id'];
            $update_cart = "update `cart_details` set quantity='$quantities' where ip_address='$ip' and prod_id=$product_id";
            $result_quantity = mysqli_query($con, $update_cart);
            
            // Ensure $total_price is defined and initialized before this line
            $total_price = $total_price * $quantities;
        }
    ?>
</td>

                <td class="td"><?php echo $price_table?>/-</td>
                <td class="td"><input type="checkbox" name="removeitem[]" value="<?php echo $prod_id ?>"></td>
                <td class="td">
                    <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                    <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                </td>
            </tr>
            <?php
                    }
                  }
                }
                else{
                   echo "<h2 class='text-danger text-center'>Cart is empty!</h2>";
                }
            ?>
       </tbody>
   </table>
   <!--subtotal-->
   <div class="d-flex mb-3">
    <?php
       $ip = getIPAddress();
       $cart_query= "select * from `cart_details` where ip_address='$ip'";
       $result= mysqli_query($con,$cart_query);
       $result_count=mysqli_num_rows($result);
       if($result_count>0){
           echo "<h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price /-</strong></h4>
           <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
           <button class='bg-secondary px-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-ligt text-decoration-none' >Checkout</a></button>";
       }
       else{
          echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
       }

       if(isset($_POST['continue_shopping'])){
        echo "<script>window.open('index.php','_self')</script>";
       }
    ?>
       
   </div>
</div>
</form>

<!-- remove cart -->
<?php
function remove_cart(){
    global $con;
    if(isset($_POST['remove_cart'])){
       foreach($_POST['removeitem'] as $remove_id){
         echo $remove_id;
         $delete_query="delete from `cart_details` where prod_id=$remove_id";
         $result_delete= mysqli_query($con,$delete_query);
         if($result_delete){
           echo "<script>window.open('cart.php','_self')</script>";
         }
       }
    }
}

echo $remove_item=remove_cart();

?>

<!--last child-->
<!--include footer-->
<?php
     include('include/footer.php');
?>
    </div>

<!--js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>