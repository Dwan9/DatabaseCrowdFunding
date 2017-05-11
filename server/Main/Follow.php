<?php
	session_start();
	$funame = $_SESSION["username"];
	$uname = $_GET['uname'];
	$pid = $_GET['pid'];
	$f = $_GET['f'];
	if (!isset($funame)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");

	if ($f){
		$unfollow = mysqli_query($db, "delete from follower where uname = '$uname' and funame = '$funame'");
		if ($unfollow){
			echo "You've unfollowed $uname";
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error".$unfollow."<br>".mysqli_error($db);
	}
	else{
		$follow = mysqli_query($db, "insert into follower values('$uname', '$funame');");
		if ($follow){
			echo "You've followed $uname";
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error".$follow."<br>".mysqli_error($db);
	}
?>