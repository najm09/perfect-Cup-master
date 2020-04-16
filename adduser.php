<?php
	session_start();
	$mysqli = new mysqli('localhost', 'root', 'test3', 'perfectcup');
	if($mysqli->connect_error){
		die('Error: (' . $mysqli->connect_errno . ') '.$mysqli->connect_error);
	}
	
	if(!(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) ||empty($_POST['password']))){
		$fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
		$lname = mysqli_real_escape_string($mysqli, $_POST['lname']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		
		//VALIDATION
		if(strlen($fname) < 2){
			echo 'fname';
		}elseif(strlen($lname) < 2){
			echo 'lname';
		}elseif(strlen($email) <= 4){
			echo 'eshort';
		}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			echo 'eformat';
		}elseif(strlen($password) <= 4){
			echo 'pshort';
	 
		}else{
			//PASSWORD ENCRYPT
			$spassword = password_hash($password, PASSWORD_BCRYPT, array('cost => 12'));
			$sql = "SELECT * FROM members WHERE email = '$email'";
			$result = mysqli_query($mysqli, $sql) ;
			$num_row = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result);
			
			if($num_row < 1){
				$query = "INSERT INTO members (`fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$spassword')";
				$insert_row = mysqli_query($mysqli,$query);
				
				if($insert_row){
					$_SESSION['login'] = $mysqli->insert_id;
					$_SESSION['fname'] = $fname;
					$_SESSION['fname'] = $fname;
					
					echo "true";
				}
			}else{
					echo "false";
				}
			}
		}else{
		echo  "fill all the mandatory input fields";
	}
?>