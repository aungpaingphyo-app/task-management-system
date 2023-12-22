
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


$admin_id = $_GET['admin_id'];
if(isset($_POST['btn_admin_password'])){
    $error = $obj_admin->admin_password_change($_POST,$admin_id);
}

             
$page_name="Admin";
include("include/sidebar.php");


?>

<script>
  function validate(admin_new_password,admin_cnew_password){
      var a = document.getElementById(admin_new_password).value;
      var b = document.getElementById(admin_cnew_password).value;
      if (a!=b) {
          alert("Passwords do not match");
          
      }
      return false;
  }
</script>



<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      
      
            <div class="col-md-10 col-md-offset-1">
              <div class="well">
                <h3 class="text-center bg-primary">Admin - Change Password</h3><br>


                      <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                        
                        <?php 

                        if(isset($error)){
                          ?>
                          <div class="alert alert-danger">
                            <strong>Oopps!!</strong> <?php echo $error; ?>
                          </div>
                          <?php
                          
                        }
                        ?>
                          

                          <form class="form-horizontal" role="form" action="" method="post" autocomplete="off">
                            <div class="form-group">
                              <label class="control-label col-sm-4">Old Password</label>
                              <div class="col-sm-8">
                                <input type="password" placeholder="Enter Old Password" name="admin_old_password" id="admin_old_password" list="expense" class="form-control input-custom" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-4">New Password</label>
                              <div class="col-sm-8">
                                <input type="password" placeholder="Enter New Password" name="admin_new_password" id="admin_new_password" class="form-control input-custom" min="8" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-4">Confirm New Password</label>
                              <div class="col-sm-8">
                                <input type="password" placeholder="Confirm New Password" name="admin_cnew_password" id="admin_cnew_password" list="expense" min="8" class="form-control input-custom" required>
                              </div>
                            </div>
                      
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-4 col-sm-3">
                                <button type="submit" name="btn_admin_password" class="btn btn-success">Change</button>
                                
                              </div>
                              <div class="col-sm-3">
                                <a href="manage-admin.php" class="btn btn-danger">cancel</a>
                                
                              </div>
                            </div>
                          </form> 
                        </div>
                      </div>

              
          </div>
        </div>
   
      </div>

    </div>
  </main>



<?php

include("include/footer.php");

?>

