<?php

session_start();

if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
//including the database connection file
include("../../includes/db.php");
 
//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($con, "DELETE FROM posts WHERE post_id=$id");
//echo "$result";
//return;
 
//redirecting to the display page 
header("Location:my_posts.php");


?>
