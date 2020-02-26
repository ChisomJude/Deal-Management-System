<?php 
require_once'header.php';
require_once'dbcon.php';
?>
 <section class="content">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Reply Notication Message</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
                  <?php 
                 $leadid=$_GET['leadid'];
                  $adminid=$_GET['adminid'];

                  $qs= mysqli_query($con, "SELECT * FROM lead WHERE id= '$leadid' ");
                  $roa= mysqli_fetch_array($qs);
                  $name= $roa['name'];
                  $org=$roa['company'];
                  $role=$roa['designation'];
                  
                  
                    $qq=mysqli_query($con, "SELECT * FROM notification WHERE ref = '$leadid' ");
                    $roe=  mysqli_fetch_array($qq);
                             $comments = $roe['message'];
                             $date=$roe['date'];
                             
                        $comments = substr($comments, 0, 30);
                        $comments= $comments.'...';
                    
                  ?>
                <div class='col-md-10 col-md-offset-1'>
                    <a href="javascript:void(0)" data-toggle="collapse" data-target="#chat"  title=" View lead detials"> <p class="h5"><?php echo $name .'  '.$role .'  @ '. $org; ?></p></a>
                    <p> <?php echo $comments; ?> <span class="label label-info"> <?php echo $date; ?> </span></p>
                    
                    
                        <?php  
                         $qq= mysqli_query($con, "SELECT * FROM notification WHERE ref = '$leadid'  ORDER BY date ASC");
                       
                        ?>
                      <div class="col-md-10" id="chat">
                            <div class="well" style="height:auto;">
                                  <div class="col-md-12 col-md-offset-1">
                                      <?php
                                       //echo $msg;
                                       if(isset($_POST['sendmsg'])){
                                        $salesrep= $_SESSION['id'];
                                        $reciever= $_GET['adminid'];
                                         $lead_id= $_GET['leadid'];
                                        $msgfrmadmin=$_POST['msgfrmadmin'];

                                        $sql= mysqli_query($con,"INSERT INTO `notification` VALUES (NULL,'$msgfrmadmin','$reciever','$salesrep', '$lead_id',NOW() )");
                                        if($sql){
                                         echo  $msg= "<span style='color:green;'>Your message was sent successfully </span>";


                                        }else{
                                          echo  mysqli_error($con);
                                        }


                                       }
                                       ?>
                                    
                                  </div>  
                                    <span class="text-center"></span>
                                    <?php                                 
                                            while($rore=  mysqli_fetch_array($qq)) {
                                                                   ?>    
                                     <div class="box-body direct-chat">
                                            <div class="contacts-list-info">

                                        
                                                  <p class="contacts-list-date pull-right h5" style="color:#ff0000;"><?php echo '<b>Date : </b> '.  $rore['date']; ?></p>
                                                 <div class="col-md-7">
                                                  <span class="direct-chat-text " style="color:#000000;"><?php echo $rore['message']; ?> </span>
                                                  </div>
                                                    <br/><br/>
                                                    <?php } ?>
                                                  <div class="col-md-5 col-md-offset-1">
                                                    <form action="" method="post">
                                                          <textarea class="form-control" name="msgfrmadmin" placeholder="Enter Your Message Here" required></textarea>
                                                            <br/>
                                                      <input type="submit" class="btn btn-primary btn-block" name="sendmsg" value="Send Message"> 
                                                    </form>
                                                  </div>

                                           </div>
                                      </div>
                                            
                            </div>
                      </div>
                

                </div>
               
            
            </div>
            <!-- /.box-body -->
          <div class="box-footer text-center">
             <a href="msg" class="uppercase"><span class="label label-info"> Back to Notification</span></a>
          </div>
     </div>

</section>

</div>
   
           <?php require_once'footer.php';?>
