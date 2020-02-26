<?php 
require_once "header.php";
require_once "dbcon.php";


?>


    <section class="content-header">
      <h1>
        Recieved Notifications
        <small>
          <?php 
             $sql="SELECT COUNT(id) AS msg FROM notification WHERE salesrep ='$id'";
                  $sql= mysqli_query($con,"SELECT COUNT(id) AS msg FROM notification WHERE salesrep ='$id'");
                  $total= mysqli_fetch_array($sql);
                  echo $total['msg'];
        ?> 
      Message Notifications</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="example2">
                  <thead>
                <tr>
                  <th>Date Sent</th>
                  <th>Sender</th>
                  <th>Lead </th>
                  <th>Message</th>
                  <th>Reply</th>
                  
        </tr>
                </thead>
                  <tbody>
                    <?php 
                      $q=mysqli_query($con,"SELECT * FROM notification WHERE salesrep= '$id'");
                          while($qr=mysqli_fetch_array($q)){

                      $sender = $qr['sender'];
                      $msg= $qr['message'];
                      $leadref= $qr['ref'];
                      $date= $qr['date'];

                      //lead details
                      $qqr= mysqli_query($con, "SELECT name, company, designation FROM lead WHERE id = '$leadref' ");
                      $qqr= mysqli_fetch_array($qqr);
                      $name=$qqr['name'];
                      $company=$qqr['company'];
                      $role=$qqr['designation'];

                      //sender detial
                      $qqe= mysqli_query($con, "SELECT name FROM salesrep WHERE id = '$sender' ");
                      $qqe= mysqli_fetch_array($qqe);
                      $sendername=$qqe['name'];



                   echo'
                  <tr>
                    <td><input type="checkbox">'.$date.'</td>
                    <td class="mailbox-name"><a href="#">'.$sendername.'</i></a></td>
                    <td class=""><b>'.$name.'</b> <br> '.$role.' of '.$company.' </td>
                    <td class="mailbox-subject">'.$msg.'</td>
                    <td class="Reply">
                      
                      <a href="reply?leadid='.$leadref.'& adminid='.$sender.'" title=" Reply Sender">Reply</a>
                      
                              
                    </td>
                  </tr>';

                   }
                    ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<?php 
require_once "footer.php";
?>