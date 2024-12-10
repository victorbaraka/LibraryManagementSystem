<?php
session_start();
session_destroy();
header("Location: lmslogin.php");
exit();
?>