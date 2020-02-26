<?php
	
require_once"dbcon.php";
	echo $lead_id= $_GET['id'];
	$del="DELETE FROM `lead` WHERE `lead`.`id` = '$lead_id' ";
	$del= mysqli_query($con, $del) or die("try again later pls");
		if($del){

			$delete= "DELETE FROM lead_history WHERE lead_id= '$lead_id' ";
			$delete = mysqli_query($con, $delete) or die("Try again later");
			header("Location:pendleaads.php?msg=Deleted Successfully");
		}



?>