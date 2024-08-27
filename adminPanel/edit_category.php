<?php

if(isset($_GET['edit_category'])){
    $edit_id=$_GET['edit_category'];
    $get_cat="select * from `categories` where category_id=$edit_id";
    $result_data=mysqli_query($con,$get_cat);
    $row_data = mysqli_fetch_assoc($result_data);
    $cat_title=$row_data['category_title'];
}
?>

<div class="container mt-2">
    <h3 class="text-center text-success">Edit Category</h3>
    <form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" value="<?php echo $cat_title ?>" name="category_title" id="category_title" required="required" aria-label="categories"
        aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-info border-0 p-2 my-3" name="edit_category" value="Update Category">
    </div>
</form>
</div>

<!-- edit products -->
<?php

if(isset($_POST['edit_category'])){
    $cat_title=$_POST['category_title'];

    // check field empty or not
    if($cat_title == '') {
        echo '<script>alert("Please fill the field")</script>';
    } else {

        //update query
        $edit_query="update `categories` set category_title='$cat_title' where category_id=$edit_id";
        $edit_result=mysqli_query($con,$edit_query);
        if($edit_result){
            echo "<script>alert('Category updated successfully')</script>";
            echo "<script>window.open('admin.php?view_category','_self')</script>";
        }
    }
}

?>