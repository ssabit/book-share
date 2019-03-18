<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
//echo "Username:".$_SESSION['u_id']."<br>";
$userid=$_SESSION['id'];
$rowid=$_GET['reqid'];
?>

	<?php 
	
												
			$result = mysqli_query($con, "SELECT * FROM users where id=$_GET[id]"); 
			$res = mysqli_fetch_array($result);       

			
$sql = "INSERT INTO share (owner_id,borrower_id,days,book_name,status)
VALUES ($userid,$res[id], '7','$_GET[bookname]',1)";
			$result = mysqli_query($con,$sql); 

			
			$sql = "Select * from share where status=1";
			$result = mysqli_query($con,$sql); 
			$res = mysqli_fetch_array($result);									
			
			//echo "<td>".$res['borrower_id']."</td> ";
			$brwid=$res['borrower_id'];	
			$result1 = mysqli_query($con, "SELECT * FROM users WHERE id=$brwid");
			$res1 = mysqli_fetch_array($result1);									

												
			$sql = "UPDATE requests SET status='1' WHERE id=$rowid";
			$result = mysqli_query($con,$sql); 									
												
        header("Location: requests.php");
        ?>	

											