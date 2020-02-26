<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign Up - Salesruby Sales Mgt System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="jquery-simple-validator.min.js"></script>

<style>
    input:not([type="file"]).error,
textarea.error,
select.error {
  border: 1px solid red !important;
}

input:not([type="file"]).no-error,
textarea.no-error,
select.no-error {
  border: 1px solid green !important;
}

div.error-field {
  color: red;
  font-size: small;
}
</style>
</head>
<body class="myb">
	
	<div class="container">
		<div class="box11 col-md-6 col-md-offset-3" align="center">
			<img src='salesruby logo.jpg' width="100px" alt='logo-img' class="img-responsive">

			
			
<br/>				<div> <h5><a href="login.php" style="color:#ff0000">Already have an Account? Login </a></h5></div>
<br/>
<div>
				<?php
					require'dbcon.php';		
					if(isset($_POST['register'])){
						$name=mysqli_escape_string($con,$_POST['fname']);
						$email=mysqli_escape_string($con,$_POST['email']);
						$phone=mysqli_escape_string($con,$_POST['phone']);
						$user_team=mysqli_escape_string($con,$_POST['user_team']);
						$password=mysqli_escape_string($con,$_POST['password']);
						$password= md5($password);
						$user_ref = "SR-".rand(1003,9969);
						$date=date("l jS \, F Y  H:i:s A");;
						
						$query= "INSERT INTO `salesrep` (`id`, `user_ref`, `name`,  `password`, `phone`, `email`, `status`, `stat`, `last_login`, `user_team`, `user_type`)
						VALUES (NULL, '$user_ref', '$name', '$password', '$phone', '$email', 'Non-Active', '0', '$date', '$user_team', 'Salesrep')";
						
						$result = mysqli_query($con,$query) or die(mysql_error());

                        if($result){
                            ?>
                            <script>
                                $(document).ready(function(){
                                    $('#sform').hide();
                                    
                                });
                            </script>
                            <?php
                             echo "<br> <h4 style='color:green;'>You Account has been created Successfully, You can Login after Admin approval</h4>";
                        }else{
                            ?>
                            <script>
                                $(document).ready(function(){
                                    $('#sform').hide();
                                    
                                });
                            </script>
                            <?php
						echo  "<br><h4 style='color:red;'>An error occurred on account creation, please try again </h4>";
                        }
}
?>

					
					

			</div>

			<form class="" action="" method="post" validate="true" id="sform">
				<div class=""><?php echo @$msg;?> </span>
				
				<div class="col-md-8 col-md-offset-2 pb" >
					<input type="text" class="form-control" name="fname" placeholder="Full Name" required>
				</div>
				
				<div class="col-md-8 col-md-offset-2 pb" >
				<input type="text" class="form-control" name="email" placeholder="Email Address" required>
				</div>
				
					<div class="col-md-8 col-md-offset-2 pb">
					<input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlenght="11" pattern="[0][7-9]{1}[0][0-9]{8}" required>
				</div>
				
				<div class="col-md-8 col-md-offset-2 pb" >
				    <select name="user_team" class='form-control-sm form-control' required>
                                                    <option value="">Select Team </option>
                                                    <?php
                                                
                                                    $sql = mysqli_query($con,"SELECT * FROM salesrep WHERE user_team = id ");
                                                    while($row=mysqli_fetch_array($sql))
                                                    {
                                                    echo '<option value="'.$row['user_team'].'"> Team Lead by '.$row['name'].'</option>';
                                                    } ?>
                                                    </select>
				    
			</div>
					
				<div class="col-md-8 col-md-offset-2 pb" >
					<input type="password" class="form-control" name="password" id="inputPassKey" placeholder="Password" required>
				</div>
				
				<div class="col-md-8 col-md-offset-2 pb" >
					<input type="password" class="form-control" name="Cpassword" placeholder="Confirm Password" required data-match="password"
      data-match-field="#inputPassKey">
				</div>
				
				<div class="col-md-8 col-md-offset-2 pb">
					<input type="submit" name="register" value="SIGN UP" class="btn btn-primary btn-block">
				</div>

			</form>
		</div>

</div></div>
		




  <!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>





