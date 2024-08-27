<?php

if(isset($_GET['delete_category'])){
    $delete_id = $_GET['delete_category'];

    //query
    $delete_query="delete from `categories` where category_id=$delete_id";
    $delete_result=mysqli_query($con,$delete_query);
    if($delete_query){
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('admin.php?view_category','_self')</script>";
    }
}

?>