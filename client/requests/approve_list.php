<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
$myid=$_SESSION['id'];
$result = mysqli_query($con, "SELECT *,DATE_ADD(CURDATE(),INTERVAL 7 DAY) as Date FROM share where owner_id=$myid and returned=0"); // using mysqli_query instead
?>


<?php

if(isset($_POST['logout'])){
	
	header("Location:../../includes/logout.php");
	exit();
	
}



?>


<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Approved List</title>
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="../../css/table.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/user.css">
	
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
				<form action="requests.php" method="post">
				
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
					<a href="../profile/profile.php" class="list-group-item list-group-item-action">Profile</a>
					<a href="../profile/profile_edit.php" class="list-group-item list-group-item-action">Edit</a>
					<a href="../book/client_book_add.php" class="list-group-item list-group-item-action">Add Book</a>
					<a href="../book/client_book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="../book/book_suggestion.php" class="list-group-item list-group-item-action">Book Suggestion</a>
					<a href="../others/create_post.php" class="list-group-item list-group-item-action">Create Post</a>
					<a href="requests.php" class="list-group-item list-group-item-action">Requests</a>
					<a href="#" class="list-group-item list-group-item-action active">Request Approve List</a>
				<a href="../others/my_posts.php" class="list-group-item list-group-item-action">My Posts</a>
					<a href="../requests/history.php" class="list-group-item list-group-item-action">History</a>
					<a href="../others/forum.php" class="list-group-item list-group-item-action">Forum</a>
					
					
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>My Books</h4>
								<hr>

							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="">
									<div class="table-responsive">
										<table class="table" id="users">
											<tbody>
												<thead>

													<th>Borrower Name</th>
													<th>Book Name</th>
													<th>Return Date</th>
												
													
												</thead>

												 <?php 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            //echo "<td>".$res['id']."</td>";

			
			$reqid=$res['borrower_id'];
			$result1 = mysqli_query($con, "SELECT * FROM users WHERE id=$reqid");
			$res1 = mysqli_fetch_array($result1);
			echo "<td>".$res1['first_name']." ".$res1['last_name']."</td>";

			
			
			
			
			//echo "<td>".$res['days']."</td>";
			echo "<td>".$res['book_name']."</td>";
			echo "<td>".$res['Date']."</td>";
			//echo "<td>".$res['reamin']."</td>";
			//echo "<td>".$res['Date']."</td>";
            //echo "<td><a href=\"user_edit.php?id=$res[id]\">Edit</a> | <a href=\"../includes/delete_user.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			

			
			
        }
        ?>

											</tbody>



										</table>
									</div>

								</form>



							</div>
						</div>

					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<hr>
								<h4 style="color: white;font-weight: bold;font-size: 32px;">Others Book</h4>

								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="">
									<div class="table-responsive">
										<table class="table" id="users">
											<tbody>
												<thead>
										
					
													<th>Owner Name</th>

													<th>Book Name</th>
													<th>Return Date</th>
													<th>Options</th>
												
												</thead>

	 <?php 
												
												
			$result = mysqli_query($con, "SELECT *,DATE_ADD(CURDATE(),INTERVAL 7 DAY) as Date FROM share where borrower_id=$myid and returned=0");									
		  while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            //echo "<td>".$res['id']."</td>";
            //echo "<td>".$res['owner_id']."</td>";
            //echo "<td>".$res['borrower_id']."</td>";
			$id=$res['id'];
			//echo $id;
			$reqid=$res['owner_id'];
			$result1 = mysqli_query($con, "SELECT * FROM users WHERE id=$reqid");
			$res1 = mysqli_fetch_array($result1);
			echo "<td>".$res1['first_name']." ".$res1['last_name']."</td>";

			
			
			
			
			//echo "<td>".$res['days']."</td>";
			echo "<td>".$res['book_name']."</td>";
			echo "<td>".$res['Date']."</td>";
			//echo "<td>".$res['reamin']."</td>";
			//echo "<td>".$res['Date']."</td>";
            //echo "<td><a href=\"user_edit.php?id=$res[id]\">Edit</a> | <a href=\"../includes/delete_user.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			
echo "<td><a class='btn btn-danger' href=\"return_core.php?rowid=$id\">Return</a></td>";
			
			
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