<head>
<?php
	//print "Productlist: \n";
	$db = mysqli_connect('localhost','root','1234','crowdfunding')
		or die('Error connecting to MySQL server.');
	//parameters
	$loginname = $_POST['username'];
	$password = $_POST['password'];
	//check username
	$queryCheckUser = "select password from user where uname = '$loginname'";
	$userResult = mysqli_query($db,$queryCheckUser) or die(mysqli_error());
	if(mysqli_num_rows($userResult) == 0){
		//wrong uname
		echo("wrong uname");
		echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/index.html\">";
	}
	else{
		//password
		while ($pa = mysqli_fetch_array($userResult)) {
			if((string)$password == $pa[0]){
				//
				echo("login Success");
				session_start();
				$_SESSION["username"] = $loginname;
				echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/Main.html\">";
			}
			else{
				//wrong password
				echo("wrong password\n");
				echo($pa[0]);
				
				echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/index.html\">";
			}
		}
	}
?>
</head>