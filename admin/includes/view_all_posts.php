<?php

if (isset($_POST["checkBoxArray"]))

    // echo "data received";
    // echo $_POST["checkBoxArray"];

    foreach ($_POST["checkBoxArray"] as $postValueID) {
        // echo $checkBoxValue;
        $bulk_option =  $_POST["bulk_options"];

        switch ($bulk_option) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueID} ";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmDBQuery($update_to_published_status);

                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueID} ";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmDBQuery($update_to_draft_status);

                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueID} ";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirmDBQuery($update_to_delete_status);

                break;


            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueID}' ";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title         = $row["post_title"];
                    $post_category_id   = $row["post_category_id"];
                    $post_date          = $row["post_date"];
                    $post_author        = $row["post_author"];
                    $post_status        = $row["post_status"];
                    $post_image         = $row["post_image"];
                    $post_tags          = $row["post_tags"];
                    $post_content       = $row["post_content"];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

                $copy_query = mysqli_query($connection, $query);
                if (!$copy_query) {
                    die("QUERY FAILED" . mysqli_error(($connection)));
                }

                break;
        }
    }

?>


<form action="" class="" method="post">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionsContainer" style="padding-left: 0px;" class="col-xs-4 red">

            <select name="bulk_options" id="" class="form-control">

                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>



            </select>






        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>


        <thead>
            <tr>
                <th><input type="checkbox" class="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>View Count</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row["post_author"];
                $post_title = $row["post_title"];
                $post_category_id = $row["post_category_id"];
                $post_status = $row["post_status"];
                $post_image = $row["post_image"];
                $post_tags = $row["post_tags"];
                $post_comment_count = $row["post_comments_count"];
                $post_date = $row["post_date"];
                $post_views_count = $row["post_views_count"];

                echo "<tr>";

            ?>

                <td><input class='checkBoxes' type='checkbox' class='' id='select' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>

            <?php
                // echo "<td><input class='checkBoxes' type='checkbox' class='' id='select'></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }

                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}' alt='post image' /></td>";
                echo "<td>{$post_tags}</td>";


                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);
                $count_comments = mysqli_num_rows($send_comment_query);

                $row = mysqli_fetch_array($send_comment_query);
                if(!empty($row)){
                    $comment_id = $row['comment_id'];         
                    echo "<td><a href='./post_comments.php?id=$post_id'>{$count_comments}</a></td>";

                } else {
                    echo "<td>{$count_comments}</td>";
                }

                // $comment_id = $row['comment_id'];
                
                // $count_comments = mysqli_num_rows($send_comment_query);
                // echo "<td><a href='post_comments.php?id=$comment_id'>{$count_comments}</a></td>";

                // echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                // interesting syntax:
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete=$post_id'>Delete</a></td>";

                echo "<td><a href='posts.php?reset=$post_id'> {$post_views_count}</a></td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</form>


<?php
if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $delete_post_id ";
    $delete_query = mysqli_query($connection, $query);

    // refreshing page
    header("Location: posts.php");
}

if (isset($_GET['reset'])) {
    $reset_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id ="  . mysqli_real_escape_string($connection, $reset_post_id) . " ";
    $reset_query = mysqli_query($connection, $query);

    // refreshing page
    header("Location: posts.php");
}
?>