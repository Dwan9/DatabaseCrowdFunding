<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	$db = mysqli_connect('localhost','root','1234','crowdfunding')
			or die('Error connecting to MySQL server.');

	//params
	$newEmail = $_POST['email'];

	//$destination_path = $_REQUEST["destination"] . "/"; 
	//$destination_path = "Images/";
	//$target_path = "../htdocs/" . $destination_path;
	$target_path = "D:\Server\Apache24\htdocs\Images\\";
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	$protrait_name = $_FILES['uploadedfile']['name'];
	
	echo "Source=" .        $_FILES['uploadedfile']['name'] . "<br />"; 
	echo "Source=" .        $protrait_name . "<br />"; 
	echo "Email=" .   		$newEmail . "<br />"; 
	echo "Target path=" .   $target_path . "<br />"; 
	echo "Size=" .          $_FILES['uploadedfile']['size'] . "<br />"; 
	//echo "Tmp name=" .    $_FILES['uploadedfile']['tmp_name'] . "<br />"; 
	echo "Error=" . 		$_FILES['uploadedfile']['error'] . "<br/>";
	
	
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded";
		//update in data base
		$updatePath = "update user set protraitPath = '$protrait_name' where uname = '$loginname';";
		$updateResult = mysqli_query($db,$updatePath) or die(mysqli_error());
		if($newEmail != ""){
			$updateEmail = "update user set uemail = '$newEmail' where uname = '$loginname';";
			$updateResult = mysqli_query($db,$updateEmail) or die(mysqli_error());
		}
		
	} else{
		echo "There was an error uploading the file, please try again!";
		if($newEmail != ""){
			$updateEmail = "update user set uemail = '$newEmail' where uname = '$loginname';";
			$updateResult = mysqli_query($db,$updateEmail) or die(mysqli_error());
		}
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"1; url=http://127.0.0.1/Main/Profile.php?profileName=$loginname\">";
?>