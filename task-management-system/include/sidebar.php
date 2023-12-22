<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    
    <link rel="stylesheet" href="assets/bootstrap-datepicker/css/datepicker.css">
    <link rel="stylesheet" href="assets/bootstrap-datepicker/css/datepicker-custom.css">
    <script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/bootstrap-datepicker/js/datepicker-custom.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script type="text/javascript">
      
    
    /* delete function confirmation  */
    function check_delete() {
      var check = confirm('Are you sure you want to delete this?');
        if (check) {
         
            return true;
        } else {
            return false;
      }
    }
  </script>
    
    

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">Task Management System</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 m-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><b><!--<?= $auth->username ?> |--></b></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="?logout=logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

   <?php
    $user_role = $_SESSION['user_role'];
     if($user_role == 1){
    ?>

    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <li <?php if($page_name == "Task_Info" ){echo "class=\"active\"";} ?>>
                            <a class="nav-link" href="task-info.php">
                               <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Task Manage
                            </a>
                            </li>
                            
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <li <?php if($page_name == "Admin" ){echo "class=\"active\"";} ?>>
                            <a class="nav-link" href="manage-admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Admin Manage
                            </a>
                          </li>
                          <li <?php if($page_name == "User" ){echo "class=\"active\"";} ?>>
                            <a class="nav-link" href="admin-manage-user.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                User Manage
                            </a>
                          </li>
                            
                                                      
                </nav>
                
            </div>

            <?php 
     }else if($user_role == 2){

      ?>

<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <li <?php if($page_name == "Task_Info" ){echo "class=\"active\"";} ?>>
                            <a class="nav-link" href="task-info.php">
                               <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Task Manage
                            </a>
                            </li>
                            
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                                                      
                </nav>
                
            </div>

            <?php

     }else{
       header('Location: index.php');
     }

    ?>