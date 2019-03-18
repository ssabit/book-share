<?php
session_start();
 
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
include_once("../../includes/endyn.php");
//echo "Login:".$_SESSION['u_id']."<br>";

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


$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );

	$decode=$_GET['id'];
	//echo $decode;
	$decrypted = my_simple_crypt( $decode, 'd' );
	$dypid=$decrypted;
	//echo $dypid;
	//return;

$query ="Select * from users where id=$dypid";

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
	<title>Borrower Profile</title>
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
				<li id="logo">Book Share Community</li>
				<li id="user">User:
					<?php echo $_SESSION['u_id'];?>
				</li><br>
				<form action="<?php $_PHP_SELF; ?>" method="post">
				
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
					
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>Borrower Profile</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form>

									
<?php


$con = mysqli_connect( "localhost", "root", "", "book_share_community" );

$sql = "SELECT distinct bookname,authorname,genre FROM `user_booklist` WHERE  user_id=$dypid";
		
									
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
        <td>Email</td>
        <td><?php echo $email;?></td>
     </tr>
		
		<tr>
        <td>Phone</td>
        <td><?php echo $phone;?></td>
     </tr>

   	
		<tr>
        <td>Book List</td>
        <td>
			<?php echo $bookname;?>
			</td>
     </tr>
		
		<tr>
        <td>Genres</td>
        <td><?php echo $genrename;?></td>
     </tr>
		
		<tr>
        <td>Author</td>
        <td><?php echo $authorname;?></td>
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