<?php
session_start();

if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
//echo "Username:".$_SESSION['u_id']."<br>";
$rowid=$_GET['rowid'];

//echo $rowid;
//return;
?>

	<?php

			 $date = new DateTime();
			$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
			$get_datetime = $date->format('l, F dS, Y g:i A');

												
			$sql = "UPDATE share SET  returned='1', delivery_date='$get_datetime'  WHERE id=$rowid";
			$result = mysqli_query($con,$sql); 									
												
        header("Location: approve_list.php");
        ?>	

											