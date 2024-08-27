<?php

include ('../include/connect.php');

if(isset($_POST['insert_product'])){

    $prod_title = $_POST['prod_title'];
    $prod_description = $_POST['description'];
    $keyords = $_POST['keywords'];
    $category = $_POST['prod_categories'];
    $brand = $_POST['prod_brands'];
    $prod_price = $_POST['price'];
    $status = 'true';

    //access images
    $prod_image1 = $_FILES['image1']['name'];
    $prod_image2 = $_FILES['image2']['name'];
    $prod_image3 = $_FILES['image3']['name'];

    //access images temp name
    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];
    $temp_image3 = $_FILES['image3']['tmp_name'];

    //check empty conditions (valiations)
    if($prod_title=='' or $prod_description=='' or $keyords=='' or $category=='' or  $brand=='' or $prod_price=='' or $prod_image1=='' or 
    $prod_image2=='' or $prod_image3=='' or $prod_price==''){
        echo "<script>alert('Please insert required fields')</script>";
        exit();
    }
    else{
        move_uploaded_file($temp_image1,"./product_images/$prod_image1");
        move_uploaded_file($temp_image2,"./product_images/$prod_image2");
        move_uploaded_file($temp_image3,"./product_images/$prod_image3");

        //insert quries
        $insert_query = "insert into `products` (title,description,keyword,category_id,brand_id,image1,image2,image3,
        price,date,status) values ('$prod_title','$prod_description','$keyords','$category','$brand','$prod_image1',
        '$prod_image2','$prod_image3','$prod_price',NOW(),'$status')";

        $result_insert = mysqli_query($con,$insert_query);
        if($result_insert){
            echo "<script>alert('Product added successfully')</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--font awesom link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css files-->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
                <!--title-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="prod_title" class="form-label">Product Title</label>
                   <input type="text" name="prod_title" id="prod_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
               </div>

               <!--description-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="description" class="form-label">Product description</label>
                   <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
               </div>

               <!--keywords-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="keywords" class="form-label">Product keywords</label>
                   <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
                </div>

                <!--categories-->
                <div class="form-outline mb-4 w-50 m-auto">
                   <select name="prod_categories" id="" class="form-select">
                        <option value="">Select category</option>
                        <?php

                           $select_query = "select * from `categories`";
                           $result_select = mysqli_query($con,$select_query);
                           while($row=mysqli_fetch_assoc($result_select)){
                               $category_title = $row['category_title'];
                               $category_id = $row['category_id'];
                               echo "<option value='$category_id'>$category_title</option>";
                           }
                        ?>
                   </select>
                </div>

                  <!--brands-->
                  <div class="form-outline mb-4 w-50 m-auto">
                   <select name="prod_brands" id="" class="form-select">
                        <option value="">Select brand</option>
                        <?php

                           $select_query = "select * from `brands`";
                           $result_select = mysqli_query($con,$select_query);
                           while($row=mysqli_fetch_assoc($result_select)){
                               $brand_title = $row['brand_title'];
                               $brand_id = $row['brand_id'];
                               echo "<option value='$brand_id'>$brand_title</option>";
                           }
                        ?>
                   </select>
                </div>

                <!--image1-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="image1" class="form-label">Product image1</label>
                   <input type="file" name="image1" id="image1" class="form-control" autocomplete="off" required="required">
                </div>

                 <!--image2-->
                <div class="form-outline mb-4 w-50 m-auto">
                   <label for="image2" class="form-label">Product image2</label>
                   <input type="file" name="image2" id="image2" class="form-control" autocomplete="off" required="required">
                </div>

                 <!--image3-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="image3" class="form-label">Product image3</label>
                   <input type="file" name="image3" id="image3" class="form-control" autocomplete="off" required="required">
                </div>

                <!--price-->
               <div class="form-outline mb-4 w-50 m-auto">
                   <label for="price" class="form-label">Product price</label>
                   <input type="text" name="price" id="price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
                </div>

                <div class="form-outline mb-4 w-50 m-auto">
                   <input type="submit" name="insert_product" value="Insert Products" class="btn btn-info mb-3 px-3">
                </div>
        </form>
    </div>
</body>
</html>