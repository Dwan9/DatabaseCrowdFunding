<head>
<?php
	//print "Productlist: \n";
	$db = mysqli_connect('localhost','root','1234','crowdfunding')
		or die('Error connecting to MySQL server.');
	//parameters
	$pledgeNumber = $_POST['number'];
	//update amount and check if trigger worked
?>
</head>