<?php


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

function confirmDBQuery($queryResult) {
    global $connection;
    if(!$queryResult) {
        die("QUERY FAILEDn  " . mysqli_error($connection));
    }
}
