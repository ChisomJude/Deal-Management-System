 <?php  if(isset($_POST['update'])){
                        $name=$_POST['name'];
                        $phone=$_POST['phone'];
                        $username=$_POST['username'];

                         $qq=mysqli_query($con,"UPDATE `salesrep` SET `name` ='$name' ,  `phone` = '$phone', `username`= '$username'  WHERE `salesrep`.`id` = '$id' ");
                            if($qq){
                              echo "Update Successfull.";
                            }else{
                              echo mysqli_error();
                            }

                      }?>