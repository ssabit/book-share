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


<?php

if ( isset( $_POST[ 'search' ] ) ) {
	// id to search
	$id = $_POST[ 'searchbar' ];

	//echo "$id";

	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );


	$query = "SELECT `book_id`,`book_name`, `author_name`, `country`,`genre`,`publishers`,`publication_year`,pages,`isbn`,price FROM `book_list` WHERE `book_name`='$id'";

			
	
	
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
			$publication_year = $row[ 'publication_year' ];
			$pages = $row[ 'pages' ];
			$isbn = $row[ 'isbn' ];
			$price = $row[ 'price' ];
		}


	}

	// if the id not exist
	// show a message and clear inputs
	else {
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";
			$publication_year = "";
			$pages = "";
			$isbn = "";
			$price = "";
		echo "<script>window.alert('Book Not Found!!')</script>";
		
	}
}

else {
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";
			$publication_year = "";
			$pages = "";
			$isbn = "";
			$price = "";
	
}




if (isset($_POST['add'])) {

	
		//echo "get data";
        //strtolower();
		$bookname=ucwords($_POST['bookname']);
		$author_name=ucwords($_POST['authorname']);
		$country=ucwords($_POST['country']);
		$genre= ucwords($_POST['genre']);
		$publishers=ucwords($_POST['publishername']);
		$publication_year=$_POST['publicationyear'];
		$pages=$_POST['pages'];
		$isbn=$_POST['isbn'];
		$price=$_POST['price'];

	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );
	//var_dump($connect);
	$sql= "INSERT INTO `book_list`(`book_name`, `author_name`, `country`,`genre`,`publishers`,`publication_year`,`pages`,`isbn`,`price`) VALUES ('$bookname','$author_name','$country','$genre','$publishers','$publication_year',$pages,'$isbn',$price)";
	
	if (mysqli_query($connect, $sql)) {
    //echo "New record created successfully";
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";
			$publication_year = "";
			$pages = "";
			$isbn = "";
			$price = "";
	
		echo "<script>window.alert('New record created successfully')</script>";
		
		
	
} else {
		echo "<script>window.alert('input field empty')</script>";
    //echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
	
    }
?>
<?php


if(isset($_POST['update']))
{    
	//echo "update got";
		$book_id=$_POST['bookid'];
		$bookname=$_POST['bookname'];
		$author_name=$_POST['authorname'];
		$country=$_POST['country'];
		$genre=$_POST['genre'];
		$publishers=$_POST['publishername'];
		$publication_year=$_POST['publicationyear'];
		$pages=$_POST['pages'];
		$isbn=$_POST['isbn'];
		$price=$_POST['price'];

		$con = mysqli_connect( "localhost", "root", "", "book_share_community" );
        
		$sql="UPDATE book_list SET book_name='$bookname',author_name='$author_name',country='$country',genre='$genre',publishers='$publishers',publication_year='$publication_year',pages=$pages,isbn='$isbn',price=$price WHERE book_id=$book_id";
		
		//echo "$sql";
		$res=mysqli_query($con, $sql);
		//var_dump($res);
		
		if ($res) {
    //echo "New record created successfully";
			$book_name ="";
			$author_name = "";
			$country = "";
			$genre = "";
			$publishers = "";
			$publication_year = "";
			$pages = "";
			$isbn = "";
			$price = "";
	
		echo "<script>window.alert('Record Updated successfully')</script>";
		
	
} else {
    echo "<script>window.alert('input field empty')</script>";
			//echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
    }
?>



<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Book Add or Edit</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/user.css">
	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<!--	<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>-->
	
	<script src="../js/typeahead.js"></script>
	

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
				remote: '../client/others/find.php?query=%QUERY'

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
				<form action="add_book.php" method="post">
				
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
					<a href="admin.php" class="list-group-item list-group-item-action">Users</a>
					<a href="#" class="list-group-item list-group-item-action active">Add Book/Edit</a>
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
								<h4>Book Add or Edit</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="add_book.php" method="post">
									
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
										<label for="publicationyear" class="col-4 col-form-label">Publication Year</label>
										<div class="col-8">
											<input id="publication" name="publicationyear" placeholder="Year" class="form-control here" type="text" style="width:50%;float: left;" value="<?php echo $publication_year;?>">

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.publication.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
													 <?php
                            							$i=1800;
														while($i<2100):;?>

                                						<option><?php echo ++$i;?></option>
                           								<?php endwhile;?>
											</SELECT>
										</div>
									</div>													
											
									<div class="form-group row">
										<label for="pages" class="col-4 col-form-label">Pages</label>
										<div class="col-8">
											<input id="pages" name="pages" placeholder="No.of Pages" class="form-control here" type="text" style="width:50%;float: left;" value="<?php echo $pages;?>">

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.pages.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
													 <?php
                            							$i=0;
														while($i<2100):;?>

                                						<option><?php echo ++$i;?></option>
                           								<?php endwhile;?>
											</SELECT>
										</div>
									</div>														
										
									<div class="form-group row">
										<label for="isbn" class="col-4 col-form-label">ISBN</label>

										<div class="col-8">
											<input id="isbn" name="isbn" placeholder="ISBN No." class="form-control here" type="text" value="<?php echo $isbn;?>">
										</div>
									</div>
										
									<div class="form-group row">
										<label for="price" class="col-4 col-form-label">Price</label>

										<div class="col-8">
											<input id="price" name="price" placeholder="Price" class="form-control here" type="text"  value="<?php echo $price;?>"><br><br>
										</div>
									</div>

									
									<div class="form-group row">
										<div class="offset-4 col-8">
											<button name="add" type="submit" class="btn btn-primary">Insert</button>
											<button name="update" type="submit" class="btn btn-primary">Update</button>
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