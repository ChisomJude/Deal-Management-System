<?php 
require_once'header.php';
require_once'dbcon.php';
?>
<section class="content">
<div class="box box-primary">
      <?php 
                  $lid=$_GET['id'];// lead id
                  $repid=$_GET['repid'];
                  $qs= mysqli_query($con, "SELECT * FROM lead WHERE id= '$lid' ");
                  $roa= mysqli_fetch_array($qs);
                  $name= $roa['name'];
                  $phone=$roa['phone'];
                  $org=$roa['company'];
                  $role=$roa['designation'];
                  
                  
                  
                $qq= mysqli_query($con, "SELECT COUNT(id) AS id from notification WHERE `ref` = '$lid'");
                    if($qq){
                        $qq= mysqli_fetch_array($qq);
                        $count= $qq['id'];
                    }
                
                  
                    $qq=mysqli_query($con, "SELECT * FROM lead_history WHERE lead_id= '$lid' and init='1' ");
                    $roe=  mysqli_fetch_array($qq);
                        $comments = $roe['comments'];
                        $date=$roe['next_action_date'];
                             
                        $comments = substr($comments, 0, 30);
                        $comments= $comments.'...';
                   
                    $qq= mysqli_query($con, "SELECT * FROM lead_history WHERE lead_id= '$lid'  ORDER BY next_action_date ASC");
                       
                        ?>
    
            <div class="box-header with-border">
              <h3 class="box-title">Threads with <?php echo $name .'  '.$role .'  @ '. $org; ?> </h3>

              <div class="box-tools pull-right">
                
                <button type="button" class="btn btn-box-tool" onClick="javascript:history.go(-1)" ><i class="fa fa-chevron-circle-left fa-2x"></i>
                </button>
                
                   <a href="comments?id=<?php echo $lid; ?>&notice=<?php echo $id; ?>"  class="btn btn-box-tool">
                     <i class="fa fa-envelope-o fa-2x"><sup><span class="label label-success"><?php echo $count; ?></span></sup></i></a>
                
              </div>
            </div>
            <!-- /.box-header -->
      
        
          <!-- DIRECT CHAT SUCCESS -->
          <?php 
          //echo $msg;
                     if(isset($_POST['sendmsg'])){
                      $admin= $team;
                       $repid= $_GET['notice'];
                       $lead_id= $_GET['id'];
                      $msgfrmadmin=$_POST['msgfrmadmin'];

                      $sql= mysqli_query($con,"INSERT INTO `notification` VALUES (NULL,'$msgfrmadmin','$admin','$id', '$lead_id',NOW() )");
                      if($sql){
                       echo  $msg= "<h4 style='color:green;'> &nbsp; &nbsp; &nbsp; Your message was sent successfully to Team lead </h4>";


                      }else{
                        echo  mysqli_error($con);
                      }

                     }
                     
                    
          
          // if not checking to see notification messageses - display conversation with lead
          if(!isset($_GET['notice'])){  ?>
              
            <div class="direct-chat ">
                   <div class="box-body">
                     <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                    <?php                                 
                            while($rore=  mysqli_fetch_array($qq)) {
                                
                      ?>   <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                          <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">
                                            <?php                                 
                                                                    
                                                    $status = $rore['status'];
        
                                                           switch ($status) {
                                                               case "1":
                                                                echo "<small class='label bg-maroon'> Sales Qualified Lead </small>";
                                                                break;
                                                              case "2":
                                                                echo "<small class='label bg-navy'> Negotiation Level </small>";
                                                                break;
                                                              case "3":
                                                                echo "<small class='label label-primary'> Dated Commitment </small>";
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
                                                               
                                                          }
                                                              ?>  </span>
                                            <span class="direct-chat-timestamp pull-right"><?php echo '<b>Date : </b> '.  $rore['next_action_date']; ?></span>
                                          </div>
                                          <!-- /.direct-chat-info -->
                                          <img class="direct-chat-img" src="avatar2.png" alt="Message User Image"><!-- /.direct-chat-img -->
                                          <div class="direct-chat-text">
                                            <?php echo $rore['comments']; ?>
                                          </div>
                                          <!-- /.direct-chat-text -->
                                        </div>
                                        <?php } ?>
                                        <!-- /.direct-chat-msg -->
                        
                                        
                                        <!-- /.direct-chat-msg -->
                                      </div>
                                      
                                      <!-- /.direct-chat-pane -->
                                    </div>
                     <!-- /.box-body -->
                     </div>
           <?php  }else{ // admin is checking to see notification sent to leads
               ?>
               
                <div class="direct-chat ">
           
                  <div class="box-body">
                     <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
               <?php 
               
                if($count==0){
                   echo "<br><br><span class='h4 text-danger'> No Message  notification  was  sent on this lead progress </span> <br><br>";
               }else{
                ?>
                
                
                    <?php     $repid=$_GET['notice'];
                            $sw= mysqli_query($con, "SELECT * FROM notification WHERE `ref` = '$lid' ");
                    
                            while($rore=  mysqli_fetch_array($sw)){
                                $sender_id= $rore['sender'];
                                $salesrep_id= $rore['salesrep'];
                            
                               //get sender name
                                $sender= mysqli_query($con,"SELECT name from salesrep WHERE id= '$team'") ;
                                $send = mysqli_fetch_array($sender);
                                $sender = $send['name'];
                                
                                //get salesrep name
                                $salesrep= mysqli_query($con,"SELECT name from salesrep WHERE id= '$id'") ;
                                $send = mysqli_fetch_array($salesrep);
                                $salesrep = $send['name'];
                               
                               
                               // check to see if the sender or reciever has a message
                               $wq= mysqli_query($con,"SELECT COUNT(id) AS id FROM notification  WHERE sender = '$sender_id' ");
                                $wqq= mysqli_query($con,"SELECT COUNT(id) AS id FROM notification WHERE salesrep = '$salesrep_id' "); 
                                $wq= mysqli_fetch_array($wq); $wqq= mysqli_fetch_array($wqq);
                                $count_sender= $wq['id']; $count_salesrep= $wq['id'];
                                
                                      //-- Message. Default to the left Salesrep -->
                                        ?>
                                        
                                         <!-- Message to the right  Team lead-->
                                            <div class="direct-chat-msg left">
                                              <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">
                                                    <?php 
                                                         echo "<small class='label label-danger'>".$sender." </small>";
                                                    ?>
                                                </span>
                                                <span class="direct-chat-timestamp pull-right"><?php echo '<b>Date : </b> '.  $rore['date']; ?></span>
                                              </div>
                                              <!-- /.direct-chat-info -->
                                             
                                              <div class="direct-chat-text">
                                                <?php echo $rore['message']; ?>
                                              </div>
                                              <!-- /.direct-chat-text -->
                                            
                                           <?php  } ?>
                                           
                                            </div>
                               
                                      </div>
                                      
                                      <!-- /.direct-chat-pane -->
                                    </div>
                     <!-- /.box-body -->
                     </div>
                <?php
                          
                    }
           }
            ?>
            <div class="box-footer">
                      <form action="" method="post">
                        <div class="input-group col-md-12">
                          <input type="text" name="msgfrmadmin" placeholder="Send a message to Team Lead regarding this lead..." required class="form-control">
                              <span class="input-group-btn">
                                <input type="submit" class="btn btn-success btn-flat" name="sendmsg" value="Send Message to TeamLead">
                              </span>
                        </div>
                      </form>
                    </div>
        <!-- /.box-footer-->
          </div>
</section>  <?php require_once'footer.php';?>