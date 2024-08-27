<!-- <h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <?php
       $get_orders="select * from `user_orders`";
       $result_orders=mysqli_query($con,$get_orders);
       $row_count=mysqli_num_rows($result_orders);
       

   if($row_count == 0){
      echo "<h2 class='text-danger text-center mt-5'>No orders yet</h2>";
   }
   else{
    echo "<tr class='text-center'>
       <th>Sl No</th>
       <th>Due Amount</th>
       <th>Invoice Number</th>
       <th>Total Products</th>
       <th>Order Date</th>
       <th>Status</th>
       <th>Delete</th>
   </tr>
   </thead>
   <tbody class='bg-secondary text-light'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
        $number++;
        echo "
        <tr class='text-center' >
        <td>$number</td>
        <td>$amount_due</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$order_status</td>
        <td><a href='admin.php?delete_order order_id=<?php echo $order_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
    }
        
   }
   ?>

</tbody>
</table> -->


<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
       <th>Sl No</th>
       <th>Due Amount</th>
       <th>Invoice Number</th>
       <th>Total Products</th>
       <th>Order Date</th>
       <th>Status</th>
       <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_orders="select * from `user_orders`";
       $result_orders=mysqli_query($con,$get_orders);
       $row_count=mysqli_num_rows($result_orders);
       if($row_count == 0){
           echo "<h2 class='text-danger text-center mt-5'>No orders yet</h2>";
       }
       $number=0;
       while($row_data=mysqli_fetch_assoc($result_orders)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $amount_due ?></td>
          <td><?php echo $invoice_number?></td>
          <td><?php echo $total_products ?></td>
          <td><?php echo $order_date?></td>
          <td><?php echo $order_status?></td>
          <td><a href='#' class='text-light delete-btn' data-order-id='<?php echo $order_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
        </tr>
      <?php
       }
    ?>
    
</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h6>Are you sure you want to delete this?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success">
          <a id="confirmDelete" href='#' class="text-decoration-none text-light">Yes</a>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        var orderId = this.getAttribute('data-order-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_order=' + orderId;
    });
});
</script>






