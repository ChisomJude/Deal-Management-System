
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SaleRuby || Salesrep</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="includes/parsley3.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
       
        require 'dbcon.php';
        session_start();
          if(!isset($_SESSION['email']) ){
           header("Location:../login.php");
          }
      $id= $_SESSION['id']; $user_ref=$_SESSION['user_ref']; $team=$_SESSION['user_team'];
      $last_login=$_SESSION['last_login'];
      $q = mysqli_query($con,"SELECT * FROM salesrep WHERE id='$id' ");
      $row=mysqli_fetch_array($q);
      $now= date("l jS \, F Y  H:i:s A");
      $qq=mysqli_query($con,"UPDATE `salesrep` SET `last_login` = '$now' WHERE `salesrep`.`id` = '$id' ");
      ?>


  <header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>R</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sales</b>Ruby</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-fixed-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

       <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="avatar2.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo 'Hello  '. $row['name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="avatar2.png" class="img-circle" alt="User Image">

                <p>
                  
                  <small><?php echo $row['email'];?></small>
                  Last Login:<?php echo $last_login; ?>
                </p>
              </li>
              
             <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a class="btn btn-primary btn-flat" data-toggle="modal" href="#profile" id="modellink2"> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="avatar2.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php 
              echo "Online: " .$row['name'];
              ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-card"></i> <span>LEADS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="home"><i class="fa fa-circle-o"></i>  My Leads</a></li>
            <li><a href="addlead"><i class="fa fa-circle-o"></i> Add Lead </a></li>
          </ul>
          
           <li class="treeview">
          <a href="#">
            <i class="fa fa-area-chart"></i> <span>MY TASKS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="deadlines"><i class="fa fa-circle-o"></i>Deadlines </a></li>
            <li><a href="missed"><i class="fa fa-circle-o"></i> Missed</a></li>
            <li><a href="closed"><i class="fa fa-circle-o"></i> Closed</a></li>
          </ul>
        </li>
        
        
         <li>
          <a href="deals" class="fa fa-cubes">
             <span> DEALS </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<br><br>
  <section class="content" style="margin-bottom:0px;">
        <div class="row">
  
               <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <a href="addlead">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user-plus"></i></span>
            
                        <div class="info-box-content">
                           <span class="info-box-text">Add New Lead</span>
                              <span class="info-box-number">
                                  <?php require_once'dbcon.php';
                                    $qq= "SELECT COUNT(id) AS mylead FROM lead WHERE salerep_id='$id'";
                                    $total =mysqli_query($con,$qq);
                                    $total= mysqli_fetch_array($total);
                
                                      echo $total['mylead']." Total Lead(s) Added"; //fetch from db
                                  ?>
                              </span>
                        </div>
                        </a>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
            
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box ">
                        <a href="closed">
                        <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">Closed Deals</span>
                          <span class="info-box-number">
                            <?php require_once'dbcon.php';
                                $qq= "SELECT COUNT(lead.id) AS mylead FROM  lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='$id'
                              AND next_action_date < CURDATE() AND lead_history.status >= '5'";
                        
                          
                                $total =mysqli_query($con,$qq);
                                $total= mysqli_fetch_array($total);
            
                                  echo $total['mylead']." Closed Tasks"; //fetch from db
                              ?></span>
            
                        </div>
                      </a>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
            
              
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box ">
                        <a href="missed" title="Missed Schedules">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-end"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">Missed Schedules</span>
                          <span class="info-box-number"> <?php require_once'dbcon.php';
                                $qq= "SELECT COUNT(lead.id) AS mylead FROM  lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='$id'
                              AND next_action_date < CURDATE()AND init='1' AND lead_history.status <= '4'";
                                $total = mysqli_query($con,$qq);
                                $total= mysqli_fetch_array($total);
            
                                  echo $total['mylead']." Missed Tasks"; //fetch from db
                              ?></span>
            
                        </div>
                      </a>
                        <!-- /.info-box-content -->
                      </div></div>    
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box ">
                        <a href="deadlines" title="approaching Deadlines">
                        <span class="info-box-icon bg-red"><i class="fa fa-hourglass-end"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">3 Days TODO List</span>
                          <span class="info-box-number"> <?php require_once'dbcon.php';
                                $qq= "SELECT COUNT(lead.id) AS mylead FROM  lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='$id'
                              AND next_action_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY  AND lead_history.status <= '4' AND lead_history.init='1'";
                                $total =mysqli_query($con,$qq);
                                $total= mysqli_fetch_array($total);
            
                                  echo $total['mylead']." Deadline(s) Approaching"; //fetch from db
                              ?></span>
            
                        </div>
                      </a>
                        <!-- /.info-box-content -->
                      </div></div>
                
             
        </div>
     
</section>


                <div id="profile" class="modal fade" role="dialog">
                      <div class="modal-dialog" style="width:700px">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title text-danger">My Profile</h4>
                              </div>
                              <div class="modal-body ">
                              <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title">Edit Profile</h3>
                              </div>
                              <!-- /.box-header -->
                              <!-- form start -->
                              <div class="box-body">
                                  <form class="form-horizontal" id="update" method="post" action="">
                                    
                                      <div class="col-md-12">
                                          <p class="text-primary h4"> Email: <?php echo $_SESSION['email'];?></p>
                                          <p class="text-danger">You can always edit you detials here</p>
                                      </div>
            
                                       <div class="col-md-12">
                                        
                                      <div class="form-group col-md-6">
                                        <label for="inputEmail3" class="col-md-4 control-label">Name</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control col-md-8" name="name" value="<?php echo $row['name']; ?>">
                                      </div>
                                      </div>
                                       <div class="form-group col-md-6">
                                        <label for="inputEmail3" class="col-md-4 control-label">Phone</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control col-md-8" name="phone" value="<?php echo $row['phone']; ?>">
                                      </div>
                                      </div>
                                      
                                      <div class="form-group col-md-6"> 
                                        <button type="submit" name="update"  class="btn btn-info pull-right">Update Detials</button>
                                      </div>
                                       </div>
                                    </form>
            
                                       <div class=" col-md-12">
                                         <a href="javascript:void(0)" data-toggle="collapse" data-target="#password"  title=" Change My Password" >Change Password</a>
                                  
                                            <div class="collapse" id="password">
                                            
                                                 <div class="well" style="height:auto;">
                                                  
                                                    <span class="text-center"></span>
                                                      <form method="post" action="" data-parsley-validate>
                                                        <div class="box-body">
                                                            <div class="form-group col-md-12">
                                                            
                                                            <div class="col-md-12">
                                                              Enter Old password:
                                                            <input type="text" class="form-control col-md-12"  name="oldpass" required  value="">
                                                          </div>
                                                          <div class="col-md-6">
                                                             New password:
                                                            <input type="password" id="password" class="form-control col-md-12"  name="pass1" required  value="">
                                                          </div>
                                                           <div class="col-md-6">
                                                              Confirm New password:
                                                            <input type="password" class="form-control col-md-12"  name="pass2"  value="" data-parsley-trigger='keyup' data-parsley-equalto="#password" data-parsley-equalto-message="<i class='fa fa-warning'> Password Mismatch</i>">
                                                            
                                                          </div>
                                                           <div class="col-md-6 col-md-offset-3">
                                                              <br><br>
                                                            <input type="submit" class="btn btn-danger btn-block"  name="btnpassword"  value="Update Password">
                                                          </div>
                                                          </div>
                                                        </div>
                                                      </form>
                                                      </div>
                                                </div>
                                          
                                      </div>
            
            
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                      <p>Some updates apply may not reflex till next login</p>
                                    </div>
                                    <!-- /.box-footer -->
                                  
                                  <?php  if(isset($_POST['update'])){
                                    $name=$_POST['name'];
                                    $phone=$_POST['phone'];
                                   // $username=$_POST['username'];
            
                                     $qq=mysqli_query($con,"UPDATE `salesrep` SET `name` ='$name' ,  `phone` = '$phone'  WHERE `salesrep`.`id` = '$id' ");
                                        if($qq){
                                          echo "Update Successfull.";
                                        }else{
                                          echo mysqli_error();
                                        }
            
                                  }?>
            
                            </div>
                      <!-- /.box -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
