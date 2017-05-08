<?php

define('mpuser', 'customer');
define('mppassword','1');
define('mphost', 'localhost');
define('mpdb', 'marketplace');

$connection = @mysqli_connect(mphost, mpuser, mppassword, mpdb)
or die('Fail to connect to MySQL. ' . mysqli_connect_error());
// echo "Connection Successful."
?>
