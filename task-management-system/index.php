<?php
require 'authentication.php'; // admin authentication check 

// auth check
if(isset($_SESSION['admin_id'])){
  $user_id = $_SESSION['admin_id'];
  $user_name = $_SESSION['admin_name'];
  $security_key = $_SESSION['security_key'];
  if ($user_id != NULL) {
    header('Location: task-info.php');
  }
}

if(isset($_POST['login_btn'])){
 $info = $obj_admin->admin_login_check($_POST);
}

$page_name="Login";
include("include/login_header.php");

?>


<div class="wrap shadow bg-white p-4 m-auto mt-5">
		<h1 class="h4 mb-3">Task Management System Login</h1>

        <!-- <div class="login-gap"></div> -->
			  <?php if(isset($info)){ ?>
			  <h5 class="alert alert-danger"><?php echo $info; ?></h5>
			  <?php } ?>

		<form action="" method="post">

			<input type="text" class="form-control mb-2" name="username" placeholder="Enter username" required>
			<input type="password" class="form-control mb-2" ng-class="{'has-error': loginForm.password.$invalid && loginForm.password.$dirty, 'has-success': loginForm.password.$valid}" name="admin_password" placeholder="Enter your password" required>

			<button type="submit" name="login_btn" class="btn btn-primary w-100 mb-2 mt-2">Login</button>
		</form>
	</div>


<?php

include("include/footer.php");

?>
