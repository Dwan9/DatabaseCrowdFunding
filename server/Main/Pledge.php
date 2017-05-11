<?php
	session_start();
	$loginname = $_SESSION["username"];
	if (!isset($loginname)){
		echo "<script>location.href='../index.html';</script>";
	}
	$pid = $_GET['pid'];
	require_once("../connect.php");
		 
	$thisProject = mysqli_query($db,"select pname
									from project
									where pid=$pid") or die(mysqli_error());
	$pname = "this project";
	while ($pro = mysqli_fetch_array($thisProject)) {
		$pname = $pro["pname"];
	}

	$getMaxAmount = mysqli_query($db,"select maxAmount-curAmount as T from project where pid=$pid");
	$maxAmount = 0;
	while ($pro = mysqli_fetch_array($getMaxAmount)) {
		$maxAmount = $pro["T"];
	}
	echo "<script>var maxAmount = $maxAmount; </script>";
?>

<html>
<title>Pay</title>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="http://127.0.0.1/css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="http://127.0.0.1/AntiSqlInject.js"></script>
	<script type="text/javascript">
		function TestAmount(oField, maxValue){
			re= /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
			if ( re.test(oField.value) ){
			alert("Please do not special characters or SQL query!");
			oField.value = "";
			oField.className="errInfo";
			oField.focus();
			return false;}
			var v = oField.value;
			var len = v.length;
			for (var i=0;i<len;i++){
				if(v.charAt(i)>"9"|| v.charAt(i)<"0")
				{
					alert("Please enter a number!");
					oField.value = "";
					oField.focus();
					oField.className="errInfo";
					return false;
				}
			}
			if (v>maxValue)
			{
				alert("Please enter a number within "+maxValue+"!");
				oField.value = "";
				oField.focus();
				oField.className="errInfo";
				return false;
			}
		}
</script>
  </head>
	
	<!-- bar -->
	<div "col-md-12 barContainer" id="barView">
		<div id="navBar">
				<ul>
					<li><button id="Main" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Main.php'">
						<span>Projects</span></button></li>
					<li><button id="profile" class="btn-link" onclick="location.href='http://127.0.0.1/Main/Profile.php'">
						<span><?php echo $loginname?></span></button></li>
					<li><button id="Log_out" class="btn-link" style="float: right;" onclick="location.href='http://127.0.0.1/index.html'">
						<span>Log out</span></button></li>
				</ul>
		</div>
    </div>
	<div style="margin-top:20px">
		<p style="font-size:25px;">Pledge to <?php echo $maxAmount;?></p>
		<form name="login" action="http://127.0.0.1/Main/PledgeConfirm.php?pid=<?php echo $pid;?>" method="post">
		<ul>
			<li><label style="margin-left:50px" for="number">Amount To Pledge?</label>
			<input type="text" name="number" placeholder="required" onblur="TestAmount(this,maxAmount)" required></li>
			<li><label style="margin-left:50px" for="newCreditNum" >Or Other Credict Card</label>
			<input type="text" name="newCreditNum" onblur="AntiSqlInject(this)"></li>
			<li>
			<input style="margin-left:250px" type="submit" name="submit" value="TAKE MY MONEY"></li>
		</ul>
		<a href="http://127.0.0.1/Main/project.php?pid=<?php echo $pid;?>">back</a>
		</form>
	</div>	

	
</html>