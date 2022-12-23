<?php

function checkStatus($table, $column, $status ){
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);

    confirmDBQuery($result);

    return mysqli_num_rows($result);

}



function recordCount($table)
{
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);

    confirmDBQuery($result);

    return $result;
}


// TODO: implement it into the project
function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


function users_online()
{
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {

            session_start();

            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {

                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            } else {

                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } // get request isset()
    else {
        // changing the $connection variable to the global scope
        global $connection;

        $session = session_id(); // it will have id of all users logged in (id of session)
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', $time) ");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session' ");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");
        return $count_user = mysqli_num_rows($users_online_query);
    }
}

users_online();

function insert_categories()
{
    // changing the $connection variable to the global scope
    global $connection;

    if (isset($_POST["submit"])) {
        // echo "<h1> WORKING <h1/>"; // testing
        $cat_title = $_POST["cat_title"];

        // simple validation in PHP
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            // constructing query
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            // sending query
            $create_category_query = mysqli_query($connection, $query);

            // if failed
            if (!$create_category_query) {
                // killing script
                die('QUERY FAILED' . mysqli_error(($connection)));
            }
        }
    }
}

function findAllCategories()
{

    // changing the $connection variable to the global scope
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);

        // sending user - like refresh
        // without it we need to refresh page manually or click delete twice
        header("Location: categories.php");
    }
}

function confirmDBQuery($queryResult)
{
    global $connection;
    if (!$queryResult) {
        die("QUERY FAILEDn  " . mysqli_error($connection));
    }
}

function redirect($location)
{
    return header("Location: " . $location);
}

function is_admin($username = '') {
    global $connection;

    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);

    confirmDBQuery($result);

    $row = mysqli_fetch_array($result);

    if($row['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }
}