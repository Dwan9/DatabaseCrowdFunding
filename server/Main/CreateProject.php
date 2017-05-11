<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
?>

<html>
<title>CreateProject</title>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="http://127.0.0.1/css/styles.css" rel="stylesheet">

  </head>
	
	<!-- bar -->
	<div "col-md-12 barContainer" id="barView">
		<div id="navBar">
				<ul>
					<li><button id="Main" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Main.php'">
						<span>Projects</span></button></li>
					<li><button id="profile" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Profile.php'">
						<span><?php echo $loginname ?></span></button></li>
					<li><button id="Log_out" class="btn-link" style="float: right;" onclick="location.href='http://127.0.0.1/logout.php'">
						<span>Log out</span></button></li>
				</ul>
		</div>
    </div>
	
	<!--INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
		('zhu', '2017-04-17', '2017-09-17', 1000, 5000, 50, 'the dog king board game', 'FUNDING', 'strategy game');-->
	<div style = "margin-top:10px; margin-left:10px">
		<form enctype="multipart/form-data" action="CreateProjectUpload.php" method="post">
		<ul>
			<li><label for="endDate">endDate : yyyy-mm-dd</label>
				<input type="text" name="endDate" placeholder="required" required></li>
			<li><label for="minAmount">minAmount</label>
				<input type="text" name="minAmount" placeholder="required" required></li>
			<li><label for="maxAmount">maxAmount</label>
				<input type="text" name="maxAmount" placeholder="required" required></li>
			<li><label for="pname">pname</label>
				<input type="text" name="pname" placeholder="required" required></li>
			<li><label for="tags">tags</label>
				<input type="text" name="tags" placeholder="required" required></li>
			<li><label for="description">description</label>
				<input type="text" name="description"></li>
			<li><label for="uploadedfile">Select Picture</label>
				<input type="file" size="35" name="uploadedfile" /></li>
			<li><input type="submit" name="submit" value="submit" /></li>
		</ul>
		</form>
	</div>
	
</html>