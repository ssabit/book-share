<?php
$connect = new PDO('mysql:host=localhost;dbname=book_share_community', 'root', '');

$commenterid=$_GET['post_id'];
$ownerid=$_GET['owner_id'];
$comment=$_GET['comment_content'];
$bookname=$_GET['bookname'];
$rating=$_GET['rating'];

echo "now i am add_comment page";
echo $commenterid;
echo $ownerid;
echo $comment;
echo $bookname;



try{

	
$stmt="INSERT INTO requests (request_id,owner_id,comment,book_name,rating) VALUES ($commenterid,$ownerid,'$comment','$bookname','$rating')";	
	
	
	
$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 
$connect->exec($stmt);

$pdostmt=$connect->prepare($stmt);
$res=$pdostmt->fetchAll(PDO::FETCH_NUM);

echo "<script>window.alert('Requests added!')</script>";
	header("Location: ../others/forum.php");
	
}catch(Exception $ex)
{

	echo $ex;
	
}

?>
