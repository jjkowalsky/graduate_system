<?php
session_start();
ob_start();
include("include.php");
require_once("user.class.php");
echo "Session id: {$_SESSION['id']}</br>";
echo "Hello {$_SESSION['username']}</br>";
?>
<a href='logout.php'>logout</a>
</br>
</br>
