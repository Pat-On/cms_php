<?php
// creating session by server for us
session_start();
?>

<?php
// using sessions - canceling it
$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");
?>