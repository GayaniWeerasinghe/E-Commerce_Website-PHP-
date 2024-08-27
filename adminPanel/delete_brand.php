<?php

if(isset($_GET['delete_brand'])){
    $delete_id = $_GET['delete_brand'];

    //query
    $delete_query="delete from `brands` where brand_id=$delete_id";
    $delete_result=mysqli_query($con,$delete_query);
    if($delete_query){
        echo "<script>alert('Brand deleted successfully')</script>";
        echo "<script>window.open('admin.php?view_brands','_self')</script>";
    }
}

?>