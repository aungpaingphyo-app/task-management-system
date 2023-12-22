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


if (isset($_GET['delete_task'])) {
  $action_id = $_GET['task_id'];

  $sql = "DELETE FROM task_info WHERE task_id = :id";
  $sent_po = "task-info.php";
  $obj_admin->delete_data_by_this_method($sql, $action_id, $sent_po);
}

if (isset($_POST['add_task_post'])) {
  $obj_admin->add_new_task($_POST);
}

$page_name = "Task_Info";
include("include/sidebar.php");
// include('ems_header.php');


?>



<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      

            <div class="well well-custom">
              <div class="gap"></div>
              <div class="row">
                <div class="col-md-8">
                  <?php if ($user_role == 1) { ?>
                    <div class="btn-group">
                      <button class="btn btn-success btn-menu" data-toggle="modal" data-target="#myModal"><a href="add-task.php">Assign New Task</a></button>
                    </div>
                  <?php } ?>
                </div>
              </div>

              <center>
                <h3>Task Management Section</h3>
              </center>

              <div class="table-responsive">
                <table class="table table-striped table-codensed table-custom">
                  <tr>

                    <th>No</th>
                    <th>Task Title</th>
                    <th>Assigned To</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>


                  <?php
                  if ($user_role == 1) {
                    $sql = "SELECT a.*, b.fullname 
                        FROM task_info a
                        INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                        ORDER BY a.task_id DESC";
                  } else {
                    $sql = "SELECT a.*, b.fullname 
                  FROM task_info a
                  INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                  WHERE a.t_user_id = $user_id
                  ORDER BY a.task_id DESC";
                  }

                  $info = $obj_admin->manage_all_info($sql);
                  $serial  = 1;

                  $num_row = $info->rowCount();

                  if ($num_row == 0) {

                    echo '<tr><td colspan="7">No Data found</td></tr>';
                  }
                  while ($row = $info->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $serial;
                          $serial++; ?></td>
                      <td><?php echo $row['t_title']; ?></td>
                      <td><?php echo $row['fullname']; ?></td>
                      <td><?php echo $row['t_start_time']; ?></td>
                      <td><?php echo $row['t_end_time']; ?></td>
                      <td>
                        <?php if ($row['status'] == 1) {
                          echo "In Progress<span class='glyphicon glyphicon-refresh'></span>";
                        } elseif ($row['status'] == 2) {
                          echo "Completed <span style='color:#00af16;' class=' glyphicon glyphicon-ok' >";
                        } else {
                          echo "Incomplete <span style='color:#d00909;' class=' glyphicon glyphicon-remove' >";
                        } ?>

                      </td>

                      <td>
                        <a title="Update Task" href="edit-task.php?task_id=<?php echo $row['task_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                        <a title="View" href="task-details.php?task_id=<?php echo $row['task_id']; ?>"><span class="glyphicon glyphicon-folder-open"></span></a>&nbsp;&nbsp;
                        <?php if ($user_role == 1) { ?>
                          <a title="Delete" href="?delete_task=delete_task&task_id=<?php echo $row['task_id']; ?>" onclick=" return check_delete();"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php } ?>
                    </tr>
                  <?php } ?>



                </table>
              </div>
            </div>

      </div>

    </div>
  </main>



 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script type="text/javascript">
    flatpickr('#t_start_time', {
      enableTime: true
    });

    flatpickr('#t_end_time', {
      enableTime: true
    });
  </script>

<?php

include("include/footer.php");

?>








