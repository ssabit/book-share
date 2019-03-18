<?php

session_start();
//echo "username: ".$_SESSION['u_id']."<br>";
//echo "email: ".$_SESSION['u_email'];
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}

$id=$_SESSION['u_id'];
?>


<?php

// php code to search data in mysql database and set it in input text
	//connect to mysql
	$connect = mysqli_connect( "localhost", "root", "", "book_share_community" );
	$query = "SELECT * FROM `posts`";

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
	<title>User</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
					<?php //echo $_SESSION['u_id'];?>
				</li><br>
				<li id="button"><input type="button" value="logout">
				</li>
			</ul>

		</div>



	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="list-group ">
					
					<a href="#" class="list-group-item list-group-item-action active">All Posts</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4>Feed</h4>
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
			echo "<td colspan='11'>".$row['post_owner']."<br><br>"."Published on - ".$row['time']."<br><br>"."Book Name: ".$row['book_name']."<br><br>"."Genre: ".$row['post_genre']."<br><br>"."owner_id-".$row['post_owner_id']."<br><br>".$row['status']
				//." <form method='POST' id='comment_form' action='../test/add_comment.php' >"
				."<div class='form-group'>"
     			."<input type='hidden' id='owner_id".$row['post_id']."' value='".$row['post_owner_id']."'/> 
				<input type='hidden' id='post_id".$row['post_id']."' value='".$_SESSION['id']."'></div>"//hidden1:post owner Id-----hidden2:current user login and commenter$row['post_owner_id']
				
   				."<div class='form-group'>"
				."<textarea id='comment_content".$row['post_id']."' name='comment_content' class='form-control'placeholder='Enter Comment' rows='5'></textarea>
    			</div>"
				."<div class='form-group'>"
				."<input type='button' name='submit' id='submit' class='btn btn-info' value='submit' onclick='addcomment(".$row['post_id'].");' />"
				."</div>"
				."<span id='comment_message'></span>"
				."<br />"
				."<div id='display_comment'></div>"
  				."</div>"."</td>";
			
			
			echo "<td><a href=\"../includes/post_delete.php?id=$row[post_id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><span class='glyphicon glyphicon-trash'></span></a></td>";
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
				
				var path='../test/add_comment.php?owner_id='+document.getElementById('owner_id'+post_id).value+'&post_id='+document.getElementById('post_id'+post_id).value+'&comment_content='+document.getElementById('comment_content'+post_id).value;
				
				//console.log(path);
				req.open('GET',path,true);
				req.send();
			}
		
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</html>