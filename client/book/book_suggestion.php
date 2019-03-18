<?php
session_start();

if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}

include_once( "../others/config.php" );

$id = $_SESSION['id'];

?>
<?php

if(isset($_POST['logout'])){
	
	header("Location:../../includes/logout.php");
	exit();
	
}



?>
<html>

<head>
	<title>Suggestion</title>
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
					<a href="../profile/profile.php" class="list-group-item list-group-item-action ">Profile</a>
					<a href="../profile/profile_edit.php" class="list-group-item list-group-item-action">Edit</a>
					<a href="../book/client_book_add.php" class="list-group-item list-group-item-action">Add Book</a>
					<a href="../book/client_book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="#" class="list-group-item list-group-item-action active">Book Suggestion</a>
					<a href="../others/create_post.php" class="list-group-item list-group-item-action ">Create Post</a>
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
								<h4>Suggestion</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="<?php $_PHP_SELF; ?>" method="post">
									<div class="form-group row">
										<label style="font-size: 22px;" for="Suggestion" class="col-4 col-form-label">Filter By</label>
										<div class="col-8">
											
	<input style="font-size: 20px;padding-left:10px;"type="checkbox" name="suggestion" value="authorname"><label style="font-size: 20px;padding-left:10px;"> Author</label>
	<input type="checkbox" name="suggestion1" value="genre"><label style="font-size: 20px;padding-left:10px;"> Genre</label>
	<input type="checkbox" name="suggestion2" value="publishers"><label style="font-size: 20px;padding-left:10px;"> Publishers</label>
	<input type="checkbox" name="suggestion3" value="country"><label style="font-size: 20px;padding-left:10px;"> Country</label>		
													
													
														
											<button name="submit" type="submit" class="btn btn-primary" style="margin-left:15px;">Show</button>
										</div>

									</div>

									<div class="table-responsive">
										<table class="table" id="users">
											<tbody>
												<thead>

													<th>Book Name</th>
													<th>Author Name</th>
													<th>Genre</th>
													<th>Publisher</th>
													<th>Country</th>
												</thead>


								<?php
												//including the database connection file
												include_once( "../others/config.php" );

												if ( isset( $_POST['submit'] ) ) {
													
													
													if ( !isset( $_POST['suggestion'] ) ) {
													$suggestion="";
													}else
														$suggestion=$_POST['suggestion'];
													
													if ( !isset( $_POST['suggestion1'] ) ) {
													$suggestion1="";
													}else
														$suggestion1=$_POST['suggestion1'];
													
													if ( !isset( $_POST['suggestion2'] ) ) {
													$suggestion2="";
													}else
														$suggestion2=$_POST['suggestion2'];
													
													if ( !isset( $_POST['suggestion3'] ) ) {
													$suggestion3="";
													}else
														$suggestion3=$_POST['suggestion3'];
													
													
													//echo $suggestion;
													//echo $suggestion1;
													//echo $suggestion2;
													//echo $suggestion3;
													//return;
													
													//$suggestion = $_POST['suggestion'];
													//$suggestion1= $_POST['suggestion1'];
													//$suggestion2= $_POST['suggestion2'];
													//$suggestion3= $_POST['suggestion3'];
													
						
													//echo "Author:".$suggestion;
													//echo "Genre:".$suggestion1;
													//return;
													
													
						if ( $suggestion!= 'authorname' && $suggestion1!= 'genre' && $suggestion2!='publishers' && $suggestion3!='country') {

	echo "<font color='white'; size=5;>Please select atleast one checkbox.</font><br/>";


}
else {

	if ( $suggestion == 'authorname' && $suggestion1!= 'genre' && $suggestion2!= 'publishers' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct authorname FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$authorlist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$flag = true;
			} else {
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
			}
		}
		$authorlist = $authorlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE authorname in $authorlist AND user_id<>$id ";

		//echo "$sql";
	} 
	else if ( $suggestion== 'authorname' && $suggestion1== 'genre' && $suggestion2!= 'publishers' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct authorname ,genre FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$authorlist = "(";
		$genrelist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				$flag = true;
			} else {
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
			}
		}
		$authorlist = $authorlist . ")";
		$genrelist = $genrelist . ")";
		
		$sql = "SELECT * FROM `user_booklist` WHERE authorname in $authorlist AND genre in $genrelist AND user_id<>$id ";

		//echo "$sql";
	}   	
	else if ( $suggestion== 'authorname' && $suggestion1== 'genre' && $suggestion2== 'publishers' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct authorname ,genre,publishers FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$authorlist = "(";
		$genrelist = "(";
		$publisherlist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {

			if ( $flag == false ) {
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				$flag = true;
			} else {
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
			}

		}
		$authorlist = $authorlist . ")";
		$genrelist = $genrelist . ")";
		$publisherlist = $publisherlist . ")";

		$sql = "SELECT * FROM `user_booklist` WHERE authorname in $authorlist AND genre in $genrelist AND publishers in $publisherlist AND user_id<>$id ";

		//echo "$sql";
	} 
	else if ( $suggestion== 'authorname' && $suggestion1== 'genre' && $suggestion2== 'publishers' && $suggestion3== 'country' ) {
		$sql = "SELECT distinct authorname ,genre,publishers,country FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$authorlist = "(";
		$genrelist = "(";
		$publisherlist = "(";
		$countrylist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {

			if ( $flag == false ) {
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				$flag = true;
			} else {
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
			}
		}
		$authorlist = $authorlist . ")";
		$genrelist = $genrelist . ")";
		$publisherlist = $publisherlist . ")";
		$countrylist = $countrylist . ")";

		$sql = "SELECT * FROM `user_booklist` WHERE authorname in $authorlist AND genre in $genrelist AND publishers in $publisherlist AND country in $countrylist AND user_id<>$id ";

//		//echo "$sql";
	} 
	
	else if ( $suggestion1== 'genre' && $suggestion!= 'authorname' && $suggestion2!= 'publishers' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct genre FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$genrelist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				$flag = true;
			} else {
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
			}
		}
		$genrelist = $genrelist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE genre in $genrelist AND user_id<>$id ";

		//echo "$sql";
	} 
	else if ( $suggestion2== 'publishers' && $suggestion1!= 'genre' && $suggestion!= 'authorname' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct publishers FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$publisherlist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				$flag = true;
			} else {
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
			}
		}
		$publisherlist = $publisherlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE publishers in $publisherlist AND user_id<>$id";

		//echo "$sql";
	} 
	else if ( $suggestion2== 'publishers' && $suggestion== 'authorname' && $suggestion1!= 'genre' && $suggestion3!= 'country' ) {
		$sql = "SELECT distinct authorname,publishers FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$publisherlist = "(";
		$authorlist = "(";
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$flag = true;
			} else {
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
			}
		}
		$publisherlist = $publisherlist . ")";
		$authorlist = $authorlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE publishers in $publisherlist AND authorname in $authorlist  AND user_id<>$id ";

		//echo "$sql";
	} 
	
	else if ( $suggestion3== 'country' && $suggestion2!= 'publishers' && $suggestion!= 'authorname' && $suggestion1!= 'genre'  ) {
		$sql = "SELECT distinct country FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$countrylist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				
				$flag = true;
			} else {
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
				
			}
		}
		$countrylist = $countrylist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE country in $countrylist  AND user_id<>$id";

		//echo "$sql";
	} 
	else if ( $suggestion3== 'country' && $suggestion== 'authorname'  && $suggestion2!= 'publishers' && $suggestion1!= 'genre'  ) {
		$sql = "SELECT distinct authorname, country FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$countrylist = "(";
		$authorlist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				
				$flag = true;
			} else {
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
				
			}
		}
		$countrylist = $countrylist . ")";
		$authorlist = $authorlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE authorname in $authorlist AND country in $countrylist   AND user_id<>$id ";

		//echo "$sql";
	} 
	else if ( $suggestion3== 'country' && $suggestion== 'authorname'  && $suggestion1== 'genre'  && $suggestion2!= 'publishers' ) {
		$sql = "SELECT distinct authorname, country,genre FROM `user_booklist` WHERE  user_id=$id ";
		$res = mysqli_query( $con, $sql );
		$countrylist = "(";
		$authorlist = "(";
		$genrelist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				$authorlist = $authorlist . "'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				
				$flag = true;
			} else {
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
				$authorlist = $authorlist . ",'" . $row[ 'authorname' ] . "'";
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
				
			}
		}
		$countrylist = $countrylist . ")";
		$authorlist = $authorlist . ")";
		$genrelist = $genrelist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE country in $countrylist AND authorname in $authorlist AND genre in $genrelist  AND user_id<>$id";

		//echo "$sql";
	} 
	
	else if ( $suggestion3== 'country' && $suggestion1== 'genre' && $suggestion!= 'authorname' && $suggestion2!= 'publishers' ) {
		$sql = "SELECT distinct genre, country FROM `user_booklist` WHERE  user_id=$id";
		$res = mysqli_query( $con, $sql );
		$countrylist = "(";
		$genrelist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				
				$flag = true;
			} else {
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
				
			}
		}
		$countrylist = $countrylist . ")";
		$genrelist = $genrelist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE country in $countrylist AND genre in $genrelist  AND user_id<>$id ";

		//echo "$sql";
	} 
	else if ( $suggestion3== 'country' && $suggestion2== 'publishers' && $suggestion1!= 'genre' && $suggestion!= 'authorname' ) {
		$sql = "SELECT distinct publishers, country FROM `user_booklist` WHERE  user_id=$id";
		$res = mysqli_query( $con, $sql );
		$countrylist = "(";
		$publisherlist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$countrylist = $countrylist . "'" . $row[ 'country' ] . "'";
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				
				$flag = true;
			} else {
				$countrylist = $countrylist . ",'" . $row[ 'country' ] . "'";
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
				
			}
		}
		$countrylist = $countrylist . ")";
		$publisherlist = $publisherlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE country in $countrylist AND publishers in $publisherlist  AND user_id<>$id";

		//echo "$sql";
	} 
	
	else if (  $suggestion1== 'genre'  && $suggestion2== 'publishers' && $suggestion3!= 'country' && $suggestion!= 'authorname' ) {
		$sql = "SELECT distinct publishers, genre FROM `user_booklist` WHERE  user_id=$id";
		$res = mysqli_query( $con, $sql );
		$genrelist = "(";
		$publisherlist = "(";
	
		$flag = false;
		while ( $row = mysqli_fetch_array( $res ) ) {
			if ( $flag == false ) {
				$genrelist = $genrelist . "'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . "'" . $row[ 'publishers' ] . "'";
				
				$flag = true;
			} else {
				$genrelist = $genrelist . ",'" . $row[ 'genre' ] . "'";
				$publisherlist = $publisherlist . ",'" . $row[ 'publishers' ] . "'";
				
			}
		}
		$genrelist = $genrelist . ")";
		$publisherlist = $publisherlist . ")";
		$sql = "SELECT * FROM `user_booklist` WHERE genre in $genrelist AND publishers in $publisherlist  AND user_id<>$id";

		//echo "$sql";
	} 
	

	
	$result = mysqli_query( $con, $sql );
	
	if($result==NULL){
		echo "<font color='red'>Your Booklist in empty.No Suggestion Found</font>";
	}else{
		while ( $res = mysqli_fetch_array( $result ) ) {

		if($res <0){
		echo "<tr>";	
		echo "<td>"."Data Not Found!!"."</td>";
		echo "</tr>";	
		}else{
			
			echo "<tr>";
			echo "<td>" . $res[ 'bookname' ] . "</td>";
			echo "<td>" . $res[ 'authorname' ] . "</td>";
			echo "<td>" . $res[ 'genre' ] . "</td>";
			echo "<td>" . $res[ 'publishers' ] . "</td>";
			echo "<td>" . $res[ 'country' ] . "</td>";	
			echo "</tr>";	
		}
		


	}
	}
	
	

}
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