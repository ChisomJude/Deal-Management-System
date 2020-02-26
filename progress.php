<?php 
require_once'header.php';
require_once'dbcon.php';
?>

  <!-- PRODUCT LIST -->
             <div class="row">
            <div class="col-md-12">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title danger">Progress Flow</h3>

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
                   <th>Date of Last Update</th>
                  <th>Lead Details</th>
                  <th>Comments </th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody align="center">
                  <?php
              $qqr= mysqli_query($con, "SELECT * FROM lead");
              if($qqr){
                while(  $row= mysqli_fetch_array($qqr)){
                    $id=$row['id'];
                    $name=$row['name'];
                    $email=$row['email'];
                    $phone=$row['phone'];
                    $company=$row['company'];
                    $org=$row['designation'];


              $qqr= mysqli_query($con, "SELECT * FROM lead_history where lead_id='$id' ");
              if($qqrr){
                while(  $rows= mysqli_fetch_array($qqrr)){

                    $status=$rows['status'];
                    $date=$rows['next_action_date'];
                    $time=$rows['next_action_time'];
                    $comments=$rows['comments'];

                    $status = $rows['status'];

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
                                                  }


                     echo'<tr>
                  <td><span class="text-danger h5">'.$date. '&nbsp;&nbsp;'. $time.'</span></td>
                   <td ><a href="javascript:void(0)" data-toggle="collapse" data-target="#pass'.$id.'"  title=" Edit lead detials" >'.$name.'
                      <br/><i><b>'. $row['designation'].'</b>  @  '. $row['company'].'<i></a>

                              <div class="collapse" id="pass'.$id.'">
                                
                            <div class="well" style="height:auto;">
                                      
                                    <span class="text-center"></span>
                                        
                                            <div class="box-body">
                                                  <p class="h5">Email:'. $row['email'].' &nbsp;&nbsp;&nbsp;&nbsp;Phone:'. $row['phone'].'</p>';
                                          echo '<p> Designation:&nbsp;&nbsp;'.$org. '&nbsp;&nbsp;Organisation:&nbsp;&nbsp;'.$company.' </p>';
                                                  echo '</td></div></div></div>';
                 
                                                                        

                                             
             
                                          

                  echo '<td><a href="javascript:void(0)" data-toggle="collapse" data-target="#ccm'.$id.'"  title=" view conversation" >'. $comments. ' <span class="label label-success">'.$date.'</span> </a>

                                <div class="collapse" id="ccm'.$id.'">
                                
                            <div class="well" style="height:auto;">
                                      
                                    <span class="text-center"></span>
                                                <div class="box-body">

                                           ';
                                            $ffq= mysqli_query($con, "SELECT comments FROM lead_history WHERE lead_id='$id'");
                                              while($fet= mysqli_fetch_array($ffq)){
                                                  echo '<div class="">
                                                  <span class="pull-left">'.$fet['comments'].'</span>
                                                 <span class="direct-chat-timestamp pull-right label label-success">23 Jan 2:00 pm</span>
                        
                                                </div>';}

                                                echo'</div>
                              </div></div>
                 
                      </td>';
                  }
   } 
                echo'</tr>';
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
            </div>
            <!-- /.box-footer -->
          </div>
                  

       </div>

  
     </div>  </div></div>
        <?php require_once'footer.php';?>