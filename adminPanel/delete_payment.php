<?php

if(isset($_GET['delete_payment'])){
    $delete_id = $_GET['delete_payment'];

    //query
    $delete_query="delete from `user_payments` where payment_id=$delete_id";
    $delete_result=mysqli_query($con,$delete_query);
    if($delete_query){
        echo "<script>alert('Payment deleted successfully')</script>";
        echo "<script>window.open('admin.php?view_payment','_self')</script>";
    }
}

?>