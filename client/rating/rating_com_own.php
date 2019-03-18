<?php

session_start();
if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
//echo "username: ".$_SESSION['u_id']."<br>";
//echo "email: ".$_SESSION['u_email'];
//global $pid;
$pid=$_SESSION['pid']
//return;
?>
<?php

if(isset($_POST['logout'])){
	
	header("Location: ../includes/logout.php");
	exit();
	
}



?>

<?php

include_once("../others/config.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
	
	
	if(isset($_POST['rating'])){
		$rating=$_POST['rating'];
		$rating=($res['rating']+$_POST['rating'])/2;
	}
	
	
	else
		echo "<script>window.alert('not found');</script>";

    if(empty($rating) ) {            
      
		 if(empty($rating)) {
            echo "<font color='red'>Level field is empty.</font><br/>";
			 exit();
        } 
	
	} else {    

        mysqli_query($con, "UPDATE users SET rating=$rating WHERE id=$id");
   
		//echo "before update: ".$pid;
		
		mysqli_query($con, "UPDATE share SET rate2=1 WHERE id=$pid");
		
		
		
        header("Location: ../requests/history.php");
		//exit();
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

$result = mysqli_query($con, "SELECT * FROM users WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{

	$rating=$res['rating'];
}
?>



<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Rating</title>

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
					<?php echo $_SESSION['u_id'];?>
				</li><br>
				<form action="rating_com_own.php" method="post">
				
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
								<h4>Rate User</h4>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form action="rating_com_own.php" method="post">
							
									<div class="form-group row">
										<label for="rating" class="col-4 col-form-label">Rating</label>
										<div class="col-8">
											<input id="rating" name="rating" placeholder="rating" class="form-control here" type="hidden" style="width:50%;float: left;" value="<?php echo $level?>" readonly >

											<SELECT class="custom-select" style="width:40%; margin-left:5px;   float:left;" onChange="this.form.rating.value=this.options[this.selectedIndex].value">
												<OPTION VALUE="">Select
														<OPTION VALUE="1">1
												
														<OPTION VALUE="2">2
															<OPTION VALUE="3">3
															<OPTION VALUE="4">4
															<OPTION VALUE="5">5
											</SELECT>
										</div>
									</div>
									


						
									<div class="form-group row">
										<div class="offset-4 col-8">
											<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
											<button name="update" type="submit" class="btn btn-primary">Rate</button>
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