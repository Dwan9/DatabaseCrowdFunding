<?php
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	$version = $_GET['version'];
	$description = $_POST['description'];
?>
<html>
<body>
<?php
if (isset($_POST['submit'])){
	if (!isset($description) and isset($pid)){
		echo "<script>location.href='project.php?pid=$pid';</script>";
	}
	else if(isset($loginname) and isset($pid) and isset($version) and isset($description)){
		require_once("../connect.php");

		$getOwnerName = mysqli_query($db, "select uname from project where pid = $pid") or die(mysqli_error());
		$ownerName = mysqli_fetch_array($getOwnerName)[0];
		
		$query = mysqli_query($db,"insert into comment values (	'$loginname', $pid, $version, '$description')");
		if($query) {
			echo "Your comment has been submitted.";
			mysqli_query($db,"insert into notification values ($pid, '$ownerName', \"$loginname has commented your project!\");");
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error".$query."<br>".mysqli_error($db);
	}
	else {
		echo "<script>location.href='../index.html';</script>";
	}
}
else echo "wrong";
?>
</body>
</html>