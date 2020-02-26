<?php
require'header.php'; 
require_once'dbcon.php';

?>
<section class="content">
<div class="row">
     <div class="col-md-8 col-sm-9 col-xs-12">
       <div class="box box-aqua">
            	<div class="box-header with-border">
             		 <h3 class="box-title">Add Next Action to Follow Up This Lead</h3>
             		 <div class="pull-right" style="margin:5px;">
             		 	<?php 
             		 	    $get_id= $_GET['id'];
             		 	    $pid= $_GET['pid'];
             		 	    
             		 	    $qi= mysqli_query($con, "SELECT expectation FROM lead WHERE id= '$get_id' ");
             		 	    $roww= mysqli_fetch_array($qi);
             		 	    $date_reg= $roww['date_reg'];
             		 	    $expectation = $roww['expectation'];
             		 	    
             		 	    
             		 		if(isset($_POST['addcomment'])){
             		 		    
                                            $last= mysqli_query($con, "SELECT id FROM `lead_history` WHERE lead_id ='$get_id' ORDER BY `next_action_date` DESC LIMIT 1");
             		 			                 $Q= mysqli_fetch_array($last);
                                                    $last_id= $Q['id'];
                                                    $update=  mysqli_query($con, "UPDATE `lead_history` SET `init` = '0' WHERE `lead_history`.`id` = '$last_id'");
                                                    
             		 			 $reg_date= date("Y-m-d");
             		 			$status=mysqli_escape_string($con, $_POST['status']);
             		 			$comment=mysqli_escape_string($con, $_POST['comment']);
             		 			$date=$_POST['date'];
             		 			$time=$_POST['time'];

             		 			
             		 				$adquery2= mysqli_query($con, "INSERT INTO lead_history VALUES(NULL,'$get_id','$status','$date','$time','$comment','1','$reg_date') ");
             		 				if($adquery2){
             		 				    if($status >= 4){
             		 				        //check if this lead exits and update else insert;
             		 				        
             		 				        $qq= mysqli_query($con,"SELECT * FROM deal WHERE `lead_id` = '$get_id' and `product_id` ='$pid'");
             		 				        
             		 				        if(mysqli_num_rows($qq) == 0){
             		 				            //hence query returned an empty row

             		 				        //$id here is the team-leader's id but in this module team lead is the on who is login
             		 				                $q2=mysqli_query($con, "INSERT INTO `deal`(
             		 				                         `deal_id`, `lead_id`, `product_id`, `deal_expectation`, `deal_status`,`deal_start_date`, `team_id`
             		 				                         ) VALUES(
             		 				                         NULL, '$get_id', '$pid', '$expectation', '$status', '$reg_date', '$team')");
             		 				            if($q2){
             		 				              echo"<span  class='h4' style='color:green;'>Your Update was Successful </span>";

             		 				            }else{
             		 				                echo"<span  class='h4' style='color:#ff0000;;'>Update failed! Please Try Again </span>";}             		 				            
             		 				         }else{// this lead already exists on the deal table
             		 				            
             		 				                $q2=mysqli_query($con, "UPDATE `deal` SET `deal_status`= '$status',`deal_close_date`='$reg_date' WHERE `lead_id`= '$get_id'");
                     		 				            if($q2){
                     		 				              echo"<span  class='h4' style='color:green;'>Your Update was Successful </span>";
        
                     		 				             }else{
                     		 				                echo"<span  class='h4' style='color:#ff0000;;'>Failed! Please Try Again </span>";
        
                     		 				            }
             		 				            
             		 				        }  
             		 				            
             		 				    }else{
             		 					echo"<span  class='h4' style='color:green;'>Your next action was added successfully </span>";
             		 				    }
             		 				}else{ echo mysqli_error($con);}

             		 		}
             		 		
             		 		$id=$_GET['id'];

             		 		$qr = "SELECT name from lead WHERE id ='$id'";
             		 			$qrr= mysqli_query($con,$qr);
             		 			$qrr= mysqli_fetch_array($qrr);
             		 				$name= $qrr['name'];
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
		             		 <input class="form-control" name="lname" readonly value="<?php echo $name; ?>"  type="text" placeholder="Enter Full Name">
		              		</div>

		              		<div class="col-xs-5">
		             			<select name="status" required class="form-control">
		             				<option value="">Select</option>
		             				<option value="1">Sales Qualified Lead</option>
		             				<option value="2">Negiotiation Level</option>
		             				<option value="3">Dated Commitment</option>
		             				<option value="4">Invoice Sent</option>
		             				<option value="5">Closed Won</option>
		             				<option value="6">Closed Lost</option>
		             			</select>
		              		 </div>
		              		
		            	</div>
	            	   
	            	    <br/>

	            	    <div class="row">
		            		    <div class="col-xs-2">
		            			<label name="" class="" for="lead">Deal Status </label>
		              		</div>
		             			
		             		    <div class="col-xs-5">
		              			<textarea class="form-control" name="comment" placeholder="Enter your Comment for Next Steps" row="5" name=""></textarea>
		              	     	</div>

						        <div class="col-xs-5">
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
						</div>
                    
						<div class="col-md-6 col-xs-12 col-sm-12 col-md-offset-3">
								<button type="submit" name="addcomment" class="btn btn-primary btn-block btn-lg"> ADD COMMENTS</button>
							</div>
		
										
	            	</form>
          		</div>
            <!-- /.box-body -->
          </div>	
    </div>

  
     <div class="col-md-4 col-sm-3 col-xs-12">

          <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"> Approaching Deadlines</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php 
              $q= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,lead.email,lead.phone,lead.company,lead.designation,lead_history.status, lead_history.next_action_time, lead_history.next_action_date,lead_history.comments
                                    FROM lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='$id' 
                                    AND next_action_date BETWEEN curdate() and curdate() + interval 7 day ORDER BY next_action_date ASC LIMIT 2");
                    if(mysqli_num_rows($q)!= 0){
                    	while ($row= mysqli_fetch_array($q)){
                      echo'

            
            <div class="">
             <h4><b>Lead Name:  '.$row['name'].'</b></h4>
             <span class="badge bg-red">Deadline: '. $row['next_action_date'].'&nbsp;&nbsp;'. $row['next_action_time'].'</span>
             <h5><i>Organisation:&nbsp;&nbsp;'.$row['company'].'</i></h5>
             <h4>Status: '. $row['status'].'</h4>
             <h4>Next Step Action:'. $row['comments'].'</h4>
             
             </div><br/>';
             			}
             		}else{
             			 echo '<span class="text-danger">You have no records or no Deadlines </span>';
             		}
             ?>
         </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>	
</section>

<?php require"footer.php"; ?>