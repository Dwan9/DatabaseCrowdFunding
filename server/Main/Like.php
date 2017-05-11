<?php
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	$l = $_GET['l'];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");

	if ($l){
		$unlike = mysqli_query($db, "delete from likes where pid = $pid and uname = '$loginname'");
		if ($unlike){
			echo "You've unliked this project.";
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error".$unfollow."<br>".mysqli_error($db);
	}
	else{
		$like = mysqli_query($db, "insert into likes values($pid, '$loginname');");
		if ($like){
			echo "You've liked this project.";
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error".$follow."<br>".mysqli_error($db);
	}
?>