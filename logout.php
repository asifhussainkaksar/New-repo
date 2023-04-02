<?php
session_start();
// Unset all of the session variables
$_SESSION=array();
//Destory the session
session_destroy();
//Redirect to the login page
header("Location:form.php");
exit();
?>