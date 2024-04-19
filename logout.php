<?php
session_start();
// remove all session variables
unset($_SESSION['username']);
session_unset();

// destroy the session
session_destroy();

header("location: sign-in.php");

?>