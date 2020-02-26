<?php
require'header.php'; 
require_once'dbcon.php';

?>
<section class="content">
     <div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
       <div class="box box-aqua">
            	<div class="box-header with-border">
             		 <h3 class="box-title">Edit Lead Record</h3>
             		 <div class="pull-right" style="margin:5px;">
             		 	<?php 
             		 	 	$lead_id= $_GET['id'];

             		 	 	$q= "SELECT * FROM lead WHERE lead.id = '$lead_id' ";
                   			$q=mysqli_query($con,$q); 
                   			while ($f= mysqli_fetch_array($q)) {
                   				$name=$f['name'];
                   				$phone=$f['phone'];
                   				$email=$f['email'];
                   				$org= $f['company'];
                   				$role=$f['designation'];
                   				$pid= $f['product_id'];
                   				$expect = $f['expectation'];
                   				
                   				$prod= mysqli_query($con, "SELECT `product` FROM product where `pid` ='$pid' ");
                   				$prod= mysqli_fetch_array($prod);
                   				$product2= $prod['product'];
                   				
							}



             		 	?>
             		 </div>
            	</div>

            	<div class="box-body">


            			<?php
            				if(isset($_POST['update'])){
             		 			$lead= mysqli_escape_string($con, $_POST['lname']);
             		 			$lorg=mysqli_escape_string($con, $_POST['orgname']);
             		 			$lrole=mysqli_escape_string($con, $_POST['lrole']);
             		 			$lphone=mysqli_escape_string($con, $_POST['phone']);
             		 			$lemail=mysqli_escape_string($con, $_POST['email']);
             		 			$product=mysqli_escape_string($con, $_POST['product']);
             		 			$expectation =mysqli_escape_string($con, $_POST['expectn']);

             		 			$adquery= mysqli_query($con,"UPDATE lead SET name='$lead',phone='$lphone',product_id= '$product',expectation= $expectation, email='$lemail',company='$lorg', designation='$lrole' WHERE id='$lead_id'");
             		 			if($adquery){
             		 				?>
             		 				<div align='center'><br/><span style='color:green;' class='h3'>Lead detials has been updated successfully</span><br/>
             		 					
             		 					<script>
             		 						$(document).ready(function(){
             		 							$("#myform").hide();
             		 						});
             		 					</script>
             		 					<a href="home">Back to Home Page</a></div>
             		 					<?php

             		 			}else{ echo mysqli_error($con);}
             		 		}
            			 ?>

	            	<form class="" method="post" id ="myform" action="">
	            	   <div class="row">
		            		<div class="col-xs-2">
		            			<label name="name" class="" for="lead"> Lead Detials</label>
		              		</div>
		             		
		             		<div class="col-xs-10">
		             		 <input class="form-control"value="<?php echo $name; ?>" name="lname" required type="text" placeholder="Enter Full Name">
		              		</div>

		              		
		              		
		            	</div>
	            	   
	            	   <br/>

	            	   <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="org"> Organisation Details</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		 <input class="form-control" value="<?php echo $org; ?>" name="orgname" required type="text" placeholder="Enter Company Name">
		              		</div>
		              		
		              		<div class="col-xs-5">
		              		<input class="form-control" value="<?php echo $role; ?>" type="text" name="lrole" placeholder="Enter Lead Designation">
		            		</div>
	            	   </div>

	            	    <br/>
	            	   <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="lead"> Contact Details</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		 <input class="form-control" name="phone" value="<?php echo $phone; ?>" type="text" placeholder="Enter Phone Number">
		              		</div>
		              		
		              		<div class="col-xs-5">
		              		<input class="form-control" name="email" value="<?php echo $email; ?>" type="email" placeholder="Enter Email Address">
		            		</div>
	            	   </div>

	            	    <br/><hr>
		                  
		                <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="lead">Products Detials</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		    <select name="product" class='form-control' required>
                                        <option value="">Change Product or Select <b> (<?php echo $product2; ?> </b>)</option>
                                                    <?php
                                                    $sql = mysqli_query($con,"SELECT pid, product FROM product WHERE team = '$team' AND visibility = '1' ");
                                                    while($row=mysqli_fetch_array($sql))
                                                    {
                                                    echo '<option value="'.$row['pid'].'">'.$row['product'].'</option>';
                                                    } ?>
                                 </select>
		              		</div>
		              		
		              		<div class="col-xs-5">
		              		    <div class="input-group">
                                    <span class="input-group-addon">NGN</span>
                                    <input name="expectn"  type="text" class="form-control"  value=" <?php echo $expect; ?>" placeholder="Enter New Deal Expectation">
                                  </div>
		            		</div>
	            	   </div>
	            	   
	            	    <div class="row"><br>
		            		<div class="col-md-6 col-xs-12 col-sm-12 col-md-offset-3">
								<button type="submit"name="update" class="btn btn-primary btn-block btn-lg">UPDATE LEAD RECORD</button>
							</div>
		              <div>
		                  
          		</form>
            <!-- /.box-body -->
          </div>	
        </div>
                </form>
                 </div>
        </div>
        </div>

</section>
 <?php 
 require 'footer.php';

  ?>
