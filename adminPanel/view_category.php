<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
        <th>Sl No</th>
        <th>Category Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_categories="select * from `categories`";
       $result_categories=mysqli_query($con,$get_categories);
       $number=0;
       while($row=mysqli_fetch_assoc($result_categories)){
          $cat_id=$row['category_id'];
          $cat_title=$row['category_title'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $cat_title?></td>
          <td><a href='admin.php?edit_category=<?php echo $cat_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
          <td><a href='#' class='text-light delete-btn' data-cat-id='<?php echo $cat_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
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
        var catId = this.getAttribute('data-cat-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_category=' + catId;
    });
});
</script>
