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


if (isset($_POST['add_task_post'])) {
  $obj_admin->add_new_task($_POST);
}

$page_name = "Add_Task";
include("include/sidebar.php");
// include('ems_header.php');


?>


<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>

            <form class="card" action="" method="post" enctype="multipart/form-data">

              <div class="card-header">
                <h3 class="card-title">Assign New Task</h3>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">Task Title</label>
                      <div>
                        <input type="text" class="form-control form-control-sm" id="task_title" name="task_title" placeholder="Enter task title">
                      </div>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="" class="control-label">Start Date</label>
                      <input type="text" class="form-control form-control-sm" autocomplete="off" name="t_start_time" id="t_start_time" >

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="" class="control-label">End Date</label>
                      <input type="date" class="form-control form-control-sm" autocomplete="off" name="t_end_time" id="t_end_time">

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">Task Description</label>
                      <textarea class="form-control form-control-sm" name="task_description" id="task_description" rows="3" placeholder="Construction address" required></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">Assign To</label>
                      <div>
                      <?php 
                        $sql = "SELECT user_id, fullname FROM tbl_admin WHERE user_role = 2";
                        $info = $obj_admin->manage_all_info($sql);   
                      ?>
                        <select class="form-select" name="assign_to" id="aassign_to">
                          <option value="">Select ..</option>
                          <?php while($row = $info->fetch(PDO::FETCH_ASSOC)){ ?>
                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['fullname']; ?></option>
                        <?php } ?>

                        </select>

                      </div>
                    </div>
                  </div>


                </div>


                <div class="card-footer border-top border-info text-start">
                  <button type="submit" name="add_task_post" class="btn btn-sm btn-primary">Assign Task</button>
									<a title="Update Task" href="task-info.php"><span class="btn btn-sm btn-primary">Cancle</span></a>
										
                </div>

              </div>
            </form>



          
      </div>

    </div>
  </main>
</div>


  <?php

  include("include/footer.php");



  ?>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script type="text/javascript">
    flatpickr('#t_start_time', {
      enableTime: true
    });

    flatpickr('#t_end_time', {
      enableTime: true
    });
  </script>