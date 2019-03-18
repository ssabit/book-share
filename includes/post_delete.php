<?php

//including the database connection file
include("../client/others/config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($con, "DELETE FROM posts WHERE post_id=$id");
//echo "$result";
//return;
 
//redirecting to the display page 
header("Location:../administrator/feed.php");


?>
