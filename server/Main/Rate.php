<?php
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
	$rate = $_POST['mark'];
	$submit = $_POST['submit'];

	if (isset($_POST['submit'])){
		echo $rate."<br>".$pid."<br>".$loginname;
}
else echo "wrong";
?>