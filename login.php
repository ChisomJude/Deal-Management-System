<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mystyle.css">

</head>
<body class="myb">
	
	<div class="container">
		<div class="box11 col-md-6 col-md-offset-3" align="center">
			<img src='salesruby logo.jpg' width="100px" alt='logo-img' class="img-responsive">

			
			
<br/>
			<div> <h4> <a href="signup.php" style="color:#ff0000"> Sign Up to create an Account </a></h4></div>
<br/>
<div>
				<?php
					require'dbcon.php';		
					if(isset($_POST['login'])){
						$email=mysqli_escape_string($con,$_POST['email']);
						$password=mysqli_escape_string($con,$_POST['password']);
						 $query = "SELECT * FROM `salesrep` WHERE email='$email' and password='".md5($password)."'";
							$result = mysqli_query($con,$query) or die(mysql_error());

							$type= mysqli_fetch_array($result);

							if(mysqli_num_rows($result)==1){
							$stat=$type['stat'];
							$status=$type['status'];
							$id = $type['id'];
							$last_login= $type['last_login'];
							$user_team =$type['user_team'];
							$user_ref= $type['user_ref'];
							
							
							 session_start();
					        	$_SESSION['id']=$id;
								$_SESSION['email'] = $_POST['email'];
								$_SESSION['last_login']= $last_login;
								$_SESSION['user_team'] = $user_team;
								$_SESSION['user_ref']= $user_ref;



                        if($status=="Active"){ // account is active;
							
							if($stat==0){ // user is salesrep
								header("Location:index.php"); 
							
							    
							}
							elseif($stat==1){// user is a teamlead
						
								header("Location:admni/home.php"); 
								// Redirect adminuser platform
							}
							
							elseif($stat==12){ //user is an account officer
							    	header("Location:accounts/home.php"); 
								// Redirect account-user platform
							}
							
							elseif($stat==13){ //user is a super admin
							    //	header("Location:sradmin/home.php"); 
								// Redirect account-user platform
							  @$msg= "<span style='color:red;'>User Account isnt accessible yet,Try again later </span>";
							}
							    
							}else{
							  @$msg= "<span style='color:red;'>User Account isnt accessible yet, Get a teamlead approval! </span>";
							}
							
						
							}else{
								@$msg= "<span style='color:red;'>User Not Found!</span>";	
							}
								


}

?>

					
					

			</div>

			<form class="" action="" method="post" >
				<div class=""><?php echo @$msg;?> </span>
				<div class="col-md-8 col-md-offset-2 pb" >
				<input type="text" class="form-control" name="email" placeholder="Username or Email" required>
				</div>
					
				<div class="col-md-8 col-md-offset-2 pb" >
					<input type="password" class="form-control" name="password" placeholder="Password" required>
				</div>
				
				<div class="col-md-8 col-md-offset-2 pb">
					<input type="submit" name="login" value="LOGIN" class="btn btn-primary btn-block">
				</div>
			</form>

		</div>

</div></div>
		




  <!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>





