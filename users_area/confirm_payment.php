<?php
   include ('../include/connect.php');
   session_start();
   if(isset($_GET['order_id'])){
      $order_id= $_GET['order_id'];
      $select_data = "select * from `user_orders` where order_id=$order_id";
      $result_select = mysqli_query($con, $select_data);
      $row_fetch=mysqli_fetch_assoc($result_select);
      $invoice_number= $row_fetch["invoice_number"];
      $amount_due= $row_fetch["amount_due"];
   }

   if(isset($_POST['confirm_payment'])){
      $invoice_number=$_POST['invoice_number'];
      $amount=$_POST['amount'];
      $payment_mode=$_POST['payment_mode'];
      $insert_payments= "insert into `user_payments`(order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
      $result_insert = mysqli_query($con, $insert_payments);
      if($result_insert){
        echo "<h3 class='text-center text-light'>Successfully completed the payment.</h3>";
        echo "<script class='text-center text-light'>window.open('profile.php?my_orders','_self')</script>";
      }
      $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
      $result_orders = mysqli_query($con, $update_orders);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap -->
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-secondary">
    <h2 class="text-center mt-5 text-light">Confirm Payment</h2>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>" name="invoice_number" >
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>" name="amount" >
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" >
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment" >
            </div>
        </form>
    </div>
</body>
</html>