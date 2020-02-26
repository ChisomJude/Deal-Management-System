 <?php 
require_once'adminheader.php';
require_once'dbcon.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
<link rel="stylesheet" href="remainder.css">
<script src="remainder.js"></script>

<section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title danger">ALL LEADS FROM TEAM</h3>

              <div class="box-tools pull-right"> 
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                	<i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered  table-hover">
               <thead>
				<tr>
				    <th>SN</th>    
				  
				  <th>Lead Details</th>
				  <th>Product </th>
				  <th>Deal Status</th>
				  <th>Sales Rep</th>
				  <th>Comments and Next Action Date</th>
				 <th>Actions</th>
				</tr>
				</thead>
                <tbody align="center">

				  <?php 
				  //include'modalbox.php';
					 $q= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,lead.product_id, lead.expectation,lead.email,lead.phone,lead.salerep_id,lead.company,lead.designation,lead_history.status, lead_history.next_action_time, lead_history.next_action_date,lead_history.comments 
						FROM lead INNER JOIN lead_history 
						ON lead.id = lead_history.lead_id
						WHERE  init='1'
						ORDER BY next_action_date DESC");
						   
						   
					if($q){
					   $x=0;
					    while ($row= mysqli_fetch_array($q)){
					        $product= $row['product_id'];
					        $pro= mysqli_query($con, "SELECT product FROM product WHERE `pid` = '$product'");
					        $pro= mysqli_fetch_array($pro);
					        $product= $pro['product'];
					        
					     $x++;
					 	 $repid= $row['salerep_id'];
						$rep = mysqli_query($con,"SELECT name FROM salesrep WHERE id='$repid' ");
						$rep = mysqli_fetch_array($rep);
						$repname= $rep['name'];
							

					  echo'<tr>
				  <td>'.$x.'</td>
				  <td>
				  <a href="editlead?id='. $row['id'].'"data-toggle="tooltip"  title="Edit lead detials">'.$row['name'].'
					  <br/><i><b>'. $row['designation'].'</b>  @  '. $row['company'].'<i></a><br/>
					<b>  Date Added:</b>'.$row['date_reg'].'<br> <b>Contact:</b> '. $row['email'].' &nbsp;&nbsp;'. $row['phone'].'
						  
						
				  </td>
				  
				  <td>Product: '. $product.' <br>Expectation:'. $row['expectation'].'</td>
				  <td>'; $status = $row['status'];

						  switch ($status) {
							   case "1":
                                    echo "<small class='label bg-maroon'> Sales Qualified Lead </small>";
                                    break;
                                  case "2":
                                    echo "<small class='label bg-navy'> Negotiation Level </small>";
                                    break;
                                  case "3":
                                    echo "<small class='label label-info'> Dated Commitment </small>";
                                    break;
                                  case "4":
                                    echo "<small class='label label-info'> Invoice Sent </small>";
                                    break;
                                    case "5":
                                    echo "<small class='label label-success'> Closed Won </span>";
                                    break;
                                    case "6":
                                    echo "<small class='label label-danger'> Closed Lost </small>";
                                    break;
							  default:
								  echo "";
						  };
						  echo '</td>
						    <td> '. $repname.'</td>

				  <td>'.$row['comments'].'<br><b>Next Follow Up:</b> <span style="color:#ff0000"><b>'.$row['next_action_date'].' &nbsp;&nbsp;'. $row['next_action_time'].'</b></span></td>
				  
				  <td>

				  <a href="writecomments?id='. $row['id'].'&repid='.$repid.'"data-toggle="tooltip" title="Write to Salesrep about Lead"><i class="fa fa-edit"></i></a>&nbsp; &nbsp;| 
				  
				   <a href="comments?id='. $row['id'].'"data-toggle="tooltip" title="View Thread"><i class="fa fa-eye text-info"></i></a>&nbsp; &nbsp;| 
				  <a href="del?id='. $row['id'].'"data-toggle="tooltip" title="Delete Lead"><i class="fa fa-trash text-danger"></i></a>
				 


				  </td>
					</tr>';
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

