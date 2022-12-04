<?php

// standard way + env
// $db_user = 'localhost';

// tutor ways of connecting to db
$db["db_host"] = "localhost";
$db["db_user"] = 'root';
$db["db_pass"] = "";
$db["db_name"] = "cms";

// foreach ($db as $key => $value) {
//     define(strtoupper($key), $value);
// }

define("DB_HOST",  "localhost");
define("DB_USER", 'root');
define("DB_PASS", "");
define("DB_NAME", "cms");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// connection
// he said that even in real life scenario it is going to be local host
// easy way - not correct way
// $connection = mysqli_connect("localhost",  "root", "", "cms");

if ($connection) {
    echo "We are connected";
}
    
// formatter is removing it:
// 
