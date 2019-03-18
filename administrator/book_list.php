<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../index.php");
}

include_once("../client/others/config.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($con, "SELECT count(book_id) FROM book_list ORDER BY book_id DESC"); // using mysqli_query instead
//while($res = mysqli_fetch_array($result)) { 
$res = mysqli_fetch_array($result);

$count= $res['count(book_id)'];
//echo $count;
			
       // }

//return;


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
	<title>Book List</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="../css/table.css">
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
				<form action="book_list.php" method="post">
				
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
					<a href="#" class="list-group-item list-group-item-action active">Book List</a>
					<a href="feed.php" class="list-group-item list-group-item-action ">All Posts</a>
					<a href="about.php" class="list-group-item list-group-item-action">About</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>Book List</h4>
								<hr>
							</div>
						<div class="col-md-12">
							<h4 style="color: black;font-weight: bold;">Total Number of Books:<?php echo $count ?> </h4></div>
							
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="">
									<div class="table-responsive">
										<table class="table"  id="users">
											<tbody>
												<thead>
													
													<th>Book Name</th>
													<th>Author Name</th>
													<th>Country</th>
													<th>Genre</th>
													<th>Option</th>
												</thead>
							
												 <?php 
		$result = mysqli_query($con, "SELECT * FROM book_list ORDER BY book_name ASC");
        while($res = mysqli_fetch_array($result)) { 
			
            echo "<tr>";
            echo "<td>".$res['book_name']."</td>";
            echo "<td>".$res['author_name']."</td>";
            echo "<td>".$res['country']."</td>";
			echo "<td>".$res['genre']."</td>";
            echo "<td><a class='btn btn-danger' href=\"../includes/delete_book.php?id=$res[book_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			

			
			
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