<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
        <th>Product ID</th>
        <th>Product Title</th>
        <th>Product Image</th>
        <th>Product Price</th>
        <th>Total Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_products="select * from `products`";
       $result_products=mysqli_query($con,$get_products);
       $number=0;
       while($row=mysqli_fetch_assoc($result_products)){
          $prod_id=$row['prod_id'];
          $title=$row['title'];
          $image=$row['image1'];
          $price=$row['price'];
          $status=$row['status'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $title?></td>
          <td><img src='./product_images/<?php echo $image ?>' class='prod_image'/></td>
          <td><?php echo $price?>/-</td>
          <td><?php
             $get_count="select * from `orders_pending` where prod_id=$prod_id";
             $result=mysqli_query($con,$get_count);
             $rows_count=mysqli_num_rows($result);
             echo $rows_count;
          ?></td>
          <td><?php echo $status?></td>
          <td><a href='admin.php?edit_products=<?php echo $prod_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td><a href='#' class='text-light delete-btn' data-prod-id='<?php echo $prod_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
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
        var prodId = this.getAttribute('data-prod-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_products=' + prodId;
    });
});
</script>
