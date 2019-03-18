<?php

session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}

$id=$_SESSION['id'];
$rating=$_SESSION['rating'];
?>

<?php

if(isset($_POST['logout'])){
	
	header("Location:../../includes/logout.php");
	exit();
	
}



?>

<?php


	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );
	$query = "SELECT * FROM `posts` where post_owner_id<>$id ORDER BY post_id DESC";
	

	$date = new DateTime();
	$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
	$get_datetime = $date->format('l, F dS, Y g:i A');
	//echo $get_datetime;

	$result = mysqli_query( $connect, $query );
	

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Forum</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
				<form action="forum.php" method="post">
				
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
				<a href="../profile/profile.php" class="list-group-item list-group-item-action">Profile</a>
					<a href="../profile/profile_edit.php" class="list-group-item list-group-item-action">Edit</a>
					<a href="../book/client_book_add.php" class="list-group-item list-group-item-action">Add Book</a>
					<a href="../book/client_book_list.php" class="list-group-item list-group-item-action">Book List</a>
					<a href="../book/book_suggestion.php" class="list-group-item list-group-item-action">Book Suggestion</a>
					<a href="create_post.php" class="list-group-item list-group-item-action ">Create Post</a>
					<a href="../requests/requests.php" class="list-group-item list-group-item-action">Requests</a>
					<a href="../requests/approve_list.php" class="list-group-item list-group-item-action">Request Approve List</a>
					<a href="../others/my_posts.php" class="list-group-item list-group-item-action">My Posts</a>
					<a href="../requests/history.php" class="list-group-item list-group-item-action">History</a>
					<a href="#" class="list-group-item list-group-item-action active">Forum</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>Posts</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="">
									<div class="table-responsive">
										<table class="table">
											<tbody>
							

	 <?php 
        while($row = mysqli_fetch_array($result)) {         
            //$own=$row['post_owner'];
			
			echo "<tr >";
			echo "<td colspan='11'>"."Posted By - ".$row['post_owner']."<br>"."Published on - ".$row['time']."<br>"."Book Name: ".$row['book_name']."<br>"."Genre: ".$row['post_genre']."<br>".$row['status']
				//." <form method='POST' id='comment_form' action='../test/add_comment.php' >"
				."<div class='form-group'>"
     			."<input type='hidden' id='owner_id".$row['post_id']."' value='".$row['post_owner_id']."'/> 
				<input type='hidden' id='post_id".$row['post_id']."' value='".$_SESSION['id']."'></div>"
   				."<div class='form-group'>"
				."<input type='hidden' id='comment_content".$row['post_id']."' name='comment_content' class='form-control'placeholder='Enter Comment' value='1'>
				
				<input type='hidden' id='bookname".$row['post_id']."' name='bookname' class='form-control'placeholder='' value='".$row['book_name']."'>	
				
				<input type='hidden' id='rating".$row['post_id']."' name='rating' class='form-control'placeholder='' value='".$rating."'>	
				
    			
				</div>"
				."<div class='form-group'>"
				."<input type='button' name='submit' id='submit' class='btn btn-info' value='Request' onclick='addcomment(".$row['post_id'].");' />"
				."</div>"				
  				."</div>"."</td>";

			 echo "</tr>";
			
			


						
			
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

	<script>
			function addcomment(post_id){
				console.log('here I am'+post_id+document.getElementById('owner_id'+post_id).value+document.getElementById('post_id'+post_id).value+document.getElementById('comment_content'+post_id).value);
							
				var req=new XMLHttpRequest();
				req.onreadystatechange=function(){
					if(this.status==200 && this.readyState==4){
						console.log(this.responseText); 
					}
				}
				
				var path='../requests/request_add.php?owner_id='+document.getElementById('owner_id'+post_id).value+'&post_id='+document.getElementById('post_id'+post_id).value+'&comment_content='+document.getElementById('comment_content'+post_id).value+'&bookname='+document.getElementById('bookname'+post_id).value+'&rating='+document.getElementById('rating'+post_id).value;
				
				//console.log(path);
				req.open('GET',path,true);
				req.send();
			}
		
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</html>