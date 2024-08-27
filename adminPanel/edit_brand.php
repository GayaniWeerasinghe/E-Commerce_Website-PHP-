<?php

if(isset($_GET['edit_brand'])){
    $edit_id=$_GET['edit_brand'];
    $get_brand="select * from `brands` where brand_id=$edit_id";
    $result_data=mysqli_query($con,$get_brand);
    $row_data = mysqli_fetch_assoc($result_data);
    $brand_title=$row_data['brand_title'];
}
?>

<div class="container mt-2">
    <h3 class="text-center text-success">Edit Brand</h3>
    <form action="" method="post" class="mb-2 w-50 m-auto">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" value="<?php echo $brand_title ?>" name="brand_title" id="brand_title" required="required" aria-label="brands"
        aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-info border-0 p-2 my-3" name="edit_brand" value="Update Brand">
    </div>
</form>
</div>

<!-- edit products -->
<?php

if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];

    // check field empty or not
    if($brand_title == '') {
        echo '<script>alert("Please fill the field")</script>';
    } else {

        //update query
        $edit_query="update `brands` set brand_title='$brand_title' where brand_id=$edit_id";
        $edit_result=mysqli_query($con,$edit_query);
        if($edit_result){
            echo "<script>alert('Brand updated successfully')</script>";
            echo "<script>window.open('admin.php?view_brands','_self')</script>";
        }
    }
}

?>