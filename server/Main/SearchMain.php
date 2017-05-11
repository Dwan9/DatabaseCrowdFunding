<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
	$searchKey = $_POST['keys'];
	$searchKey_temp = $_GET['keys'];
	if($searchKey_temp != ""){
		$searchKey = $searchKey_temp;
	}
?>
<html>
<title>Main</title>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="http://127.0.0.1/css/styles.css" rel="stylesheet">
	<script type="text/javascript" src="http://127.0.0.1/AntiSqlInject.js"></script>
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
    <div>
		<div>
    			<ul class="row" style="background-color: #90caaf; list-style-type: none;">
					<li class="col-md-1" style="margin-top:5px"><button id="recent" class="btn-link"><span>Feed</span></button></li>     
					<li class="col-md-1" style="margin-top:5px"><button class="btn-link"><span>Favorite</span></button></li>
					<li style="margin-left:250px; margin-top:5px" class="col-md-3">
						<form name="search" action="SearchMain.php" method="post">
							<input type="text" name="keys" onblur="AntiSqlInject(this)"
									style="height: 20px;" placeholder="required" required>
							<input type="submit" name="submit" value="Search">
						</form>
					</li>
				</ul>
		</div>
	</div>
	
	<div class="row">
		<?php
			//TODO: all project return here: 
			$searchProject = "select project.pid, project.pname, status, tags, curAmount, minAmount, endDate 
							  from project
							  where project.tags like '%$searchKey%' or pname like '%$searchKey%'";
			$allProject =  mysqli_query($db,$searchProject) or die(mysqli_error());
			while ($pro = mysqli_fetch_array($allProject)) {
				$pid = $pro["pid"];
				$pname = $pro["pname"];
				$tags = $pro["tags"];
				$status = $pro["status"];
				$curAmount = $pro["curAmount"];
				$minAmount = $pro["minAmount"];
				$endDate = $pro["endDate"];
				echo "<div class=\"col-md-3\" style=\"position:relative width=200px height=400px; margin-top:10px\">
						<div>
							<figure><img src=\"http://127.0.0.1/Images/projectbgTemp.jpg\" width=\"200\" height=\"200\"></figure>
							<h1 style=\"font-size:18px;\">$pname</h1>
							<h2 style=\"font-size:10px;\">$$curAmount/$$minAmount</h2>
							<h3 style=\"font-size:10px;\">DUE $endDate</h3>
							<p>$tags</p>
						</div>
						<div>
							<button onclick=\"location.href='http://127.0.0.1/Main/project.php?pid=$pid'\">Detail</button>
						</div>
					</div>";
			}
		?>
	</div>
	
</div>

	
</html>