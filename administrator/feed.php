<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../index.php");
}
// php code to search data in mysql database and set it in input text
	//connect to mysql
	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );
	$query = "SELECT * FROM `posts` ORDER BY post_id DESC";

	$date = new DateTime();
	$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
	$get_datetime = $date->format('l, F dS, Y g:i A');
	//echo $get_datetime;

	$result = mysqli_query( $connect, $query );
?>

<?php

if(isset($_POST['logout'])){
	
	header("Location: ../includes/logout.php");
	exit();
	
}



?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Posts Feed</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/user.css">
	
</head>

<body>
	<div class="header">

		<!-- Logo -->
		<div class="logo">
			<ul>
				<li id="logo">Book Share Community </li>
				<li id="user">User:
					<?php echo $_SESSION['u_id'];?>
				</li><br>
				<form action="feed.php" method="post">
				
				<li id="button"><button  name="logout" type="submit" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
				</li>
				</form>
			</ul>

		</div>



	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="list-group ">
					<a href="admin.php" class="list-group-item list-group-item-action">Users</a>
					<a href="add_book.php" class="list-group-item list-group-item-action ">Add Book/Edit</a>
					<a href="book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="#" class="list-group-item list-group-item-action active">All Posts</a>
					<a href="about.php" class="list-group-item list-group-item-action">About</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>Feed</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="">
									<div class="table-responsive">
										<table class="table">
											<tbody>

												 <?php 
        while($row = mysqli_fetch_array($result)) {         
            echo "<tr >";
			echo "<td colspan='11'>"."Posted By - ".$row['post_owner']."<br><br>"."Published on - ".$row['time']."<br><br>"."Book Name: ".$row['book_name']."<br><br>"."Genre: ".$row['post_genre']."<br><br>".$row['status']."</td>";
				
	
			echo "<td><a href=\"../includes/post_delete.php?id=$row[post_id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><span class='glyphicon glyphicon-trash'></span></a></td>";
			 echo "</tr>";
			
			
            //echo "<td><a href=\"user_edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			

			
			
        }
        ?>

											</tbody>



										</table>
									</div>

								</form>



							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>