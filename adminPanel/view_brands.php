<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
        <th>Sl No</th>
        <th>Brand Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_brands="select * from `brands`";
       $result_brands=mysqli_query($con,$get_brands);
       $number=0;
       while($row=mysqli_fetch_assoc($result_brands)){
          $brand_id=$row['brand_id'];
          $brand_title=$row['brand_title'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $brand_title?></td>
          <td><a href='admin.php?edit_brand=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td><a href='#' class='text-light delete-btn' data-brand-id='<?php echo $brand_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
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
        var brandId = this.getAttribute('data-brand-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_brand=' + brandId;
    });
});
</script>