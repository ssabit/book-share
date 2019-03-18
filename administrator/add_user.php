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

<html>

<head>
	<title>Add User</title>
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
				<form action="add_user.php" method="post">
				
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
			<div class="col-md-3 ">
				<div class="list-group ">
					<a href="admin.php" class="list-group-item list-group-item-action active">Users</a>
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

                                                                <h4>Add User</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="add_user.php" method="post">
									<div class="form-group row">
										<label for="username" class="col-4 col-form-label">User Name</label>

										<div class="col-8">
											<input id="username" name="username" placeholder="" class="form-control here" type="text">
										</div>
									</div>
									
									<div class="form-group row">
										<label for="level" class="col-4 col-form-label">User Level</label>
										<div class="col-8">
											<input id="userlevel" name="userlevel" placeholder="userlevel" class="form-control here" type="hidden" style="width:50%;float: left;" >

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.userlevel.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
													<OPTION VALUE="1">Normal User
														<OPTION VALUE="2">Premium
															<OPTION VALUE="3">Admin
											</SELECT>
										</div>
									</div>
									
									<div class="form-group row">
										<label for="password" class="col-4 col-form-label">Password</label>
										<div class="col-8">
											<input id="password" name="password" placeholder="Password" class="form-control here" type="text">
										</div>
									</div>


									<div class="form-group row">
										<label for="email" class="col-4 col-form-label">Email</label>
										<div class="col-8">
											<input id="email" name="email" placeholder="Email" class="form-control here" type="text">
										</div>
									</div>

									<div class="form-group row">
										<div class="offset-4 col-8">

											<button name="submit" type="submit" class="btn btn-primary">Add</button>


										</div>
									</div>

									<?php
									//including the database connection file
									include_once( "../client/others/config.php" );

									if ( isset( $_POST[ 'submit' ] ) ) {
										$username = strtolower($_POST[ 'username' ]);
										$password = $_POST[ 'password' ];
										$email = strtolower($_POST[ 'email' ]);
										$level=$_POST['userlevel'];

										// checking empty fields
										if ( empty( $username ) || empty( $password ) || empty( $level ) ) {
											if ( empty( $username ) ) {
												echo "<font color='red'>User Name field is empty.</font><br/>";
											}

											if ( empty( $password ) ) {
												echo "<font color='red'>Password field is empty.</font><br/>";
											}

											if ( empty( $email ) ) {
												echo "<font color='red'>Email field is empty.</font><br/>";
											}
											if ( empty( $level ) ) {
												echo "<font color='red'>User Level field is empty.</font><br/>";
											}

											//link to the previous page
											//echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
										} else {
											// if all the fields are filled (not empty)             
											//insert data to database
											$result = mysqli_query( $con, "INSERT INTO users(username,password,email,user_level) VALUES('$username','$password','$email',$level)" );

											//display success message
											echo "<font color='green'>Data added successfully.";
											echo "<br/><a href='admin.php'>View Result</a>";

										}
									}
									?>


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