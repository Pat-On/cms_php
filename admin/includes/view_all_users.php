<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <!-- <th>Date</th> -->
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $user_name = $row["user_name"];
            // $comment_author = $row["user"];
            // we are bringing password here but we are going to use it only internally
            $user_password = $row["user_password"];

            $user_firstname = $row["user_firstname"];
            $user_lastname = $row["user_lastname"];
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
            $user_role = $row["user_role"];
            $randSalt = $row["randSalt"];


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";

            

            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
            // $select_categories_id = mysqli_query($connection, $query);

            // while ($row = mysqli_fetch_assoc($select_categories_id)) {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['cat_title'];
            //     echo "<td>{$cat_title}</td>";
            // }


            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_post_id_query = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($select_post_id_query)){
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];

            //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }

            // echo "<td>{$comment_date}</td>";


            echo "<td><a href='comments.php?approve=$'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$'>Unapprove</a></td>";

            // echo "<td><a href='posts.php?source=edit_post&p_id='>Edit</a></td>";
            echo "<td><a href='comments.php?delete=$'>Delete</a></td>";

            echo "</tr>";
        }
        ?>

    </tbody>
</table>

<?php
// delete comment
if (isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id ";
    $delete_query = mysqli_query($connection, $query);


    // reloading
    header("Location: comments.php");
}


if (isset($_GET['unapprove'])) {
    $unapprove_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unnaproved' WHERE comment_id = $unapprove_comment_id ";
    $update_query = mysqli_query($connection, $query);


    // reloading
    header("Location: comments.php");
}


if (isset($_GET['approve'])) {
    $approve_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id ";
    $update_query = mysqli_query($connection, $query);


    // reloading
    header("Location: comments.php");
}
?>