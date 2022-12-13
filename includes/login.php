<?php include "db.php"; ?>

<?php
// creating session by server for us
session_start();
?>

<?php
// catching the post to this page with an attribute "login"
if (isset($_POST["login"])) {
    // echo "FOUND";

    $username =  $_POST["user_name"];
    $password =  $_POST["password"];




    // cleaning sql injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_name = '$username' ";

    $select_user_query = mysqli_query($connection, $query);

    // error handling
    if (!$select_user_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_id             = $row['user_id'];
        $db_user_name      = $row['user_name'];
        $db_user_password  = $row["user_password"];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname  = $row['user_lastname'];
        $db_user_role      = $row['user_role'];
    }

    // simple login without hashing and salting ^^
    if ($username !== $db_user_name && $password !== $db_user_password) {
        header("Location: ../index.php");
    } else if ($username == $db_user_name && $password == $db_user_password) {
        // using sessions
        $_SESSION['username'] = $db_user_name;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }

    // other approach
    // if($username == $db_username && $password == $db_user_password){   
    //     //username and password are correct
    //     header("Location: ../admin");
    // } else {
    //     header("Location: ../index.php");
    // }
}



?>