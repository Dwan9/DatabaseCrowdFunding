<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	$pid = $_GET['pid'];
	$amount = $_POST['number'];

	require_once("../connect.php");
?>

<html>
<body>
<?php


	$ifSponsored = mysqli_query($db,"select * from sponsor where pid = $pid and uname = '$loginname'");
	if (mysqli_num_rows($ifSponsored)>0){
	$query1 = mysqli_query($db,"update sponsor set amount = amount + $amount where pid = $pid and uname = '$loginname'");
	$query2 = mysqli_query($db,"update project set curAmount = curAmount + $amount where pid = $pid");
	if ($query1 && $query2){
		echo "Your pledge has been updated. Appreciated again.";
		echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
	}
	else echo "Error<br>".mysqli_error($db);
}
	else{

	$getStatus = mysqli_query($db,"select status from project where pid = $pid");
	$status = 'WAIT';
	while ($s = mysqli_fetch_array($getStatus)){
		if ($s[0] == "FUNDED") $status = 'CHARGED';
	}
	$inserting = mysqli_query($db,"insert into `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  ($pid, '$loginname', $amount, '$status');");
	if($inserting) {
			echo "Your pledge has been submitted, Thank you for your Donation.";
			echo "<meta http-equiv=\"refresh\" content=\"3; url=http://127.0.0.1/Main/project.php?pid=$pid\">";
		}
		else echo "Error<br>".mysqli_error($db);}

?>
</body>
</html>