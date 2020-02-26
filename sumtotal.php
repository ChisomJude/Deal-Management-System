 <?php 
require_once'header.php';
require_once'dbcon.php';
?>


<section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title danger">DEAL EXPECTATIONS</h3>

              <div class="box-tools pull-right"> 
              <?php echo $msg; 
                    echo $sms;
                    echo '<span class="h4" style="color:#ff0000;">'.$_GET['msg'].'</span>';
              ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                	<i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered  table-hover">
               <thead>
				<tr>
				  <th>SN</th>    
				  <th>Lead Details</th>
				  <th>Product </th>
				  
				  <th>Expectation</th>
				  <th>Deal Status</th>
				  <th>Deal-Progress</th>
				  <th>Approvals</th>
				 
				 </tr>
				</thead>
                <tbody align="center">

				  <?php 
				    if(isset($_GET['approve'])){
				        $lid= $_GET['approve'];
				        $appr= mysqli_query($con,"UPDATE deal set `team_approval` = '1' WHERE lead_id ='$lid'  ");  
				        if($appr){
				            $sms = '<span style="color:green"> Approval was Successful! </span>';
				        }else{   $sms= '<span style="color:red"> Approval Fail! </span>'; }
				      }
				  
				  //include'modalbox.php';
					 
                        $q= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,lead.product_id, lead.expectation,lead.email,lead.phone,
                                                lead.company,lead.designation,deal.deal_id,deal.deal_expectation, deal.closed_amount,deal.deal_start_date,
                                                deal.deal_close_date,deal.deal_status, deal.team_approval, deal.account_approval 
                                                FROM lead INNER JOIN deal ON lead.id = deal.lead_id
                                                WHERE lead.salerep_id='$id' ");
						   
						    
					if($q){
					   $x=0;
					    while($row= mysqli_fetch_array($q)){
					        $product= $row['product_id'];
					        $pro= mysqli_query($con, "SELECT product, product_cat FROM product WHERE `pid` = '$product'");
					        $pro= mysqli_fetch_array($pro);
					        $product_name= $pro['product'];  $product_desc= $pro['product_cat'];
					       
					     $x++;
					 	 //$repid= $row['salerep_id'];
						//$rep = mysqli_query($con,"SELECT name FROM salesrep WHERE id='$repid' ");
						//$rep = mysqli_fetch_array($rep);
						//$repname= $rep['name'];
							

					  echo'<tr>
				  <td>'.$x.'</td>
				  <td>
				  <a href="editlead?id='. $row['id'].'"data-toggle="tooltip"  title="Edit lead detials">'.$row['name'].'
					  <br/><i><b>'. $row['designation'].'</b>  @  '. $row['company'].'<i></a><br/>
					<b> Date Added:</b>'.$row['date_reg'].'<br> <b>Contact:</b> '. $row['email'].' &nbsp;&nbsp;'. $row['phone'].'
						  
						
				  </td>
				  <td>Product: '. $product_name.' <br> Product Description:'. $product_desc.'</td>
				  <td> <b>NGN '.$row['expectation'].'</b></td><td>';
				  $status = $row['deal_status'];

						  switch ($status) {
                                  case 4:
                                    echo "<span class='label label-info'> Invoice Sent </span><br>";
                                    break;
                                    case 5:
                                    echo "<span class='label label-success'> Closed Won </span>";
                                    break;
                                    case 6:
                                    echo "<span class='label label-danger'> Closed Lost </span>";
                                    break;
							  default:
								  echo "";
						  };
						 
						 if($row['closed_amount']== 0){
						     $amount= "NGN 0.00";
						 }else{
						     $amount= $row['closed_amount'];
						 }
						 if($row['team_approval']== 0 && $row['deal_status'] >=5){
						     $team_appr= "<span class='label label-danger'> Awaiting Team-Lead Approval </span>";
						 }elseif($row['team_approval']== 1 && $row['deal_status'] >=5){
						    $team_appr= "<span class='label label-success'> Approved by Team-Lead </span>"; 
						 }else{
						      $team_appr = "<span class='label label-danger'> Not due for Approval</span>";
						 }
						 
						 
						 if($row['account_approval']== 0 && $row['deal_status'] >=5){
						     $acc_appr= "<span class='label label-danger'> Awaiting Account Approval </span>";
						 }elseif($row['account_approval']== 0 && $row['deal_status'] >=5){
						    $acc_appr= "<span class='label label-success'> Approved by Accounts Dept </span>"; 
						 }else{
						     $acc_appr = "<span class='label label-danger'> Not due for Approval </span>";
						 }
						 
						 
						  echo '</td>


				  <td> <b> Deal Start Date:<i>'.$row['deal_start_date'].'</i></b><br><br>
				       <b>Deal Close Date: <i style="color:#ff0000">'.$row['deal_close_date'].' </b><br><br>
				       
				  <td>'.$team_appr.' <br><br>'.$acc_appr.'<b><br> Approved Amount: <span style="color:green"><b>'. $amount.'</b></span></td> </td>
				  ';
					 }
				  ?>
				
			   
				<?php 
				  }
				?>
			  </tbody>
                
              </table>
             
             
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase"></a>
            </div>
            <!-- /.box-footer -->
          </div>
</section>


        <?php require_once'footer.php';?>

