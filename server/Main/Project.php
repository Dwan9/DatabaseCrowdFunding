<?php
	//session_id($_GET['sid']);
	session_start();
	$loginname = $_SESSION["username"];
	$pid = $_GET['pid'];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	require_once("../connect.php");

	$thisProject = mysqli_query($db,"select pname, status, tags, curAmount, minAmount, maxAmount, uname, startDate, endDate, description, imagePath
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
	$description = "No content left";
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
				$description = $pro["description"];
				$imageName = $pro["imagePath"];
				}
	if($imageName == ""){
		$imageName = "projectbgTemp.jpg";
	}
	$projectImgPath = "http://127.0.0.1/Images/Project/".$imageName;
	
	$progressList = mysqli_query($db, "select version, description, imagePath
										from progress
										where progress.pid=$pid") or die(mysqli_error());
	//get user protrait:
		$ownerResult = mysqli_query($db,"select uemail, protraitPath from user where uname = '$owner'") or die(mysqli_error());
		while ($e = mysqli_fetch_array($ownerResult)) {
			$ownerProtraitName = $e["protraitPath"];
		}
		if($ownerProtraitName == ""){
			$ownerProtraitName = "bg1.jpg";
		}
		$ownerProtraitPath = "http://127.0.0.1/Images/".$ownerProtraitName;
?>
<html>
<title>Project</title>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="http://127.0.0.1/css/styles.css" rel="stylesheet">
  </head>
	
	<!-- bar -->
	<div style="background-color:#808B96;">
		<div id="navBar" style="background-color:#808B96;">
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
	<div class="row" style="background-color:#ABB2B9;">
		<div class="col-md-2" style="background-color:#808B96;">
			<div >
			<!--user of the project-->
			<figure style="display: block; margin-left:10px">
				<?php 
					echo "<img src=\"$ownerProtraitPath\" width=\"180\" height=\"180\">";
				?>
			</figure>
			<a style="margin-left:10px; font-size:18px; color:black;" 
				href="http://127.0.0.1/Main/Profile.php?profileName=<?php echo $owner;?>"><?php echo $owner;?></a>
			<div style="margin-left:10px" class="row">
			<?php
				if($loginname != $owner){
					echo "<button >follow</button>";
				}
			?>
			</div>
			</div>
		</div>
		
		
		<div class="col-md-10" style="background-color:#ABB2B9; margin:Auto;">
			<!--Project Content-->
			<?php
				if($loginname != $owner && ($thisStatus=="FUNDED" || $thisStatus=="FULL")){
					echo"<button>rate</button>";
				}
				if ($loginname == $owner && ($thisStatus=="FUNDED" || $thisStatus=="FULL")){
					echo "<button onclick=\"location.href='http://127.0.0.1/Main/CreateProgress.php?pid=$pid'\">update a progress</button>";
				}
			?>
			<?php
				//split tags:
				$tagList = explode(" ", $thisTags);
				echo "<p>Tags:   </p>
						<ul class=\"row\" style=\"list-style-type:none\"><!--tag-->";
				foreach ($tagList as $tag){
					echo "<li class=\"col-md-1\"><button 
							onclick=\"location.href='http://127.0.0.1/Main/SearchMain.php?keys=$tag'\">$tag</button>
						</li>";
				}
				echo "</ul>";
			?>
			<p>State: <?php echo $thisStatus;?></p>
			<p>FUNDING:</p>
			<?php
				$ratecur = (float)$curAmount/(float)$maxAmount*100;
				$ratemin = (float)$minAmount/(float)$maxAmount*100 - $ratecur;
				if($ratemin < 0){
					$ratemin = 0;
				}
				$ratemax = 100-$ratemin-$ratecur;
				echo "		<div>
								<div class=\"progress\" style=\"width:200px\">
								<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" style=\"width:$ratecur%\"></div>
								<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" style=\"width:$ratemin%\"></div>
								<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" style=\"width:$ratemax%\"></div>
							</div>";
			?>
			<p><?php echo "$$curAmount/$$minAmount:$$maxAmount";?></p>
			<p><?php echo "FROM: $startDate ----- DUE:$endDate";?></p>
			<figure style="display: block; margin: auto;">
				<?php
					echo "<img src=\"$projectImgPath\" width=\"400\" height=\"400\">";
				?>
			</figure>
			<p><?php echo $description ?></p>
			<p><?php echo $thisTags ?></p>
			<!--Template-->
			<?php
				if(($loginname != $owner)&&($thisStatus != "FULL")&&($thisStatus != "FAIL")){
					echo "<button onclick=\"location.href='http://127.0.0.1/Main/Pledge.php?pid=$pid'\">pledge</button>";
				}
			?>
			<button >like</button>
			
			<!--Progress Content-->
		<?php
		$version = '0.0';
		if(mysqli_num_rows($progressList) != 0){
			echo "<p style=\"margin-left:10px\">Progress Now:</p>";
			echo "<ul style=\"list-style-type:disc; margin-left:10px;\"";
			while ($pro = mysqli_fetch_array($progressList)) {
				$version = $pro["version"];
				$progressdiscription = $pro["description"];
				$imgPath = $pro["imagePath"];
				echo "<li>";
				echo "<p>$version</p>";
				if($imgPath != ""){
					echo "<figure style=\"display: block; margin: auto;\">
						<img src=\"http://127.0.0.1/Images/Project/$imgPath\" width=\"400\" height=\"400\">
					  </figure>";
				}
				echo "<p>$progressdiscription</p>";
				echo "</li>";
			}
			echo "</ul>";
		}
		?>
		</div>
	</div>
	
	<!--need data to test-->
	<div id="commentList" class="row" style="margin:Auto">
		<p>Comments:</p>
		<?php
			$getComment = mysqli_query($db,"select * from comment where pid=$pid order by version DESC") or die(mysqli_error());
			while ($row = mysqli_fetch_array($getComment)) {
				$commentuname = $row['uname'];
				//get user protrait:
				$userResult = mysqli_query($db,"select uemail, protraitPath from user where uname = '$commentuname'") or die(mysqli_error());
				
				while ($e = mysqli_fetch_array($userResult)) {
					$emailValue = $e["uemail"];
					$protraitName = $e["protraitPath"];
				}
				if($protraitName == ""){
					$protraitName = "bg1.jpg";
				}
				$protraitPath = "http://127.0.0.1/Images/".$protraitName;
				
				echo "<div style=\"background-color:#d1e3db;\">
						<figure style=\"display: block; margin:Auto;\">
							<img src=\"$protraitPath\" width=\"40\" height=\"40\">
						</figure>
						<a href=\"http://127.0.0.1/Main/Profile.php?profileName=".$row['uname']."\" style=\"font-size: 20px;\">".$row['uname']."</a>
						<p style=\"padding: 0 10px;\">".$row['description']."</p>
						<p>On Version ".$row['version']."</p>
					</div>";
			}
			$checkIfPledge = mysqli_query($db,"select * from sponsor where pid=$pid and uname = '$loginname'") or die(mysqli_error());
			$checkIfComment = mysqli_query($db,"select * from comment where pid=$pid and uname = '$loginname' and version = $version") or die(mysqli_error());
			if ((mysqli_num_rows($checkIfPledge)>0) && (mysqli_num_rows($checkIfComment)==0)){
				echo "<div><form action='sendComment.php?version=$version&pid=$pid' method='POST' id = 'commentForm'><textarea style='margin-left:50px' name='description' rows=4' cols='50' placeholder='Leave a Command here:' form='commentForm' required></textarea><input style=\"margin-left:50px\" type=\"submit\" name=\"submit\" value=\"Submit\"></form></div>";
			}
		?>
	</div>
</div>

	
</html>