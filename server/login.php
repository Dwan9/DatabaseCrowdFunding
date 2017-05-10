<?php session_start();?>

<html>
<body>
<?php
if (isset($_POST['submit'])){
	require_once("connect.php");
	$loginname = $_POST['username'];
	$password = $_POST['password'];
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
				echo("Login Success");
				$_SESSION["username"] = $loginname;
				$s_id = session_id(); 
				echo("<br>Welcome $loginname!");
				echo "<meta http-equiv=\"refresh\" content=\"1; url=http://127.0.0.1/Main/Main.php\">";
				//echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/Main.html?sid=$s_id\">";
			}
			else{
				//wrong password
				echo("Wrong password.\n");
				echo($pa[0]);
				echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/index.html\">";
			}
		}
	}
}
?>
</body>
</html>
