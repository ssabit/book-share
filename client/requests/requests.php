<?php
session_start();
 include_once("../../includes/endyn.php");
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
$id=$_SESSION['id'];

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
	<title>Requests</title>
	
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
					<a href="#" class="list-group-item list-group-item-action active">Requests</a>
					<a href="approve_list.php" class="list-group-item list-group-item-action">Request Approve List</a>
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
								<h4>Request Receives</h4>

								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="" method="post">
									<div class="table-responsive"> 
										<table class="table" id="users">
											<tbody>
												<thead>

													<th>Request Name</th>
													<th>Book Name</th>
													<th>Days</th>
													<th>Rating</th>
													<th>Options</th>
												</thead>

	 <?php 
												
		$result = mysqli_query($con, "SELECT * FROM requests WHERE 	owner_id=$id and status=0 order by 	rating DESC");
        while($res = mysqli_fetch_array($result)) {         
            $rowid=$res['id'];
			echo "<tr>";
            //echo "<td>".$res['id']."</td>";

                        $reqid=$res['request_id'];
			$encrypted = my_simple_crypt( $rowid, 'e' );
			$abc=$encrypted;
                        $browid= my_simple_crypt( $reqid, 'e' );
			
			$result1 = mysqli_query($con, "SELECT * FROM users WHERE id=$reqid");
			$res1 = mysqli_fetch_array($result1);
			echo "<td>".$res1['first_name']." ".$res1['last_name']."</td>";

			echo "<td>".$res['book_name']."</td>";

			echo "<td>".'7'."</td>";
			echo "<td>".$res['rating']."</td>";
			echo "<td><a class='btn btn-success' href=\"request_approve.php?id=$res[request_id]&bookname=$res[book_name]&reqid=$rowid\">Approve</a> | <a class='btn btn-danger'  href=\"requests_delete.php?id=$abc\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a> | <a class='btn btn-info' target = '_blank' href=\"borrower_profile.php?id=$browid\">Details</a> | <a class='btn btn-warning' target = '_blank' href=\"map.php?id=$browid\">Map</a></td>";
			
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
								<h4 style="color: white;font-weight: bold;font-size: 32px;">Request Sents</h4>

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
				
													<th>Request Name</th>
													<th>Book Name</th>
													<th>Days</th>
													<th>Options</th>
												</thead>

	 <?php 
			
								
												
												
												
		$result = mysqli_query($con, "SELECT * FROM requests  WHERE  request_id=$id and status=0");
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
			//echo "<td>".$res['id']."</td>";

			$ownid=$res['owner_id'];
            $result2 = mysqli_query($con, "SELECT * FROM users WHERE id=$ownid");
			$res2 = mysqli_fetch_array($result2);
			echo "<td>".$res2['first_name']." ".$res2['last_name']."</td>";
			
			
			
			
			echo "<td>".$res['book_name']."</td>";
			echo "<td>".'7'."</td>";
			
			$resid=$res['id'];
                        
			$encrypted = my_simple_crypt( $resid, 'e' );
			$def=$encrypted;
			//echo $def;
			//return;
							
			
			
			echo "<td><a class='btn btn-danger' href=\"requests_delete.php?id=$def\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

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