<?php
session_start();


if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
//including the database connection file
include("../others/config.php");
include_once("../../includes/endyn.php");
 
//getting id of the data from url
//$id = $_GET['id'];


	$decode=$_GET['id'];
	//echo $decode;
	$decrypted = my_simple_crypt( $decode, 'd' );
	$dypid=$decrypted;
	//echo $dypid;
	//return;


//deleting the row from table
$result = mysqli_query($con, "DELETE FROM requests WHERE id=$dypid");
 
//redirecting to the display page 
header("Location: requests.php");


?>
