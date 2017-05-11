<?php
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
	$rate = $_POST['mark'];

	if (isset($_POST['submit'])){
		$checkQuery = mysqli_query($db, "select rate from sponsor where pid = $pid and uname = '$loginname'");
		$check = mysqli_fetch_array($checkQuery)[0];
		if($checkQuery) {
			if ($check){
				echo "Sorry you've rated.";
				echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
			}
			else{
				$updateRate = mysqli_query($db, "update sponsor set rate = $rate where pid = $pid and uname = '$loginname'");
				if ($updateRate){
					echo "Your rating has been submitted, Thank you!";
					echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
				}
				else echo "Error".$checkQuery."<br>".mysqli_error($db);
			}
			
		}
		else echo "Error".$checkQuery."<br>".mysqli_error($db);
}
else echo "wrong";
?>