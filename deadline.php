<?php 
require_once'header.php';
require_once'dbcon.php';
?>
<section class="content">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title danger">Approaching Task and Schedules</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered  table-hover">
                <thead>
                <tr>
                   <th>Date of Next Action</th>
                  <th>Lead Details</th>
                  <th>Next Action</th>
                  <th> Add Next Action </th>
                </tr>
                </thead>
                <tbody align="center">
                  <?php
                  //Longest Query Ever liveth lolz 
              $qqr= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,
                lead.email,lead.phone,lead.company,lead.designation,lead_history.status, 
                lead_history.next_action_time, lead_history.next_action_date,lead_history.comments
                 FROM lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='$id'
                  AND next_action_date BETWEEN curdate() and curdate() + interval 3 day  AND lead_history.status <= '4' AND lead_history.init='1' ORDER BY next_action_date asc");
              
              if(mysqli_num_rows($qqr)!= 0){
              
              
                while(  $row= mysqli_fetch_array($qqr)){
                    $id=$row['id'];
                    $name=$row['name'];
                    $email=$row['email'];
                    $phone=$row['phone'];
                    $company=$row['company'];
                    $org=$row['designation'];
                    $status=$row['status'];
                    $date=$row['next_action_date'];
                    $time=$row['next_action_time'];
                    $comments=$row['comments'];

                     echo'<tr>
                  <td><span class="text-danger h5">'.$date. '&nbsp;&nbsp;'. $time.'</span></td>
                   <td ><a href="javascript:void(0)" data-toggle="collapse" data-target="#pass'.$id.'"  title=" View lead detials" >'.$name.'
                      <br/><i><b>'. $row['designation'].'</b>  @  '. $row['company'].'</i></a> 


                              <div class="collapse" id="pass'.$id.'">
                                
                            <div class="well" style="height:auto;">
                                      
                                    <span class="text-center"></span>
                                        
                                            <div class="box-body">
                                                  <p class="h5">Email:'. $row['email'].' &nbsp;&nbsp;&nbsp;&nbsp;Phone:'. $row['phone'].'</p>
                                          <p> Lead Status: &nbsp;&nbsp;'; $status = $row['status'];

                                                  switch ($status) {
                                                      case "1":
                                                          echo "Qualified";
                                                          break;
                                                      case "2":
                                                          echo "Called";
                                                          break;
                                                      case "3":
                                                          echo "Proposal";
                                                          break;
                                                      case "4":
                                                          echo "Invoice Sent";
                                                          break;
                                                          case "5":
                                                          echo "Closed Won";
                                                          break;
                                                          case "6":
                                                          echo "Closed Lost";
                                                          break;
                                                      default:
                                                          echo "Qualified";
                                                  };echo '<p> Designation:&nbsp;&nbsp;'.$org. '&nbsp;&nbsp;Organisation:&nbsp;&nbsp;'.$company.' </p>';
                                          echo ' </div> </div></div>';
                 
                                                                        

                                             

                 echo ' </td>
                  
                  <td>'.$comments.'</td>
                  <td><a href="addcomment?id='. $row['id'].'"data-toggle="tooltip" title="Add a Next Action"><i class="fa fa-edit"></i></a></td>

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
              <a href="home" class="uppercase"> Back to Home</a>
            </div>
            <!-- /.box-footer -->
          </div>
</section>
       


        <?php require_once'footer.php'; ?>