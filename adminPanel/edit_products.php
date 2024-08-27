<?php

if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM `products` WHERE prod_id = $edit_id";
    $result_data = mysqli_query($con, $get_data);
    $row_data = mysqli_fetch_assoc($result_data);

    // Fetch product data
    $prod_title = $row_data['title'];
    $prod_description = $row_data['description'];
    $prod_keywords = $row_data['keyword'];
    $prod_cat = $row_data['category_id'];
    $prod_brand = $row_data['brand_id'];
    $prod_img1 = $row_data['image1'];
    $prod_img2 = $row_data['image2'];
    $prod_img3 = $row_data['image3'];
    $prod_price = $row_data['price'];

    // Fetch category
    $get_cat = "SELECT * FROM `categories` WHERE category_id = $prod_cat";
    $result_cat = mysqli_query($con, $get_cat);
    $row_cat = mysqli_fetch_assoc($result_cat);
    $category_title = $row_cat["category_title"];

    // Fetch brand
    $get_brand = "SELECT * FROM `brands` WHERE brand_id = $prod_brand";
    $result_brand = mysqli_query($con, $get_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand["brand_title"];
}
?>

<div class="container mt-5">
    <h2 class="text-center">Edit Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" value="<?php echo $prod_title ?>" name="product_title" id="product_title">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" class="form-control" value="<?php echo $prod_description ?>" name="product_desc" id="product_desc">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_key" class="form-label">Product Keywords</label>
            <input type="text" class="form-control" value="<?php echo $prod_keywords ?>" name="product_key" id="product_key">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_cat" class="form-label">Product Category</label>
            <select name="product_cat" class="form-select">
                <option value="<?php echo $prod_cat ?>"><?php echo $category_title ?></option>
                <?php
                $select_query = "SELECT * FROM `categories`";
                $result_select = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_select)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brand" class="form-select">
                <option value="<?php echo $prod_brand ?>"><?php echo $brand_title ?></option>
                <?php
                $select_query = "SELECT * FROM `brands`";
                $result_select = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_select)) {
                    $brand_title = $row['brand_title'];
                    $brand_id = $row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img1" class="form-label">Product Image1</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_img1" id="product_img1">
                <img src="./product_images/<?php echo $prod_img1 ?>" alt="" class="prod_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img2" class="form-label">Product Image2</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_img2" id="product_img2">
                <img src="./product_images/<?php echo $prod_img2 ?>" alt="" class="prod_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img3" class="form-label">Product Image3</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_img3" id="product_img3">
                <img src="./product_images/<?php echo $prod_img3 ?>" alt="" class="prod_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" value="<?php echo $prod_price ?>" name="product_price" id="product_price">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<!-- PHP to handle form submission -->
<?php

if (isset($_POST['edit_product'])) {
    $prod_title = $_POST['product_title'];
    $prod_description = $_POST['product_desc'];
    $prod_keywords = $_POST['product_key'];
    $prod_cat = $_POST['product_cat'];
    $prod_brand = $_POST['product_brand'];
    $prod_price = $_POST['product_price'];

    $prod_img1 = $_FILES['product_img1']['name'];
    $prod_img2 = $_FILES['product_img2']['name'];
    $prod_img3 = $_FILES['product_img3']['name'];

    $temp_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_img3 = $_FILES['product_img3']['tmp_name'];

    // Start building the update query
    $edit_query = "UPDATE `products` SET ";

    $updates = [];  // array to store the parts of the query to be updated

    // Check if each field is provided, and add it to the update array if so
    if ($prod_title != '') {
        $updates[] = "title='$prod_title'";
    }
    if ($prod_description != '') {
        $updates[] = "description='$prod_description'";
    }
    if ($prod_keywords != '') {
        $updates[] = "keyword='$prod_keywords'";
    }
    if ($prod_cat != '') {
        $updates[] = "category_id=$prod_cat";
    }
    if ($prod_brand != '') {
        $updates[] = "brand_id=$prod_brand";
    }
    if ($prod_price != '') {
        $updates[] = "price='$prod_price'";
    }

    // Check for image uploads
    if ($prod_img1 != '') {
        move_uploaded_file($temp_img1, "./product_images/$prod_img1");
        $updates[] = "image1='$prod_img1'";
    }
    if ($prod_img2 != '') {
        move_uploaded_file($temp_img2, "./product_images/$prod_img2");
        $updates[] = "image2='$prod_img2'";
    }
    if ($prod_img3 != '') {
        move_uploaded_file($temp_img3, "./product_images/$prod_img3");
        $updates[] = "image3='$prod_img3'";
    }

    // Only proceed if there are updates to be made
    if (count($updates) > 0) {
        $edit_query .= implode(", ", $updates);
        $edit_query .= " WHERE prod_id = $edit_id";

        $edit_result = mysqli_query($con, $edit_query);
        if($edit_result){
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('admin.php?view_products','_self')</script>";
        } else {
            echo "<script>alert('Failed to update product')</script>";
        }
    } else {
        echo '<script>alert("Please edit at least one field")</script>';
    }
}

?>
