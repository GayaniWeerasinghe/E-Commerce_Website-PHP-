<?php

// include 'include/connect.php';

//displaing products
function getproducts(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query = "select * from `products` order by rand() limit 0,9";
             $result_query = mysqli_query($con,$select_query);
             while($row = mysqli_fetch_assoc($result_query)){
                 $prod_id = $row['prod_id'];
                 $prod_title = $row['title'];
                 $prod_descript = $row['description'];
                 $prod_image = $row['image1'];
                 $prod_price = $row['price'];
                 $category_id = $row['category_id'];
                 $brand_id = $row['brand_id'];

                 echo " <div class='col-md-4 mb-2'>
                 <div class='card'>
                    <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt=$prod_title>
                    <div class='card-body'>
                    <h5 class='card-title'>$prod_title</h5>
                    <p class='card-text'>$prod_descript</p>
                    <p class='card-text'>Price: $prod_price/=</p>
                    <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$prod_id' class='btn btn-secondary'>View more</a>
                    </div>
                 </div>
                 </div> ";
             }
}
}
}

//displaing all products
function get_all_products(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query = "select * from `products` order by rand()";
             $result_query = mysqli_query($con,$select_query);
             while($row = mysqli_fetch_assoc($result_query)){
                 $prod_id = $row['prod_id'];
                 $prod_title = $row['title'];
                 $prod_descript = $row['description'];
                 $prod_image = $row['image1'];
                 $prod_price = $row['price'];
                 $category_id = $row['category_id'];
                 $brand_id = $row['brand_id'];

                 echo " <div class='col-md-4 mb-2'>
                 <div class='card'>
                    <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt=$prod_title>
                    <div class='card-body'>
                    <h5 class='card-title'>$prod_title</h5>
                    <p class='card-text'>$prod_descript</p>
                    <p class='card-text'>Price: $prod_price/=</p>
                    <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$prod_id' class='btn btn-secondary'>View more</a>
                    </div>
                 </div>
                 </div> ";
             }
}
}
}

//getting unique categories
function get_unique_categories(){
        global $con;
    
        //condition to check isset or not
        if(isset($_GET['category'])){
            $category_id = $_GET['category'];
        $select_query = "select * from `products` where category_id = '$category_id' ";
                 $result_query = mysqli_query($con,$select_query);
                 $num_of_rows=mysqli_num_rows($result_query);
                 if($num_of_rows==0){
                    echo '<h2 class="text-center text-danger">No Stocks for this Category!!<h2>';
                 }
                 while($row = mysqli_fetch_assoc($result_query)){
                     $prod_id = $row['prod_id'];
                     $prod_title = $row['title'];
                     $prod_descript = $row['description'];
                     $prod_image = $row['image1'];
                     $prod_price = $row['price'];
                     $category_id = $row['category_id'];
                     $brand_id = $row['brand_id'];
    
                     echo " <div class='col-md-4 mb-2'>
                     <div class='card'>
                        <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt=$prod_title>
                        <div class='card-body'>
                        <h5 class='card-title'>$prod_title</h5>
                        <p class='card-text'>$prod_descript</p>
                        <p class='card-text'>Price: $prod_price/=</p>
                        <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                        <a href='product_details.php?product_id=$prod_id' class='btn btn-secondary'>View more</a>
                        </div>
                     </div>
                     </div> ";
                 }
    }
    }

    //getting unique categories
function get_unique_brands(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id = $_GET['brand'];
    $select_query = "select * from `products` where brand_id='$brand_id'";
             $result_query = mysqli_query($con,$select_query);
             $num_of_rows=mysqli_num_rows($result_query);
             if($num_of_rows==0){
                echo '<h2 class="text-center text-danger">This Brand is not available for service!!<h2>';
             }
             while($row = mysqli_fetch_assoc($result_query)){
                 $prod_id = $row['prod_id'];
                 $prod_title = $row['title'];
                 $prod_descript = $row['description'];
                 $prod_image = $row['image1'];
                 $prod_price = $row['price'];
                 $category_id = $row['category_id'];
                 $brand_id = $row['brand_id'];

                 echo " <div class='col-md-4 mb-2'>
                 <div class='card'>
                    <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt=$prod_title>
                    <div class='card-body'>
                    <h5 class='card-title'>$prod_title</h5>
                    <p class='card-text'>$prod_descript</p>
                    <p class='card-text'>Price: $prod_price/=</p>
                    <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$prod_id' class='btn btn-secondary'>View more</a>
                    </div>
                 </div>
                 </div> ";
             }
}
}



//displaying brands in sidenav
function getbrands(){
    global $con;

    $select_brands = "select * from brands";
            $result_select = mysqli_query($con,$select_brands);
            while($row_data = mysqli_fetch_assoc($result_select)){
              $brand_title = $row_data['brand_title'];
              $brand_id = $row_data['brand_id'];
              echo "<li class='nav-item'>
              <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
              </li>";
            }
}

//displaying categories in sidenav
function getcategories(){
    global $con;

    $select_cats = "select * from categories";
            $result_select = mysqli_query($con,$select_cats);
            while($row_data = mysqli_fetch_assoc($result_select)){
              $category_title = $row_data['category_title'];
              $category_id = $row_data['category_id'];
              echo "<li class='nav-item'>
              <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
            </li>";
            }
}

// Searching products
function search_product() {
    global $con;

    if (isset($_GET['search_data'])) {
        // Debugging output to confirm 'search_data' is set
        echo "<!-- search_data is set: " . htmlspecialchars($_GET['search_data']) . " -->";

        $search_data_value = mysqli_real_escape_string($con, $_GET['search_data']); // Prevent SQL injection
        $search_query = "SELECT * FROM `products` WHERE keyword LIKE '%$search_data_value%'";

        // Debugging output to check SQL query
        echo "<!-- SQL query: $search_query -->";

        $result_query = mysqli_query($con, $search_query);

        // Check if the query executed successfully
        if (!$result_query) {
            echo "<h2 class='text-center text-danger'>Error: " . mysqli_error($con) . "</h2>";
            return;
        }

        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows == 0) {
            echo '<h2 class="text-center text-danger">No results match. No Stocks for this Category!</h2>';
        } else {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $prod_id = $row['prod_id'];
                $prod_title = $row['title'];
                $prod_descript = $row['description'];
                $prod_image = $row['image1'];
                $prod_price = $row['price'];

                // Output the product card
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt='$prod_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$prod_title</h5>
                                <p class='card-text'>$prod_descript</p>
                                <p class='card-text'>Price: $prod_price/=</p>
                                <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                                <a href='product_details.php?product_id=$prod_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                      </div>";
            }
        }
    }
}



//View more details fuction
function view_more(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            $product_id = $_GET['product_id'];
    $select_query = "select * from `products` where prod_id=$product_id ";
             $result_query = mysqli_query($con,$select_query);
             while($row = mysqli_fetch_assoc($result_query)){
                 $prod_id = $row['prod_id'];
                 $prod_title = $row['title'];
                 $prod_descript = $row['description'];
                 $prod_image = $row['image1'];
                 $prod_image2 = $row['image2'];
                 $prod_image3 = $row['image3'];
                 $prod_price = $row['price'];
                 $category_id = $row['category_id'];
                 $brand_id = $row['brand_id'];

                 echo " <div class='col-md-4 mb-2'>
                 <div class='card'>
                    <img src='./adminPanel/product_images/$prod_image' class='card-img-top' alt=$prod_title>
                    <div class='card-body'>
                    <h5 class='card-title'>$prod_title</h5>
                    <p class='card-text'>$prod_descript</p>
                    <p class='card-text'>Price: $prod_price/=</p>
                    <a href='index.php?add_to_cart=$prod_id' class='btn btn-info'>Add to cart</a>
                    <a href='index.php' class='btn btn-secondary'>Go Home</a>
                    </div>
                 </div>
                 </div> 
                 
                 <div class='col-md-8'>
                   <!-- related images -->
                   <div class='row'>
                      <div class='col-md-12'>
                        <h3 class='text-center text-info mb-5'>Related Products</h3>
                   </div>
                   <div class='col-md-6'>
                     <img src='./adminPanel/product_images/$prod_image2' class='card-img-top' alt=$prod_title>
                   </div>
                   <div class='col-md-6'>
                    <img src='./adminPanel/product_images/$prod_image3' class='card-img-top' alt=$prod_title>
                   </div>
            </div>
         </div>";


             }
}
}
}
}

//get IP address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;


//cart function
function cart(){
   if(isset($_GET['add_to_cart'])){
      global $con;
      $ip = getIPAddress();
      $get_product_id= $_GET['add_to_cart'];
      $select_query = "select * from `cart_details` where ip_address='$ip' and prod_id=$get_product_id";
      $result_query= mysqli_query($con,$select_query);
      $num_of_rows=mysqli_num_rows($result_query);
                 if($num_of_rows>0){
                    echo '<script>alert("This item is already present inside the cart!")</script>';
                    echo '<script>window.open("index.php","_self")</script>';
                 }
                 else{
                    $insert_query = "insert into `cart_details` (prod_id,ip_address,quantity) values($get_product_id,'$ip','1')";
                    $result_query= mysqli_query($con,$insert_query);
                    echo '<script>alert("Item is added to cart!")</script>';
                    echo '<script>window.open("index.php","_self")</script>';
                 }
   }
}

// get cart item numbers function
function cart_item(){

    if(isset($_GET['add_to_cart'])){
        global $con;
        $ip = getIPAddress();
        $select_query = "select * from `cart_details` where ip_address='$ip'";
        $result_query= mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }else{
            global $con;
            $ip = getIPAddress();
            $select_query = "select * from `cart_details` where ip_address='$ip'";
            $result_query= mysqli_query($con,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
        }

        echo $count_cart_items;
     }

//total price function
function total_cart_price(){
    global $con;
    $ip = getIPAddress();
    $total_price= 0;
    $cart_query= "select * from `cart_details` where ip_address='$ip'";
    $result= mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result)){
        $prod_id= $row['prod_id'];
        $select_products="select * from `products` where prod_id=$prod_id";
        $result_products= mysqli_query($con,$select_products);
        while($row_price=mysqli_fetch_array($result_products)){
              $product_price=array($row_price['price']); //[200,500]
              $product_values=array_sum($product_price);  //[700]
              $total_price+=$product_values; //700
    }
}
  echo $total_price;
}

//get user order deails
function get_user_order_details(){
    global $con;
    $username = $_SESSION['username'];
    $get_details="select * from `user_table` where username='$username'";
    $result= mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result)){
        $user_id=$row_query["user_id"];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="select * from `user_orders` where user_id=$user_id and order_status='pending'";
                    $result_orders= mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders);
                    if($row_count> 0){
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class= 'text-danger'>$row_count</span> pending orders.</h3>
                        <p class='text-center'><a class='text-dark' href='profile.php?my_orders'>Order Details</a></p>";
                    }else{
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders.</h3>
                        <p class='text-center'><a class='text-dark' href='../index.php'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}

?>