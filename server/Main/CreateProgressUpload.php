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
	$pid = $_GET['pid'];
	$version = $_POST['version'];
	$description = $_POST['description'];

	//$destination_path = $_REQUEST["destination"] . "/"; 
	//$destination_path = "Images/";
	//$target_path = "../htdocs/" . $destination_path;
	$target_path = "D:\Server\Apache24\htdocs\Images\Project\\";
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	$protrait_name = $_FILES['uploadedfile']['name'];
	
	echo "Source=" .        $_FILES['uploadedfile']['name'] . "<br />"; 
	echo "Source=" .        $protrait_name . "<br />"; 
	echo "Target path=" .   $target_path . "<br />"; 
	echo "Size=" .          $_FILES['uploadedfile']['size'] . "<br />"; 
	//echo "Tmp name=" .    $_FILES['uploadedfile']['tmp_name'] . "<br />"; 
	echo "Error=" . 		$_FILES['uploadedfile']['error'] . "<br/>";
	
	
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded";
		//update in data base
		$insertQ = "INSERT INTO `progress` (`pid`, `version`, `description`, `imagePath`) VALUES 
					($pid, $version, '$description', '$protrait_name');";
		//$insertQ = "INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`, `imagePath`, `description`) VALUES 
		//			('$loginname', '$startDate', '$endDate', $minAmount, $maxAmount, $curAmount, '$pname', '$status', '$tags', '$protrait_name', '$description');";
		$insertNewProject = mysqli_query($db,$insertQ) or die(mysqli_error());
		
	} else{
		echo "There was an error uploading the file, please try again!";
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"1; url=http://127.0.0.1/Main/Profile.php?profileName=$loginname\">";
?>