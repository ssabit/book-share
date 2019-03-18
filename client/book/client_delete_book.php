<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
//including the database connection file
include("../others/config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($con, "DELETE FROM user_booklist WHERE id=$id");
 
//redirecting to the display page 
header("Location:client_book_list.php");


?>