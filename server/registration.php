<head>
<?php
	//print "Productlist: \n";
	$db = mysqli_connect('localhost','root','1234','crowdfunding')
		or die('Error connecting to MySQL server.');
	//parameters
	$loginname = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$credit = $_POST['credit'];
	//check username
	$queryCheckUser = "select password from user where uname = '$loginname'";
	$userResult = mysqli_query($db,$queryCheckUser) or die(mysqli_error());
	if(mysqli_num_rows($userResult) != 0){
		//wrong uname
		echo("user name be used!");
		//Store former information?
		echo "<button onclick=\"goBack()\">Go Back</button><script>function goBack() {window.history.back();}</script>";
		//echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Registration.html\">";
	}
	else{
		$insertNewUser = "INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
						('$loginname', '$email','$password','$credit');";
		$insertResult = mysqli_query($db,$insertNewUser) or die(mysqli_error());
		//success page
		echo("regist Success");
		session_start();
		$_SESSION["username"] = $loginname;
		$s_id = session_id(); 
		echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/AfterRegistration.html">";
	}
?>
</head>