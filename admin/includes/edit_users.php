<?php

if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id} ";
    $selected_user = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selected_user)) {
        $user_id           = $row['user_id'];
        $user_firstname    = $row['user_firstname'];
        $user_lastname     = $row['user_lastname'];
        $user_role         = $row['user_role'];
        $username          = $row['user_name'];
        $user_email        = $row['user_email'];
        $user_password     = $row['user_password'];
    }
}

if (isset($_POST['edit_user'])) {
    // $user_id = $_GET['edit_user'];
    // echo $_POST['user_id'];

    // $user_id           = $_POST['user_id'];
    $user_firstname    = $_POST['user_firstname'];
    $user_lastname     = $_POST['user_lastname'];
    $user_role         = $_POST['user_role'];

    // $post_image        = $_FILES['image']['name'];
    // $post_image_temp   = $_FILES['image']['tmp_name'];


    $username          = $_POST['username'];
    $user_email        = $_POST['user_email'];
    $user_password     = $_POST['user_password'];
    // $user_date         = date('d-m-y');
    // $post_comment_count = 4;


    // functions for images
    // move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_name = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$user_id} ";

    $edit_user_query = mysqli_query($connection, $query);

    confirmDBQuery($edit_user_query);
}


// $create_user_query = mysqli_query($connection, $query);

// confirmDBQuery($create_user_query);
// 
?>






<form action="" method="post" enctype="multipart/form-data">

    <!-- 
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div> -->
    <div class="form-group">
        <label for="title">First name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <select name="user_role" id="user_role">
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
            if ($user_role == "admin") {
                echo "<option value='subscriber' class=''>subscriber</option>";
            } else if ($user_role == "subscriber")
                echo "<option value='admin'>admin</option>";

            ?>

        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Submit">
    </div>


</form>



<!-- <div class="form-group"> -->

<!-- <label for="title">Post Category Id</label>
        <input value="<?php echo $post_category_id ?>" type="text" class="form-control" name="post_category_id"> -->

<!-- <select name="user_role" id="user_role"> -->

<?php
// Roles of the user
// $query = "SELECT * FROM users ";
// $select_users = mysqli_query($connection, $query);

// confirmDBQuery($select_users);


// while ($row = mysqli_fetch_assoc($select_users)) {
//     $user_id = $row['user_id'];
//     $user_role = $row["user_role"];

//     echo "<option value='{$user_id}'>{$user_role}</option>";
// }


?>

<!-- </select> -->
<!-- </div> -->