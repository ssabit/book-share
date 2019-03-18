<?php
session_start();

if(isset($_POST['login'])){
	
	include('db.php');
	
	
	$uid=mysqli_real_escape_string($con,$_POST['username']);
	
	$pwd=mysqli_real_escape_string($con,$_POST['password']);
	
	
	///check if inpurts are empty	
	
	if(empty($uid)||empty($pwd)){
		header("Location: ../index.php?fields=empty");
		
		//echo "<script>window.alert('database not connected')</script>";
		
		//echo "<script>alert('Email or password is incorrect!')</script>"; 
		//header("Location: ../index.php?=empty");
		//exit();	
		
	}else{
		
		$sql="SELECT * FROM users WHERE username='$uid'";
		 //echo $sql;
		//return;
		
		$result=mysqli_query($con,$sql);
		$resultCheck=mysqli_num_rows($result);
		
/*			if($result)
				echo "result get";

			echo"uid ". $uid . "<br>";
			echo "pwd ". $pwd . "<br>";

			echo "result check ". $resultCheck . "<br>";*/
		//return;
		
		
		if($resultCheck<1){			
			header("Location: ../index.php?login=resulterror");
			echo "resultchk";
			exit();
	
		}else{
			
			if($row=mysqli_fetch_assoc($result)){
				
				//echo "username:". $row['username'];				
				//De-hashing the password
				//$hashPwdCheck=password_verify($pwd,$row['password']);					
				//echo "password ". $row['password']. "<br>";
				//echo "login password ". $hashPwdCheck. "<br>";
				//return;
				
				if($pwd!=$row['password']){
					//echo"uid1 ". $uid . "<br>";
					//echo "pwd1 ". $pwd . "<br>";
					//echo "False";
					
					//return;
					header("Location: ../index.php?login=passworderror");
					
			exit();
					
				}else if($pwd==$row['password']){				
				
					//login the user here
					$_SESSION['u_id']=$row['username'];
					$_SESSION['u_first']=$row['first_name'];
					$_SESSION['u_last']=$row['last_name'];
					$_SESSION['u_email']=$row['email'];
					$_SESSION['u_pwd']=$row['password'];
					$_SESSION['id']=$row['id'];
					$_SESSION['rating']=$row['rating'];
					
					$level=$row['user_level'];
					if($level==3){
					
						
						header("Location: ../administrator/admin.php");
						exit();	
					}
					else{
		
						
						header("Location: ../client/profile/profile.php");
						exit();	
					}
						
					
					
					
					
				
				}
				
			}
			
		}
		
		
	}
	
	
	
}else{

	header("Location: ../index.php?login=error");
	//echo "login error";
	//echo "<script>window.alert('invalid')</script>";
	exit();
	
	
	
}


?>
