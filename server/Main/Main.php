<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");
?>
<html>
<title>Main</title>
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
    <div  id="subBarView">
		<div id="selectBar">
    			<ul>
					<li><button id="recent" class="btn-link"><span>Feed</span></button></li> 
					<li><button id="recent" class="btn-link"><span>Recent</span></button></li>      
					<li><button id="recent" class="btn-link"><span>Favorite</span></button></li> 
					<li><button id="recent" class="btn-link"><span>History?</span></button></li>
					<li></li><!--Search-->					
				</ul>
		</div>
	</div>
	
	<div>
		<?php


			//TODO: all project return here: 
			$searchProject = "select project.pid, project.pname, status, tags, curAmount, minAmount, endDate from project";
			//布局你来吧
			// $pledgedProject = "select * from (select distinct pid from sponsor where uname = '$loginname')as T natural join project";
			// $newProject = "select * from project order by startDate DESC Limit 4"；
			//
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
		<!--Template-->
		<!--div class="col-md-3" id="projectView" style="position:relative width=200px height=400px;">
			<div id="briefProject">
				<figure><img src="http://127.0.0.1/Images/projectbgTemp.jpg" width="200" height="200"></figure>
				<h1>Project Name</h1>
				<p>Some Decription of Project ...</p>
			</div>
			<div id="detail">
				<button onclick="location.href='http://127.0.0.1/Main/project.html'">Detail</button>
			</div>
		</div>
		<div class="col-md-3" id="projectView" style="position:relative width=200px height=400px;">
			<div id="briefProject">
				<figure><img src="http://127.0.0.1/Images/projectbgTemp.jpg" width="200" height="200"></figure>
				<h1>Project Name</h1>
				<p>Some Decription of Project ...</p>
			</div>
			<div id="detail">
				<button onclick="location.href='http://127.0.0.1/Main/project.html'">Detail</button>
			</div>
		</div-->
	</div>
	
</div>

	
</html>