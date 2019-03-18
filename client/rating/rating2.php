<?php
session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
$reqid=$_GET['rateid'];
$pid=$_GET['pid'];
//echo $reqid;
//return;

$result = mysqli_query($con, "SELECT * FROM users WHERE id=$reqid"); // using mysqli_query instead
?>
<?php

if(isset($_POST['logout'])){
	
	header("Location: ../../includes/logout.php");
	exit();
	
}



?>



<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Rate User</title>
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="../../css/table.css">
	
	<link rel="stylesheet" href="../../css/bootstrap.min3.3.7.css">
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
				<form action="rating2.php" method="post">
				
				<li id="button"><button  name="logout" type="submit" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
				</li>
				</form>
				
			</ul>

		</div>



	</div>
	<div class="container">

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4 style="color: black;font-weight: bold;">Rating User</h4>
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
												
													<th>Email</th>
													<th>Rating</th>
													<th>Options</th>
												</thead>

												
												 <?php 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
           echo "<td>".$res['first_name']." ".$res['last_name']."</td>";
    
            echo "<td>".$res['email']."</td>";
			
			echo "<td>".$res['rating']."</td>";
			$_SESSION['pid']=$pid;

			
            echo "<td><a class='btn btn-info' href=\"rating_com_own.php?id=$res[id]&pid=$pid\">Rate</a></td>";
			

			
			
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