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
<style> 
body,div,ul,li,p{margin:0;padding:0;}
body{color:#666;font:12px/1.5 Arial;}
ul{list-style-type:none;}
#star{position:relative;width:600px;margin:10px auto;}
#star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
#star ul{margin:0 10px;}
#star li{float:left;width:30px;height:29px;cursor:pointer;text-indent:-9999px;background:url(../images/star.gif) no-repeat;}
#star strong{color:#f60;padding-left:10px;}
#star li.on{background-position:0 -28px;}
#star p{position:absolute;top:20px;width:159px;height:60px;display:none; no-repeat;padding:10px 1px 0;}
#star p em{color:#f60;display:block;font-style:normal;}
</style>
<script type="text/javascript"> 
window.onload = function ()
{
 var oStar = document.getElementById("star");
 var aLi = oStar.getElementsByTagName("li");
 var oUl = oStar.getElementsByTagName("ul")[0];
 var oSpan = oStar.getElementsByTagName("span")[1];
 var oP = oStar.getElementsByTagName("p")[0];
 var i = iScore = iStar = 0;
 var aMsg = [
    "Very dissatisfied|This project is a waste of money.",
    "Dissatisfied|The project did not come out as expected.",
    "So-so|Mediocrely carried out project.",
    "Satisfied|The project came out as expected.",
    "Very satisfied|Impressive project."
    ]
 for (i = 1; i <= aLi.length; i++)
 {
  aLi[i - 1].index = i;
  //鼠标移过显示分数
  aLi[i - 1].onmouseover = function ()
  {
   fnPoint(this.index);
   //浮动层显示
   oP.style.display = "block";
   //计算浮动层位置
   oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
   //匹配浮动层文字内容
   oP.innerHTML = "<em><b>" + this.index + "</b>  " + aMsg[this.index - 1].match(/(.+)\|/)[1] + "</em>" + aMsg[this.index - 1].match(/\|(.+)/)[1]
  };
  //鼠标离开后恢复上次评分
  aLi[i - 1].onmouseout = function ()
  {
   fnPoint();
   //关闭浮动层
   oP.style.display = "none"
  };
  //点击后进行评分处理
  aLi[i - 1].onclick = function ()
  {
   iStar = this.index;
   document.getElementById("mark").value = iStar;
   document.getElementById('rateSubmit').disabled=false;
   oP.style.display = "none";
   oSpan.innerHTML = "<strong>" + (this.index) + " </strong> (" + aMsg[this.index - 1].match(/\|(.+)/)[1] + ")"
  }
 }
 //评分处理
 function fnPoint(iArg)
 {
  //分数赋值
  iScore = iArg || iStar;
  for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";
 }
};
</script>
	
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
					$isFollower = mysqli_query($db, "select * from follower where uname = '$owner' and funame = '$loginname'");
					if (mysqli_num_rows($isFollower)==0) {
						echo "<button onclick=\"location.href='Follow.php?uname=$owner&f=0&pid=$pid'\">Follow</button>";
					}
					else{
						echo "<button onclick=\"location.href='http://127.0.0.1/Main/Follow.php?uname=$owner&f=1&pid=$pid'\">Unfollow</button>";
					}
				}
			?>
			</div>
			</div>
		</div>
		
		
		<div class="col-md-10" style="background-color:#ABB2B9; margin:Auto;">
			<!--Project Content-->
			<?php
				if($loginname != $owner && ($thisStatus=="FUNDED" || $thisStatus=="FULL")){
					echo"<div id=\"star\"><span>Rate here</span><ul>
 <li><a href=\"javascript:;\">1</a></li>
 <li><a href=\"javascript:;\">2</a></li>
 <li><a href=\"javascript:;\">3</a></li>
 <li><a href=\"javascript:;\">4</a></li>
 <li><a href=\"javascript:;\">5</a></li>
 </ul><span></span><p></p></div>
<form method=\"POST\" action=\"http://127.0.0.1/Main/Rate.php?pid=$pid\">
<input type=\"hidden\" name=\"mark\" value='0' id=\"mark\">
<input type=\"submit\" name=\"submit\" value=\"Rate\" id=\"rateSubmit\" disabled=\"true\"></form>";
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
			<?php
			if($loginname != $owner){
					$isLiker = mysqli_query($db, "select * from likes where pid = $pid and uname = '$loginname'");
					if (mysqli_num_rows($isLiker)==0) {
						echo "<button onclick=\"location.href='Like.php?l=0&pid=$pid'\">Like</button>";
					}
					else{
						echo "<button onclick=\"location.href='Like.php?l=1&pid=$pid'\">Unlike</button>";
					}
				}
			?>
			
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