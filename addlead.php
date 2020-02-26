<?php
require'header.php'; 
require_once'dbcon.php';

?><section class="content">
<div class="row">
     <div class="col-md-10 col-md-offset-1  col-xs-12">
       <div class="box box-aqua">
            	<div class="box-header with-border">
             		 <h3 class="box-title">Add New Lead</h3>
             		 <div class="pull-right" style="margin:5px;">
             		 	<?php 
             		 		if(isset($_POST['addlead'])){
             		 			 $reg_date= date("d-m-Y");
             		 			$lead= mysqli_escape_string($con, $_POST['lname']);
             		 			//$adname=mysqli_escape_string($con, $_POST['adname']);
             		 			$org=mysqli_escape_string($con, $_POST['orgname']);
             		 			$lrole=mysqli_escape_string($con, $_POST['lrole']);
             		 			$phone= $_POST['phone'];
             		 			$email=mysqli_escape_string($con, $_POST['email']);
             		 			$status=mysqli_escape_string($con, $_POST['status']);
             		 			$comment=mysqli_escape_string($con, $_POST['comment']);
             		 			$product=mysqli_escape_string($con, $_POST['product']);
             		 			$expectation=mysqli_escape_string($con, $_POST['expectn']);
             		 			$date=$_POST['date'];
             		 			$time=$_POST['time'];
             		 			//$dt= $date." ". $time.":00";
             		 			$q= "INSERT INTO `lead` (`id`, `name`, `date_reg`, `email`, `phone`, `company`, `designation`, `salerep_id`, `product_id`, `expectation`)
             		 			VALUES (NULL, '$lead', '$reg_date', '$email', '$phone', '$org', '$lrole', '$id', '$product', '$expectation')";
             		 			
             		 			$adquery= mysqli_query($con,$q);
             		 			if($adquery){
             		 				$get_id=mysqli_insert_id($con);
             		 				
             		 				$adquery2= mysqli_query($con, "INSERT INTO lead_history VALUES(NULL,'$get_id','$status','$date','$time','$comment','1',NOW())");
             		 				if($adquery2){
             		 					echo"<span style='color:green;'>Your Lead was added successfully </span>";
             		 				}else{ 
             		 					
             		 					echo "<span style='color:#ff0000;'>Lead Addition Failed</span>";}

             		 			}else{ echo mysqli_error($con);}
             		 		}
             		 	?>
             		 </div>
            	</div>

            	<div class="box-body">

	            	<form class="" method="post" action="">
	            	  <div class="row">
		            		<div class="col-xs-2">
		            			<label name="name" class="" for="lead"> Lead Detials</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		 <input class="form-control" name="lname" required type="text" placeholder="Enter Full Name">
		              		</div>

		              		<div class="col-xs-5">
		             			<select name="status" required class="form-control">
		             				<option value="">Select Level</option>
		             				<option value="1">Sales Qualified Lead</option>
		             				<option value="2">Negotiation Level</option>
		             				<option value="3">Dated Commitment</option>
		             			
		             			</select>
		              		 </div>
		              		
		            	</div>
	            	   
	            	   <br/>

	            	    <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="org"> Organisation Details</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		 <input class="form-control"  name="orgname" required type="text" placeholder="Enter Company Name">
		              		</div>
		              		
		              		<div class="col-xs-5">
		              		<input class="form-control " type="text" name="lrole" placeholder="Enter Lead Designation">
		            		</div>
	            	   </div>

	            	    <br/>
	            	 <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="lead"> Contact Details</label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		 <input class="form-control" name="phone"  type="text" placeholder="Enter Phone Number">
		              		</div>
		              		
		              		<div class="col-xs-5">
		              		<input class="form-control" name="email"  type="email" placeholder="Enter Email Address">
		            		</div>
	            	   </div>



                    <hr/>
	            	 <div class="row">
		            		<div class="col-xs-2">
		            			<label name="" class="" for="lead"> Product and Deal Expectation </label>
		              		</div>
		             		
		             		<div class="col-xs-5">
		             		    <select name="product" class='form-control' required>
                                        <option value="">Select Product </option>
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
                                    <input name="expectn"  type="number" class="form-control" placeholder="Enter Deal Expectation">
                                  </div>
		            		</div>
	            	   </div>
                	<hr/>
	            	  <div class="row">
		            		<div class="col-xs-2 col-md-2">
		            			<label name="" class="" for="lead">Add Next Comment </label>
		              		</div>
		             			
		             		<div class="col-xs-10 col-md-5">
		              			<textarea class="form-control" name="comment" placeholder="Enter your Comment for Next Steps" row="5" name=""></textarea>
		              	     	</div>

						   <div class="col-xs-12 col-md-5">
						           <!-- Date -->
				              	<div class="form-group">
					               <div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" name="date"  readonly placeholder="Date of Next Step" class="form-control pull-right" data-provide="datepicker" id="datepicker">
					                </div>
					                <!-- /.input group -->
					              </div>


					              <div class="form-group">
					               <div class="input-group time">
					                  <div class="input-group-addon">
					                    <i class="fa fa-clock-o"></i>
					                  </div>
						                    <input type="text" name="time"  readonly placeholder="Time of Next Step" class="form-control timepicker" data-provide="timepicker">
					                </div>
					                <!-- /.input group -->
					              </div>

							</div>
                        </div>
					  <div class="col-md-6 col-xs-12 col-sm-12 col-md-offset-3">
								<button type="submit"name="addlead" class="btn btn-primary btn-block btn-lg">ADD LEAD</button>
							</div>
		
							<script>
											$('datepicker').datepicker();
											 //Date picker
										    $('#datepicker').datepicker({
										      autoclose: true
										    });
										    //Timepicker
										    $('.timepicker').timepicker({
										      showInputs: false
										    });
											</script>
	            	</form>
          		
          		
            <!-- /.box-body -->
          </div>	
        </div>

</div>

 </div>
 </section>
 <?php 
 require 'footer.php';

  ?>