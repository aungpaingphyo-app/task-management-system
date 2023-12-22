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

$task_id = $_GET['task_id'];



if (isset($_POST['update_task_info'])) {
	$obj_admin->update_task_info($_POST, $task_id, $user_role);
}

$page_name = "Edit Task";
include("include/sidebar.php");

$sql = "SELECT * FROM task_info WHERE task_id='$task_id' ";
$info = $obj_admin->manage_all_info($sql);
$row = $info->fetch(PDO::FETCH_ASSOC);

?>


<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid px-4">
			<h1 class="mt-4">Dashboard</h1>
			

			<form class="card" action="" method="post" enctype="multipart/form-data">

				<div class="card-header">
					<h3 class="card-title">Edit Task</h3>
				</div>

				<div class="card-body">
					<div class="row">

						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label required">Task Title</label>
								<div>
									<input type="text" class="form-control form-control-sm" value="<?php echo $row['t_title']; ?>" <?php if ($user_role != 1) { ?> readonly <?php } ?> val id="task_title" name="task_title" placeholder="Enter task title">
								</div>
							</div>
						</div>


						<div class="col-md-6">
							<div class="mb-3">
								<label for="" class="control-label">Strat Date</label>
								<input type="text" class="form-control form-control-sm" name="t_start_time" id="t_start_time" value="<?php echo $row['t_start_time']; ?>">

							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="" class="control-label">End Date</label>
								<input type="text" class="form-control form-control-sm"  name="t_end_time" id="t_end_time" value="<?php echo $row['t_end_time']; ?>">

							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label required">Task Description</label>
								<textarea class="form-control form-control-sm" name="task_description" id="task_description" rows="3" placeholder="Construction address" required><?php echo $row['t_description']; ?></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label required">Status</label>
								<select class="form-select" name="status" id="status">
									<option value="0" <?php if ($row['status'] == 0) { ?>selected <?php } ?>>Incomplete</option>
									<option value="1" <?php if ($row['status'] == 1) { ?>selected <?php } ?>>In Progress</option>
									<option value="2" <?php if ($row['status'] == 2) { ?>selected <?php } ?>>Completed</option>
								</select>
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
									<select class="form-select" name="assign_to" id="aassign_to" <?php if ($user_role != 1) { ?> disabled="true" <?php } ?>>
										<option value="">Select</option>

										<?php while ($rows = $info->fetch(PDO::FETCH_ASSOC)) { ?>
											<option value="<?php echo $rows['user_id']; ?>" <?php
																							if ($rows['user_id'] == $row['t_user_id']) {

																							?> selected <?php } ?>><?php echo $rows['fullname']; ?></option>
										<?php } ?>

									</select>

								</div>
							</div>
						</div>


					</div>


					<div class="card-footer border-top border-info text-start">
						<button type="submit" name="update_task_info" class="btn btn-sm btn-primary">Update Now</button>
						<a title="Update Task" href="task-info.php"><span class="btn btn-sm btn-primary">Cancle</span></a>
					</div>

				</div>
			</form>


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