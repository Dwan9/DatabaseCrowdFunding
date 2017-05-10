<?php

define('DBuser', 'root');
define('DBpassword','1234');
define('DBhost', 'localhost');
define('DBdb', 'crowdfunding');

$db = @mysqli_connect(DBhost, DBuser, DBpassword, DBdb)
or die('Fail to connect to MySQL server. ' . mysqli_connect_error());
// echo "Connection Successful."

