
<?php
    require_once'dbcon.php';
   

 ?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog"style="width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-danger">DEADLINE REMAINDER</h4>
            </div>
            <div class="modal-body table-responsive">
               
              
              <table id="example2" class="table table-responsive table-bordered  table-hover">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Lead Name</th>
                  
                  <th>Contact Details </th>
                  <th>Deal Status</th>
                  <th>Next Action</th>
                  <th>Date of Next Action</th>
                  
                  <th>Add Next Action</th>
                </tr>
                </thead>
                <tbody align="center">
                  <?php 
                  //include'modalbox.php';

              $q= mysqli_query($con, "SELECT lead.id,lead.name,lead.date_reg,
                lead.email,lead.phone,lead.company,lead.designation,lead_history.status, 
                lead_history.next_action_time, lead_history.next_action_date,lead_history.comments
                 FROM lead INNER JOIN lead_history ON lead.id = lead_history.lead_id WHERE lead.salerep_id='1'
                  AND next_action_date >=CURDATE() AND lead_history.status <= '4' ORDER BY next_action_date asc");
                     if(mysqli_num_rows($q)!= 0){
                     
 

                     while ($row= mysqli_fetch_array($q)){

                      echo'<tr class="danger">
                  <td>'.$row['date_reg'].'</td>
                  <td ><a href="editlead?id='. $row['id'].'"data-toggle="tooltip"  title=" Edit lead detials" >'.$row['name'].'
                      <br/><i><b>'. $row['designation'].'</b>  @  '. $row['company'].'<i></a>
                  </td>
                  <td>'. $row['email'].' &nbsp;&nbsp;'. $row['phone'].'</td>
                  <td>'; $status = $row['status'];

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
                          };
                          echo '</td>
                  <td>'.$row['comments'].'</td>
                  <td> '.$row['next_action_date'].' &nbsp;&nbsp;'. $row['next_action_time'].'</td>
                  
                  <td><a href="addcomment?id='. $row['id'].'"data-toggle="tooltip" title="Add a Next Action"><i class="fa fa-edit"></td>
                </tr>';
                     }
                  ?>
                
               
                <?php 
                  }else{
                      echo '
                      <marquee>
                      <span class="text-success text-center h4" style="padding:10px;"> You have no records or no Deadlines </span>

                    </marquee>';
                  }
                ?>
              </tbody>
                
              </table>
            
            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>




