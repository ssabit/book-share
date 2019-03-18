<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../index.php");
}

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
	<title>About</title>
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
					<a href="feed.php" class="list-group-item list-group-item-action">All Posts</a>
					<a href="#" class="list-group-item list-group-item-action active">About</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>About</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
									<div class="table-responsive">
										<table class="table"  id="users">
											<tbody>
										<tr>
												
											<td>Project Name:</td>		
											<td>Book Share Community</td>				
										</tr>
											
										<tr>
												
											<td>Developer:</td>		
											<td>Saad Ibna Omar Sabit</td>				
										</tr>		
										<tr>
												
											<td>Programming Languages:</td>		
											<td>PHP, HTML, CSS, JavaScript, Ajax, Mysql</td>				
										</tr>
												
										<tr>
												
											<td>Project Duration:</td>		
											<td>1,November 2018- 21,December 2018</td>				
										</tr>			


											</tbody>



										</table>
									</div>
								
								
								
								
								
								
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>