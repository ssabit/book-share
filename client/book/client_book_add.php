<?php

session_start();
//echo "username: ".$_SESSION['u_id']."<br>";
//echo "email: ".$_SESSION['u_email'];
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
$id=$_SESSION['id']
?>

<?php

if(isset($_POST['logout'])){
	
	header("Location:../../includes/logout.php");
	exit();
	
}



?>
<?php

// php code to search data in mysql database and set it in input text

if ( isset( $_POST[ 'search' ] ) ) {
	// id to search
	$id = $_POST[ 'searchbar' ];
	//$id = trim($_POST[ 'searchbar' ]);

	//echo "$id";
	//connect to mysql
	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );

	// mysql search query
	$query = "SELECT `book_id`,`book_name`, `author_name`, `country`,`genre`,`publishers` FROM `book_list` WHERE `book_name`='$id'";

			
	
	
	$result = mysqli_query( $connect, $query );
	// if id exist 
	// show data in inputs
	if ( mysqli_num_rows( $result ) > 0 ) {
		while ( $row = mysqli_fetch_array( $result ) ) {

			$book_id=$row['book_id'];
			$book_name = $row[ 'book_name' ];
			$author_name = $row[ 'author_name' ];
			$country = $row[ 'country' ];
			$genre = $row[ 'genre' ];
			$publishers = $row[ 'publishers' ];

		}


	}

	else {
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";
	
		echo "<script>window.alert('Book Not Found!!')</script>";
		
	}
}

else {
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";

	
}
if (isset($_POST['add'])) {

	
		//echo "get data";
        //strtolower();
		$bookname=ucwords($_POST['bookname']);
		$author_name=ucwords($_POST['authorname']);
		$country=ucwords($_POST['country']);
		$genre= ucwords($_POST['genre']);
		$publishers=ucwords($_POST['publishername']);

if( empty( $bookname )|| empty($author_name)  || empty($country) || empty($genre) || empty($publishers) ){
			
			
			echo "<script>window.alert('input field empty')</script>";
	}else{
	
	
	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );
	//var_dump($connect);
	$sql= "INSERT INTO `user_booklist`(`user_id`,`bookname`, `authorname`, `genre`,`publishers`,`country`) VALUES ($id,'$bookname','$author_name','$genre','$publishers','$country')";
	
	if (mysqli_query($connect, $sql)) {
    
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";

	
		echo "<script>window.alert('Book Added Successfully')</script>";
	
}
	 else {
		echo "<script>window.alert('input field empty')</script>";
    //echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
		
}
	

	
    }
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Add Book</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/user.css">
	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<!--	<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>-->
	<script src="../../js/typeahead.js"></script>
	

	<style>
		h1 {
			font-size: 20px;
			color: #111;
		}
		
		.content {
			width: 80%;
			margin: 0 auto;
			margin-top: 50px;
		}
		
		.tt-hint,
		.searchbar {
			border: 2px solid #CCCCCC;
			border-radius: 8px 8px 8px 8px;
			font-size: 24px;
			height: 45px;
			line-height: 30px;
			outline: medium none;
			padding: 8px 12px;
			width: 400px;
		}
		
		.tt-dropdown-menu {
			width: 400px;
			margin-top: 5px;
			padding: 8px 12px;
			background-color: #fff;
			border: 1px solid #ccc;
			border: 1px solid rgba(0, 0, 0, 0.2);
			border-radius: 8px 8px 8px 8px;
			font-size: 18px;
			color: #111;
			background-color: #F1F1F1;
		}
	</style>
	<script>
		$( document ).ready( function () {

			$( 'input.searchbar' ).typeahead( {
				name: 'searchbar',
				remote: '../others/find.php?query=%QUERY'

			} );

		} )
	</script>
	
	
	
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
				<form action="client_book_add.php" method="post">
				
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
					<a href="../profile/profile_edit.php" class="list-group-item list-group-item-action ">Edit</a>
					<a href="#" class="list-group-item list-group-item-action active">Add Book</a>
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
								<h4>Add Book</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="client_book_add.php" method="post">
									
									<div class="form-group row">
										<label for="Searchbar" class="col-4 col-form-label">Search Book</label>

										<div class="col-6">
											<input type="text" name="searchbar" size="30" class="searchbar" placeholder="Enter Book Name">
											
											
											<button type="submit" name="search" style="width:10%; margin-left:5px;   float:left;" class="btn btn-link"></button>
										</div>
										
									</div>
									
									<div class="form-group row">
										<label for="bookid" class="col-4 col-form-label" style="display: none">id</label>

										<div class="col-8">
											<input id="bookid" name="bookid" class="form-control here" type="text" value="<?php echo $book_id;?>" style="display: none">
										</div>
									</div>
									
									
									<div class="form-group row">
										<label for="booksname" class="col-4 col-form-label">Book Name</label>

										<div class="col-8">
											<input id="bookname" name="bookname" placeholder="Book Name" class="form-control here" type="text" value="<?php echo $book_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="favourite author" class="col-4 col-form-label">Author Name</label>
										<div class="col-8">
											<input id="author name" name="authorname" placeholder="Author Name" class="form-control here" type="text" value="<?php echo $author_name;?>">
										</div>
									</div>
									
									
									<div class="form-group row">
										<label for="country" class="col-4 col-form-label">Country</label>
										<div class="col-8">
											<input id="country" name="country" placeholder="Country Name" class="form-control here" type="text" style="width:50%;float: left;" value="<?php echo $country;?>">

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.country.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
													<OPTION VALUE="Australia">Australia
														<OPTION VALUE="Afghanistan">Afghanistan
															<OPTION VALUE="Bangladesh">Bangladesh
																<OPTION VALUE="Belgium">Belgium
																<OPTION VALUE="Bhutan">Bhutan
																	<OPTION VALUE="Brazil">Brazil
																		<OPTION VALUE="Canada">Canada
																			<OPTION VALUE="China">China
																				<OPTION VALUE="Costa Rica">Costa Rica
																					<OPTION VALUE="Cuba">Cuba
																						<OPTION VALUE="Denmark">Denmark
																							<OPTION VALUE="Egypt">Egypt
																								<OPTION VALUE="Finland">Finland
																								<OPTION VALUE="France">France
																								<OPTION VALUE="Germany">Germany
																								<OPTION VALUE="Honduras">Honduras
																								<OPTION VALUE="Hong Kong">Hong Kong
																								<OPTION VALUE="Hungary">Hungary
																								<OPTION VALUE="Iceland">Iceland
																								<OPTION VALUE="India">India
																								<OPTION VALUE="Indonesia">Indonesia
																								<OPTION VALUE="Israel">Israel
																								<OPTION VALUE="Japan">Japan
																								<OPTION VALUE="Korea">Korea
																								<OPTION VALUE="Libya">Libya
																								<OPTION VALUE="Malaysia">Malaysia
																								<OPTION VALUE="Mexico">Mexico
																								<OPTION VALUE="Nepal">Nepal
																								<OPTION VALUE="Netherlands">Netherlands
																								<OPTION VALUE="New Zealand">New Zealand
																								<OPTION VALUE="Oman">Oman
																								<OPTION VALUE="Pakistan">Pakistan
																								<OPTION VALUE="Philippines">Philippines
																								<OPTION VALUE="Poland">Poland
																								<OPTION VALUE="Qatar">Qatar
																								<OPTION VALUE="Russia">Russia
																								<OPTION VALUE="Saudi Arabia">Saudi Arabia
																								<OPTION VALUE="Sierra Leone">Sierra Leone
																								<OPTION VALUE="Singapore">Singapore
																								<OPTION VALUE="Spain">Spain
																								<OPTION VALUE="Sri Lanka">Sri Lanka
																								<OPTION VALUE="Switzerland">Switzerland
																								<OPTION VALUE="Syria">Syria
																								<OPTION VALUE="Taiwan">Taiwan
																								<OPTION VALUE="Thailand">Thailand
																								<OPTION VALUE="Turkey">Turkey
																								<OPTION VALUE="Uganda">Uganda
																								<OPTION VALUE="United Arab Emirates">United Arab Emirates
																								<OPTION VALUE="United Kingdom">United Kingdom
																								<OPTION VALUE="United States of America">USA
																								<OPTION VALUE="Venezuela">Venezuela
																								<OPTION VALUE="Vietnam">Vietnam
																								<OPTION VALUE="Yemen">Yemen
																								<OPTION VALUE="Zambia">Zambia
																								<OPTION VALUE="Zimbabwe">Zimbabwe
											</SELECT>
										</div>
									</div>

									<div class="form-group row">
										<label for="bookgenres" class="col-4 col-form-label">Genre</label>

										<div class="col-8">
											<input id="genre" name="genre" placeholder="Genre" class="form-control here" type="text" style="width:50%;float: left;" value="<?php echo $genre;?>">

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.genre.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
													<OPTION VALUE="Action">Action
														<OPTION VALUE="Adventure">Adventure
														<OPTION VALUE="Computer Science">Computer Science
															<OPTION VALUE="Drama">Drama
																<OPTION VALUE="Fantasy">Fantasy
																	<OPTION VALUE="Horror">Horror
																		<OPTION VALUE="Mythology">Mythology
																			<OPTION VALUE="Mystery">Mystery
																				<OPTION VALUE="Romance">Romance
																					<OPTION VALUE="Satire">Satire
																						<OPTION VALUE="Science Fiction">Science Fiction
																							<OPTION VALUE="Tragedy">Tragedy
																								<OPTION VALUE="Tragic Comedy">Tragic comedy
											</SELECT>
										</div>
									</div>
									


									<div class="form-group row">
										<label for="publishername" class="col-4 col-form-label">Publishers</label>
										<div class="col-8">
											<input id="publishername" name="publishername" placeholder="Publisher Name" class="form-control here" type="text" value="<?php echo $publishers;?>">
										</div>
									</div>

									

									
									<div class="form-group row">
										<div class="offset-4 col-8">
											<button name="add" type="submit" class="btn btn-primary">Insert</button>
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