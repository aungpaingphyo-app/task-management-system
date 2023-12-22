<?php
require 'authentication.php'; // admin authentication check 

// auth check
if(isset($_SESSION['admin_id'])){
  $user_id = $_SESSION['admin_id'];
  $user_name = $_SESSION['name'];
  $security_key = $_SESSION['security_key'];
 
}

if(isset($_POST['change_password_btn'])){
 $info = $obj_admin->change_password_for_employee($_POST);
}

$page_name="Login";
include("include/login_header.php");

?>



<div class="wrap shadow bg-white p-4 m-auto mt-5">
		<h1 class="h4 mb-3">Please Change your password</h1>

        <form class="form-horizontal form-custom-login" action="" method="POST">
			  <div class="form-heading" style="background: orange;">
			    <h2 class="text-center"></h2>
			  </div>
			  <!-- <div class="login-gap"></div> -->
			  <?php if(isset($info)){ ?>
			  <h5 class="alert alert-danger"><?php echo $info; ?></h5>
			  <?php } ?>
			  
			  <div class="form-group">
			  	<input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required/>
			    <input type="password" class="form-control mb-3" placeholder="Password" name="password" required/>
			  </div>
			  <div class="form-group">
			    <input type="password" class="form-control mb-3" placeholder="Retype Password" name="re_password" required/>
			  </div>
			  <button type="submit" name="change_password_btn" class="btn btn-sm btn-primary">Change Password</button>
			</form>
	</div>



<?php

include("include/footer.php");

?>
