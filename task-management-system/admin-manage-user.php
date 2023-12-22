<?php
require 'authentication.php'; // admin authentication check 

// auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
if ($user_id == NULL) {
    header('Location: index.php');
}

// check admin 
$user_role = $_SESSION['user_role'];
if($user_role != 1){
  header('Location: task-info.php');
}


if(isset($_GET['delete_user'])){
  $action_id = $_GET['admin_id'];

  $task_sql = "DELETE FROM task_info WHERE t_user_id = $action_id";
  $delete_task = $obj_admin->db->prepare($task_sql);
  $delete_task->execute();

  $attendance_sql = "DELETE FROM attendance_info WHERE atn_user_id = $action_id";
  $delete_attendance = $obj_admin->db->prepare($attendance_sql);
  $delete_attendance->execute();
  
  $sql = "DELETE FROM tbl_admin WHERE user_id = :id";
  $sent_po = "admin-manage-user.php";
  $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
}

$page_name="Admin";
include("include/sidebar.php");

if(isset($_POST['add_new_employee'])){
  $error = $obj_admin->add_new_user($_POST);
}

?>


<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      
          
          <?php if(isset($error)){ ?>
          <script type="text/javascript">
            $('#myModal').modal('show');
          </script>
          <?php } ?>
            <?php if($user_role == 1){ ?>
                <div class="btn-group mb-3">
                  <button class="btn btn-success btn-menu" data-toggle="modal" data-target="#myModal"><a href="add-user.php"> Add New User</a></button>
                </div>
              <?php } ?>
          <ul class="nav nav-tabs nav-justified nav-tabs-custom">
          </ul>
          <div class="gap"></div>
          <div class="table-responsive">
            <table class="table table-codensed table-custom">
              <thead>
                <tr>
                  <th>Serial No.</th>
                  <th>Fullname</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Temp Password</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $sql = "SELECT * FROM tbl_admin WHERE user_role = 2 ORDER BY user_id DESC";
                $info = $obj_admin->manage_all_info($sql);
                $serial  = 1;
                $num_row = $info->rowCount();
                  if($num_row==0){
                    echo '<tr><td colspan="7">No Data found</td></tr>';
                  }
                while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
              ?>
                <tr>
                  <td><?php echo $serial; $serial++; ?></td>
                  <td><?php echo $row['fullname']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['temp_password']; ?></td>
                  
                  <td><a title="Update Employee" href="update-employee.php?admin_id=<?php echo $row['user_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a title="Delete" href="?delete_user=delete_user&admin_id=<?php echo $row['user_id']; ?>" onclick=" return check_delete();"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                
              <?php  } ?>


                
              </tbody>
            </table>
          </div>
      

      </div>

    </div>
  </main>


<?php
if(isset($_SESSION['update_user_pass'])){

  echo '<script>alert("Password updated successfully");</script>';
  unset($_SESSION['update_user_pass']);
}
include("include/footer.php");

?>