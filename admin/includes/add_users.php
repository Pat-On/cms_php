<?php
if (isset($_POST['create_user'])) {

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


    // query step
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role,
    user_name, user_email, user_password) ";

    $query .= "VALUES( '{$user_firstname}', '{$user_lastname}',
    '{$user_role}', '{$username}', '{$user_email}','{$user_password}' ) ";



    $create_user_query = mysqli_query($connection, $query);

    confirmDBQuery($create_user_query);

    // confirming creation of user
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
}
?>






<form action="" method="post" enctype="multipart/form-data">

    <!-- 
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div> -->
    <div class="form-group">
        <label for="title">First name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <select name="user_role" id="user_role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber" class="">Subscriber</option>

        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
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