<?php
	//session_id($_GET['sid']);
	session_start();
	$loginname = $_SESSION["username"];
	$profileName = $_GET['profileName']; 
	$db = mysqli_connect('localhost','root','1234','crowdfunding')
		  or die('Error connecting to MySQL server.');
	//user information
	$userEmail = mysqli_query($db,"select uemail, protraitPath from user where uname = '$profileName'") or die(mysqli_error());
	$emailValue = "No Email";
	$userDescrib = "This user is lazy, left nothing here.";
	while ($e = mysqli_fetch_array($userEmail)) {
		$emailValue = $e["uemail"];
		$protraitName = $e["protraitPath"];
	}
	if($protraitName == ""){
		$protraitName = "bg1.jpg";
	}
	$protraitPath = "http://127.0.0.1/Images/".$protraitName;
?>
<html>
<title>Profile</title>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="http://127.0.0.1/css/styles.css" rel="stylesheet">

  </head>
	
	<!-- bar -->
	<div "col-md-12 barContainer" id="barView">
		<div id="navBar" style="background-color:#808B96;">
				<ul>
					<li><button id="Main" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Main.php'">
						<span>Projects</span></button></li>
					<li><button id="profile" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Profile.php?profileName=<?php echo $loginname ?>'">
						<span><?php echo $loginname?></span></button></li>
					<li><button id="Log_out" class="btn-link" style="float: right;" onclick="location.href='http://127.0.0.1/logout.php'">
						<span>Log out</span></button></li>
				</ul>
		</div>
    </div>

	<!--Profile Title-->
	<div class="row">
		<!--profile top-->
		<div id="profile_userTitle"><!--need css-->
			<div>
				<!--images?-->
				<div class="col-md-2">
					<figure style="display: block; margin:Auto;">
					<?php
						echo "<img src=\"$protraitPath\" width=\"180\" height=\"180\">";
					?>	
					</figure>
					<h1 style="font-size:20px; margin-top:5px;"><?php echo $profileName ?></h1>
					<?php
						if($loginname == $profileName){
						echo "<a href=\"http://127.0.0.1/Main/EditProfile.php\" style=\"font-size: 15px;\">Edit My Profile</a>";
						}
					?>
				</div>
				<small class="col-md-2" style="margin-top:200px;">Content: <?php echo $emailValue ?></small>
				<p class="col-md-2" style="margin-top:50px;"><?php $userDescrib ?></p>
				<?php
					if($loginname == $profileName){
						echo "<a href=\"http://127.0.0.1/Main/CreateProject.php\" style=\"font-size: 15px;\">Create New Project</a>";
					}
				?>
			</div>
			
		</div>

		<!--Profile detail-->
	</div>
	
	<?php
		//project list as owner		
		$searchProject = "select pid, pname, status, tags, imagePath from project where uname = '$profileName'";
		$ownProject =  mysqli_query($db,$searchProject) or die(mysqli_error());
		if(mysqli_num_rows($ownProject) != 0){
			echo "<p style=\"padding-top:20px; background-color:#ABB2B9;\">As Owner</p>";
			echo "<div class=\"row\">";
			while ($pro = mysqli_fetch_array($ownProject)) {
				$pid = $pro["pid"];
				$pname = $pro["pname"];
				$tags = $pro["tags"];
				$status = $pro["status"];
				$imageName = $pro["imagePath"];
				if($imageName == ""){
					$imageName = "projectbgTemp.jpg";
				}
				$imageName = "http://127.0.0.1/Images/Project/" .$imageName;
				echo "<div class=\"col-md-3\" id=\"projectView\" style=\"position:relative width=200px height=400px;\">
					  <div id=\"briefProject\">
						<figure><img src=\"$imageName\" width=\"200\" height=\"200\"></figure>
						<h1 style=\"font-size:18px;\">$pname</h1>
						<p>Current Status: $status</p>
						<p>$tags</p>
					  </div>
					<div id=\"detail\">
					<button onclick=\"location.href='http://127.0.0.1/Main/project.php?pid=$pid'\">Detail</button>
					</div>
					</div>";
			}
			echo "</div>";
		}
		//sponsor
		$searchProject = "select project.pid, project.pname, status, tags , imagePath
							from project, sponsor
							where sponsor.pid = project.pid and sponsor.uname = '$profileName';";
		$sponsorProject = mysqli_query($db,$searchProject) or die(mysqli_error());
		if(mysqli_num_rows($sponsorProject) != 0){
			echo "<p style=\"padding-top:20px; background-color:#ABB2B9;\">As Sponsor</p>";
			echo "<div class=\"row\">";
			while ($pro = mysqli_fetch_array($sponsorProject)) {
				$pid = $pro["pid"];
				$pname = $pro["pname"];
				$tags = $pro["tags"];
				$status = $pro["status"];
				$imageName = $pro["imagePath"];
				if($imageName == ""){
					$imageName = "projectbgTemp.jpg";
				}
				$imageName = "http://127.0.0.1/Images/Project/" .$imageName;
				echo "<div class=\"col-md-3\" id=\"projectView\" style=\"position:relative width=200px height=400px;\">
					  <div id=\"briefProject\">
						<figure><img src=\"$imageName\" width=\"200\" height=\"200\"></figure>
						<h1 style=\"font-size:18px;\">$pname</h1>
						<p>Current Status: $status</p>
						<p>$tags</p>
					  </div>
					<div id=\"detail\">
					<button onclick=\"location.href='http://127.0.0.1/Main/project.php?pid=$pid'\">Detail</button>
					</div>
					</div>";
			}
			echo "</div>";
		}
		//likes
		$searchProject = "select project.pid, project.pname, status, tags , imagePath
							from likes, project
							where likes.uname = '$profileName' and likes.pid = project.pid;";
		$likeProject = mysqli_query($db,$searchProject) or die(mysqli_error());
		if(mysqli_num_rows($likeProject) != 0){
			echo "<p style=\"padding-top:20px; background-color:#ABB2B9;\">I Like</p>";
			echo "<div class=\"row\">";
			while ($pro = mysqli_fetch_array($likeProject)) {
				$pid = $pro["pid"];
				$pname = $pro["pname"];
				$tags = $pro["tags"];
				$status = $pro["status"];
				$imageName = $pro["imagePath"];
				if($imageName == ""){
					$imageName = "projectbgTemp.jpg";
				}
				$imageName = "http://127.0.0.1/Images/Project/" .$imageName;
				echo "<div class=\"col-md-3\" id=\"projectView\" style=\"position:relative width=200px height=400px;\">
					  <div id=\"briefProject\">
						<figure><img src=\"$imageName\" width=\"200\" height=\"200\"></figure>
						<h1 style=\"font-size:18px;\">$pname</h1>
						<p>Current Status: $status</p>
						<p>$tags</p>
					  </div>
					<div id=\"detail\">
					<button onclick=\"location.href='http://127.0.0.1/Main/project.php?pid=$pid'\">Detail</button>
					</div>
					</div>";
			}
			echo "</div>";
		}
		//follow
		
		
	?>
	
</html>