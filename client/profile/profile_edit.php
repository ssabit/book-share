<?php

session_start();
//echo "username: ".$_SESSION['u_id']."<br>";
//echo "email: ".$_SESSION['u_email'];
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
?>

<?php

if(isset($_POST['logout'])){
	
	header("Location:../../includes/logout.php");
	exit();
	
}



?>
<?php

//$id=$_SESSION['id'];
$id=$_SESSION['id'];
$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );

$query ="Select * from users where id=$id";

$result = mysqli_query( $connect, $query );

if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$first_name = $row[ 'first_name' ];
			$last_name = $row[ 'last_name' ];
			$gender = $row[ 'gender' ];
			$email = $row[ 'email' ];
			$phone = $row[ 'phone' ];
			$public_info = $row[ 'public_info' ];
			$username = $row[ 'username' ];
			$pass = $row[ 'password' ];
		
		}
}
else {
		echo "ERROR";
	}


?>

<?php
include_once("../others/config.php");
 
if(isset($_POST['submit']))
{    
    $id =$_SESSION['id'];
    
    //$username=$_POST['username'];
    $password=$_POST['newpass'];
    $email=$_POST['email'];
    $first_name=$_POST['firstname'];
    $last_name=$_POST['lastname'];
    $phone=$_POST['phone'];
	$public_info=$_POST['publicinfo'];
	$gender=$_POST['gender'];
	
	//$userlevel=$_POST['userlevel'];

    // checking empty fields
    if(empty($first_name) ||empty($last_name) ||empty($password) || empty($email)) {            
        if(empty($first_name)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
        }
        if(empty($last_name)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
        }
        
        if(empty($password)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        } 
    } else {    
        //updating the table
		//echo "$userlevel";
		echo "else";
        $result = mysqli_query($con, "UPDATE users SET username='$username',password='$password',email='$email',phone='$phone',first_name='$first_name',last_name='$last_name',	public_info='$public_info',gender=$gender WHERE id=$id");
       // echo $username;
        //echo $password;
        //echo $email;
        //echo $userlevel;
		//echo "$result";
		//return;
		echo "$result";
		
        //redirectig to the display page. In our case, it is index.php
        header("Location: profile.php");
    }
}
?>



<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Edit Profile</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
				<form action="profile_edit.php" method="post">
				
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
					<a href="profile.php" class="list-group-item list-group-item-action ">Profile</a>
					<a href="#" class="list-group-item list-group-item-action active">Edit</a>
					<a href="../book/client_book_add.php" class="list-group-item list-group-item-action">Add Book</a>
					<a href="../book/client_book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="../book/book_suggestion.php" class="list-group-item list-group-item-action">Book Suggestion</a>
					<a href="../others/create_post.php" class="list-group-item list-group-item-action">Create Post</a>
					<a href="../requests/requests.php" class="list-group-item list-group-item-action ">Requests</a>
					<a href="../requests/approve_list.php" class="list-group-item list-group-item-action">Request Approve List</a>
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
								<h4>Edit Profile </h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="profile_edit.php" method="post">
									<div class="form-group row">
										<label for="username" class="col-4 col-form-label">User Name</label>
										<div class="col-8">
											<input id="username" name="username" placeholder="Username" class="form-control here" type="text" disabled="disabled" value="<?php echo $username;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-4 col-form-label">First Name</label>
										<div class="col-8">
											<input id="name" name="firstname" placeholder="First Name" class="form-control here" type="text" value="<?php echo $first_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lastname" class="col-4 col-form-label">Last Name</label>
										<div class="col-8">
											<input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text" value="<?php echo $last_name;?>">
										</div>
									</div>
									
									<div class="form-group row">
										<label for="gender" class="col-4 col-form-label">Gender</label>
										<div class="col-8">
											
                 <input name="gender" id="input-gender-male" value="1" type="radio"<?php if ($gender == 1): ?> checked = "checked"<?php endif; ?>/>Male
             	</label>
	
                 <input name="gender" id="input-gender-female" value="2" type="radio"<?php if ($gender == 2): ?> checked = "checked"<?php endif; ?> />Female
             	</label>							
										</div>
										
									</div>

									<div class="form-group row">
										<label for="email" class="col-4 col-form-label">Email*</label>
										<div class="col-8">
											<input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text" value="<?php echo $email;?>">
										</div>
									</div>
							<div class="form-group row">
										<label for="phone" class="col-4 col-form-label">Phone</label>
										<div class="col-8">
											<input id="phone" name="phone" placeholder="Phone Number" class="form-control here" type="text" value="<?php echo $phone;?>">
										</div>
									</div>
						
									<div class="form-group row">
										<label for="publicinfo" class="col-4 col-form-label">Public Info</label>
										<div class="col-8">
											<textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"><?php echo htmlspecialchars($public_info);?></textarea>
										</div>
									</div>
							
									<div class="form-group row">
										<label for="newpass" class="col-4 col-form-label">New Password</label>
										<div class="col-8">
											<input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text" value="<?php echo $pass;?>">
										</div>
									</div>
									<div class="form-group row">
										<div class="offset-4 col-8">
											<button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
										</div>
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