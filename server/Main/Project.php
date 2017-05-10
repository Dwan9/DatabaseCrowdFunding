<?php
	//session_id($_GET['sid']);
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");

	$thisProject = mysqli_query($db,"select pname, status, tags, curAmount, minAmount, maxAmount, uname, startDate, endDate
									from project
									where pid=$pid") or die(mysqli_error());
	$thispname = "pname";
	$owner = "uname";
	$thisTags = "tags";
	$curAmount = "curAmount";
	$minAmount = "minAmount";
	$thisStatus = "status";
	$maxAmount = "maxAmount";
	$startDate = "startDate";
	$endDate = "endDate";
	while ($pro = mysqli_fetch_array($thisProject)) {
				$thispname = $pro["pname"];
				$owner = $pro["uname"];
				$thisTags = $pro["tags"];
				$curAmount = $pro["curAmount"];
				$minAmount = $pro["minAmount"];
				$thisStatus = $pro["status"];
				$maxAmount = $pro["maxAmount"];
				$startDate = $pro["startDate"];
				$endDate = $pro["endDate"];
				}
	
	$progressList = mysqli_query($db, "select version, description
										from progress
										where progress.pid=$pid") or die(mysqli_error());
?>
<html>
<title>Project</title>
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
					<li><button id="profile" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Profile.php?profileName=<?php echo $loginname ?>'">
						<span><?php echo $loginname ?></span></button></li>
					<li><button id="Log_out" class="btn-link" style="float: right;" onclick="location.href='http://127.0.0.1/logout.php'">
						<span>Log out</span></button></li>
				</ul>
		</div>
    </div>
	
<div>
	<div class="row" style="background-color:#bbb;">
		<div class="col-md-2" style="background-color:#ccc;">
			<div >
			<!--user of the project-->
			<figure style="display: block; margin-left:10px"><img src="http://127.0.0.1/Images/bg1.jpg" width="180" height="180"></figure>
			<a style="margin-left:10px" href="http://127.0.0.1/Main/Profile.php?profileName=<?php echo $owner;?>"><?php echo $owner;?></a>
			<div style="margin-left:10px" class="row">
			<?php
				if($loginname != $owner){
					echo "<button >follow</button>";
				}
			?>
			</div>
			</div>
		</div>
		
		
		<div class="col-md-10" style="background-color:#bbb; margin:Auto;">
			<!--Project Content-->
			<?php
				if($loginname != $owner && ($thisStatus=="FUNDED" || $thisStatus=="FULL")){
					echo"<button>rate</button>";
				}
				if ($loginname == $owner && ($thisStatus=="FUNDED" || $thisStatus=="FULL")){
					echo "<button>update a progress</button>";
				}
			?>
			<p>State: <?php echo $thisStatus;?></p>
			<p>FUNDING: <?php echo "$$curAmount/$$minAmount:$$maxAmount";?></p>
			<p><?php echo "FROM: $startDate ----- DUE:$endDate";?></p>
			<figure style="display: block; margin: auto;"><img src="http://127.0.0.1/Images/projectbgTemp.jpg" width="400" height="400"></figure>
			<p><?php echo $thisTags ?></p>
			<!--Template-->
			<?php
				if($loginname != $owner){
					echo "<button onclick=\"location.href='http://127.0.0.1/Main/Pledge.php?pid=<?php echo $pid;?>'\">pledge</button>
						 <button >like</button>";
				}
			?>
			<?php
				echo "<ul class=\"row\" style=\"list-style-type:none\"><!--tag-->
						<li class=\"col-md-1\"><button>jazz</button></li>
						<li class=\"col-md-1\"><button>music</button></li>
						<li class=\"col-md-1\"><button>KFC</button></li>
					</ul>";
			?>
			
			<!--Progress Content-->
		<?php
		$version = '0.0';
		if(mysqli_num_rows($progressList) != 0){
			echo "<p style=\"margin-left:10px\">Progress Now:</p>";
			echo "<ul style=\"list-style-type:disc; margin-left:10px;\"";
			while ($pro = mysqli_fetch_array($progressList)) {
				$version = $pro["version"];
				echo "<li><p>$version</p></li>";
			}
			echo "</ul>";
		}
		?>
		</div>
	</div>
	
	<!--need data to test-->
	<div id="commentList" class="row" style="margin:Auto">
		<!--comment Template-->
		<div style="background-color:#d1e3db;">
			<!--profile images?-->
			<a href="http://127.0.0.1/Main/Profile.php?profileName=AAAAATest" style="font-size: 20px;">AAAAATest</a>
			<p style="padding: 0 10px;">commentcommentcommentcommentcommentcomment...</p>
			<p>mm/dd/yyyy<p>
		</div>
		<div style="background-color:#d1e3db;">
			<!--profile images?-->
			<h1 style="font-size: 20px;">User name</h1>
			<p style="padding: 0 10px;">commentcommentcommentcommentcommentcomment...</p>
			<p>mm/dd/yyyy<p>
		</div>
		<div>
			<p>Comments:</p>
			<?php
			$getComment = mysqli_query($db,"select * from comment where pid=$pid order by version DESC") or die(mysqli_error());
			while ($row = mysqli_fetch_array($getComment)) {
				echo "<div><article><h5>From ".$row['uname'].":</h5><p>For version ".$row['version']."</p><p>".$row['description']."</p><br></article></div>";
			}
			$checkIfPledge = mysqli_query($db,"select * from sponsor where pid=$pid and uname = '$loginname'") or die(mysqli_error());
			$checkIfComment = mysqli_query($db,"select * from comment where pid=$pid and uname = '$loginname' and version = $version") or die(mysqli_error());
			if (mysqli_num_rows($checkIfPledge)>0 and mysqli_num_rows($checkIfComment)==0){
				echo "<div><form action='sendComment.php?version=$version&pid=$pid' method='POST' id = 'commentForm'><textarea style='margin-left:50px' name='description' rows=4' cols='50' placeholder='Leave a Command here:' form='commentForm' required></textarea><input style=\"margin-left:50px\" type=\"submit\" name=\"submit\" value=\"Submit\"></form></div>";
			}
			?>
	</div>
</div>

	
</html>