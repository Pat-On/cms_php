<!-- he brought connection to header because he want to have it accessible in all php files -->
<?php
// it is buffering request in our headers - redirection - explained later in details
ob_start();
?>

<?php
// we used header to turn on sessions because by this
// it is going to be accessible everywhere in admin part
session_start();
?>

<?php include "../includes/db.php" ?>
<?php include_once "functions.php"; ?>


<?php
// temporary solution without checking type of the user ahm ^^
if (!isset($_SESSION['user_role'])) {

    // if($_SESSION['user_role'] !== 'admin'){
    header("Location: ../index.php");
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- summernote -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <!-- local summernote -->
    <link rel="stylesheet" href="css/summernote.css" class="">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">

    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <!-- <div id='load-screen'>
        <div id='loading'></div>
    </div> -->