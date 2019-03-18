<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../index.php");
}
include_once("../client/others/config.php");
 
$result = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
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
	<title>Admin</title>
	
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
				<form action="admin.php" method="post">
				
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
					<a href="#" class="list-group-item list-group-item-action active">Users</a>
					<a href="add_book.php" class="list-group-item list-group-item-action">Add Book/Edit</a>
					<a href="book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="feed.php" class="list-group-item list-group-item-action">All Posts</a>
					<a href="about.php" class="list-group-item list-group-item-action">About</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>User List</h4>
								<hr>
								<a href="add_user.php" class="glyphicon glyphicon-plus"  
>AddUser</a><br/>
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
										
													<th>Username</th>
													<th>Password</th>
													<th>Email</th>
													<th>User Type</th>
													<th>Options</th>
												</thead>

												 <?php 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['username']."</td>";
            echo "<td>".$res['password']."</td>";
            echo "<td>".$res['email']."</td>";
            //echo "<td>".$res['user_level']."</td>";
                        
            if($res['user_level']==1)
			{
				echo "<td>"."Normal"."</td>";
			}else if($res['user_level']==2)
			{
				
				echo "<td>"."Premium"."</td>";
			}else if($res['user_level']==3)
			{
				
				echo "<td>"."Admin"."</td>";
			}else
			{
				
				echo "<td>"."Other"."</td>";
			}           
                        
                        
                        
                        
                        
                        
            echo "<td><a class='btn btn-info' href=\"user_edit.php?id=$res[id]\">Edit</a> | <a class='btn btn-danger' href=\"../includes/delete_user.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			

			
			
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