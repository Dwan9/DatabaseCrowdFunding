<?php
session_start();
session_destroy();
unset($_SESSION);
echo "<script>location.href='index.html';</script>";
?>
