<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-4" >
<thead class="bg-info">
    <tr class='text-center'>
       <th>Sl No</th>
       <th>User Name</th>
       <th>User Email</th>
       <th>User Image</th>
       <th>User Address</th>
       <th>User Mobile</th>
       <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
    <?php
       $get_users="select * from `user_table`";
       $result_users=mysqli_query($con,$get_users);
       $row_count=mysqli_num_rows($result_users);
       if($row_count == 0){
           echo "<h2 class='text-danger text-center mt-5'>No users registered yet</h2>";
       }
       $number=0;
       while($row_data=mysqli_fetch_assoc($result_users)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_image=$row_data['user_image'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
          $number++;
          ?>
          <tr class='text-center' >
          <td><?php echo $number ?></td>
          <td><?php echo $username?></td>
          <td><?php echo $user_email?></td>
          <td><img src="../users_area/user_images/<?php echo $user_image?>" alt="<?php echo $username?>" class='user_image'></td>
          <td><?php echo $user_address?></td>
          <td><?php echo $user_mobile?></td>
          <td><a href='#' class='text-light delete-btn' data-user-id='<?php echo $user_id ?>' data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
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
        <h6>Are you sure you want to delete this user?</h6>
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
        var userId = this.getAttribute('data-user-id');
        var deleteLink = document.getElementById('confirmDelete');
        deleteLink.href = 'admin.php?delete_user=' + userId;
    });
});
</script>



