<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
       <th>Sl No</th>
       <th>Invoice Number</th>
       <th>Amount</th>
       <th>Payment Mode</th>
       <th>Paid Date</th>
       <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_payments="select * from `user_payments`";
       $result_payments=mysqli_query($con,$get_payments);
       $row_count=mysqli_num_rows($result_payments);
       if($row_count == 0){
           echo "<h2 class='text-danger text-center mt-5'>No payments received yet</h2>";
       }
       $number=0;
       while($row_data=mysqli_fetch_assoc($result_payments)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $amount=$row_data['amount'];
        $invoice_number=$row_data['invoice_number'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $invoice_number?></td>
          <td><?php echo $amount?></td>
          <td><?php echo $payment_mode?></td>
          <td><?php echo $date?></td>
          <td><a href='#' class='text-light delete-btn' data-pay-id='<?php echo $payment_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
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
        var payId = this.getAttribute('data-pay-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_payment=' + payId;
    });
});
</script>



