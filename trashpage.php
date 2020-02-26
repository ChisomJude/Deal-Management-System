
          <a href="comments?id='. $row['id'].'"data-toggle="tooltip" title="View Comments"><i class="fa fa-eye fa-2x" style="color:red"></i></a>


<div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                      
                        
                          <?php 
              $q= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,lead.email,lead.phone,
                lead.company,lead.designation,lead_history.status, lead_history.next_action_time, 
                lead_history.next_action_date,lead_history.comments 
                FROM lead INNER JOIN lead_history ON lead.id = lead_history.lead_id
                 WHERE lead.salerep_id='1' AND lead_history.status<='4' 
                 ORDER BY next_action_date ASC");
                    if($q){
                      while ($row= mysqli_fetch_array($q)){

    //zoho.com salesforce.com salesloft.com sample crms outreach.io



                      
                          echo'<div class="direct-chat-msg col-md-10">
                          <div class="direct-chat-info clearfix">
                           <span class="direct-chat-name "> <a href="javascript:void(0)" data-toggle="collapse" data-target="#pass'. @$row['id'].'"  title=" Edit lead detials" >'.$row['name'].'</a></span>'; ?>
                        </div>
                        
                        <!-- /.direct-chat-img -->
                       <?php echo '<div class="direct-chat-text col-md-7" id="pass'.$row['id'].' ">
                                                  <span class="pull-left">Is this  really for ? That\'s unbelievable!</span>
                                                 <span class="direct-chat-timestamp pull-right label label-success">23 Jan 2:00 pm</span>
                        
                                                </div>'; 

                                              }
                                            }?>
                        <!-- /.direct-chat-text -->
                      </div>
            </div>

            DISTINCT lead.id,lead.name,lead.date_reg,lead.email,lead.phone,
                lead.company,lead.designation,lead_history.status, lead_history.next_action_time, 
                lead_history.next_action_date,lead_history.comments 
                 WHERE lead.salerep_id='1' AND lead_history.status<='4' ORDER BY next_action_date ASC
                FROM lead INNER JOIN lead_history ON lead.id = lead_history.lead_id

        //////////////////////////////////////////////////////////////////////////////////        
                 echo '<li class="item">
                                    <div class="product-img">
                                    <i class="fa fa-comment-o fa-4x"></i>
                               </div>
                                <div class="product-info">
                             <a href="javascript:void(0)" data-toggle="collapse" data-target="#progress"  title=" View lead Conversations" >'.$name.'
                                    <span class="label label-warning pull-right">'.$date. '</span> </a>
                                    <span class="product-description">'.
                                   $comments
                                  .'</span>
                                </div>';
                        
                        
                                $qq=mysqli_query($con, "SELECT * FROM lead_history WHERE lead_id= '$id' and init='0' ORDER BY next_action_date DESC");
                                    while($roe=  mysqli_fetch_array($qq)) {
                             
                                        
                                        echo'   <div class="collapse" id="progress">
                                
                            <div class="well" style="height:auto;">
                                      
                                    <span class="text-center"></span>
                                        
                                            <div class="box-body">
                                                  <p class="h5">'.$date.' &nbsp;&nbsp;&nbsp;&nbsp;'. $comments.'</p>
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
                                                  }; echo '<p> Designation:&nbsp;&nbsp;'.$org. '&nbsp;&nbsp;Organisation:&nbsp;&nbsp;'.$company.' </p>';
                                                          echo "Qualified";
                                                  echo ' </div>';
                        

                                     }
                              echo ' </li>';