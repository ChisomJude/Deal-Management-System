<?php 
require_once'header.php';
require_once'dbcon.php';
$sender_mail= $_SESSION['email'];
@$leadid = $_GET['sendmail'];
$q= mysqli_query($con, "SELECT * FROM lead WHERE  id='$leadid'");
if($q){
    $fetch= mysqli_fetch_array($q);
    $name=$fetch['name'];
    $email= $fetch['email'];


?>
<div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
              <?php 
                if(isset($_POST['sendmsg'])){
                    $subject=mysqli_real_escape_string($con,$_POST['subject']);
                    $email=mysqli_real_escape_string($con,$_POST['email']);
                    $msg=mysqli_real_escape_string($con,$_POST['msg']);

                    $headers= "From: ".$sender_mail;
                    $to= $email;
                    $send= mail($to, $subject, $msg, $headers);

                    if($send){
                        $store= mysqli_query($con, "INSERT INTO mail VALUES(NULL,'$name','$sender_mail','$email','$msg',NOW();)");
                        //insert into lead history that email was sent

                          $get_id= $_GET['id'];
                                            $last= mysqli_query($con, "SELECT id FROM `lead_history` WHERE lead_id ='$get_id' ORDER BY `next_action_date` DESC LIMIT 1");
                                 $Q= mysqli_fetch_array($last);
                                                    $last_id= $Q['id'];
                                                    $update=  mysqli_query($con, "UPDATE `lead_history` SET `init` = '0' WHERE `lead_history`.`id` = '$last_id'");
                                                    
                                 $reg_date= date("d-m-Y");
                               // $status=mysqli_escape_string($con, $_POST['status']);
                                $comment= $Subject."<br/>". $msg;
                                $date=$_POST['date'];
                                $time=$_POST['time'];
                                $status="Mail Sent";
                                
                                    $adquery2= mysqli_query($con, "INSERT INTO lead_history VALUES(NULL,'$get_id','$status',NULL,NULL,'$comment','1','$reg_date') ");
                                    if($adquery2){
                                        echo'Done Successfully';
                                    }else{
                                        echo "an error occured";
                                    }
                    }else{ 
                            echo "Mail wasnt Sent pls try agan";
                        }

                } 
            ?>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                            <form class="" method="post" action="">

              <div class="form-group">
                <input class="form-control" readonly value="<?php echo $email; ?>" name="email">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:" name="subject">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" name="msg" class="form-control" rows="">
                      <?php echo "Dear " . $name." ,";?>
                      
                    </textarea>
              </div>
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary" name="sendmsg"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <a  href="home"  class="btn btn-default"><i class="fa fa-times"></i> Discard</a>
            </div>
        </form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
</div>

 </div>
<?php

}
 require_once'footer.php';

?>
 
