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
                <h5 class="alert alert-danger"><?php echo $error; ?></h5>
                <?php } ?>

            <form class="card" action="" method="post">

              <div class="card-header">
                <h3 class="card-title">Add New User</h3>
              </div>

              <div class="card-body">
                <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">Full Name</label>
                      <div>
                        <input type="text" class="form-control form-control-sm" name="em_fullname" placeholder="Enter name">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">User Name</label>
                      <div>
                        <input type="text" class="form-control form-control-sm" name="em_username" placeholder="Enter name">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label required">Email</label>
                      <div>
                        <input type="email" class="form-control form-control-sm" name="em_email" placeholder="Enter client name">
                      </div>
                    </div>
                  </div>

                </div>


                <div class="card-footer border-top border-info text-start">
                  <button type="submit" class="btn btn-sm btn-primary" name="add_new_employee">Add Employee</button>
                  <a href="admin-manage-user.php"><span class="btn btn-sm btn-primary">Cancle</span></a>
                </div>

              </div>

            </form>
           
      

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