<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
	$searchNoti = mysqli_query($db,"select pid, description from notification where uname = '$loginname'")
					or die(mysqli_error());
?>
<html>
<title>Notification</title>
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
					<li><button id="profile" class="btn-link" 
								onclick="location.href='http://127.0.0.1/Main/Profile.php?profileName=<?php echo $loginname ?>'">
						<span><?php echo $loginname ?></span></button></li>
					<li><button id="Log_out" class="btn-link" style="float: right;" onclick="location.href='http://127.0.0.1/logout.php'">
						<span>Log out</span></button></li>
				</ul>
		</div>
    </div>
	
	<div>
	<?php
		while ($row = mysqli_fetch_array($searchNoti)) {
			$pid = $row["pid"];
			$description = $row["description"];
			$finePName = mysqli_query($db, "select pname from project where pid = $pid") or die (mysqli_error);
			$pname = "project";
			while ($name = mysqli_fetch_array($finePName)){
				$pname = $name["pname"];
			}
			echo "<div style=\"margin-top:10px\" class=\"row\">";
			echo "<p class=\"col-md-5\">$description On $pname</p>";
			//button to the project:
			echo "<button class=\"col-md-2\" onclick=\"location.href='http://127.0.0.1/Main/Project.php?pid=$pid'\">More</button>";
			echo "</div>";
		}
	?>
	
	</div>

	
</html>