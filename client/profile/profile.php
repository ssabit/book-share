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
 GLOBAL $bookname;
 GLOBAL $genrename;
 GLOBAL $authorname;
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
		
		}
}
else {
		echo "ERROR";
	}


?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile</title>
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
				<form action="<?php $_PHP_SELF; ?>" method="post">
				
				<li id="button" ><button name="logout" type="submit" class="btn btn-default btn-sm">
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
				<div class="list-group">
					<a href="#" class="list-group-item list-group-item-action active">Profile</a>
					<a href="../profile/profile_edit.php" class="list-group-item list-group-item-action">Edit</a>
					<a href="../book/client_book_add.php" class="list-group-item list-group-item-action">Add Book</a>
					<a href="../book/client_book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="../book/book_suggestion.php" class="list-group-item list-group-item-action">Book Suggestion</a>
					<a href="../others/create_post.php" class="list-group-item list-group-item-action">Create Post</a>
					<a href="../requests/requests.php" class="list-group-item list-group-item-action ">Requests</a>
					<a href="../requests/approve_list.php" class="list-group-item list-group-item-action">Request Approve List</a>
					<a href="../others/my_posts.php" class="list-group-item list-group-item-action">My Posts</a>
					<a href="../requests/history - Copy.php" class="list-group-item list-group-item-action">History</a>
					<a href="../others/forum.php" class="list-group-item list-group-item-action">Forum</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>My Profile</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form>

									
<?php


$con = mysqli_connect( "localhost", "root", "", "book_share_community" );

$sql = "SELECT distinct bookname,authorname,genre FROM `user_booklist` WHERE  user_id=$id ";
		
									
		$res = mysqli_query( $con, $sql );
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$bookname = $bookname. $row[ 'bookname' ];
				$authorname = $authorname. $row[ 'authorname' ];
				$genrename = $genrename. $row[ 'genre' ];
				$flag = true;
			} else {
				$bookname = $bookname . " ," . $row[ 'bookname' ];
				$authorname = $authorname . " ," . $row[ 'authorname' ];
				$genrename = $genrename . " ," . $row[ 'genre' ];
			}
		}
		$bookname = $bookname." ";
		$authorname = $authorname." ";
		$genrename = $genrename." ";

?>
									
									
<div class="table-responsive">          
  <table class="table">
 
    <tr>
		<td>First Name</td>
		<td><?php echo $first_name;?></td>
	</tr>
		
		
	<tr>
        <td>Last Name</td>
        <td><?php echo $last_name;?></td>
     </tr>
	
		<tr>
        <td>Username</td>
        <td><?php echo $username;?></td>
     </tr>
		
		<tr>
        <td>Email</td>
        <td><?php echo $email;?></td>
     </tr>
		
		<tr>
        <td>Phone</td>
        <td><?php echo $phone;?></td>
     </tr>

   	
	<tr>
        <td>Book List</td>
        <td><a href="../../client/book/client_book_list.php">Show Booklist</a></td>
    </tr>
	
		
		<tr>
        <td>Info</td>
        <td><?php echo $public_info;?></td>
     </tr>		
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