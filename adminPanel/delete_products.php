<?php

if(isset($_GET['delete_products'])){
    $delete_id = $_GET['delete_products'];

    //query
    $delete_query="delete from `products` where prod_id=$delete_id";
    $delete_result=mysqli_query($con,$delete_query);
    if($delete_query){
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('admin.php?view_products','_self')</script>";
    }
}

?>