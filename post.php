<?php include "includes/header.php" ?>
<!-- // from here we are getting $connection variable -->
<?php include "includes/db.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<?php include "admin/functions.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">


            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin") {
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published'";
                }


                $select_all_posts_query = mysqli_query($connection, $query);
                if (mysqli_num_rows($select_all_posts_query) < 1) {
                    echo '<h1 class="text-center"> NO POST SORRY </h1>';
                } else {




                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        // reading from the db

                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];

                        // this is such a strange syntax in one way!
            ?>
                        <!-- DYNAMIC PART -> HTML -->
                        <h1 class="page-header">
                            Posts
                        </h1>
                        <!-- dynamic part -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Image of the post">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                        <hr>


                        <!-- CLOSING BRACKET IN PHP -->
                    <?php   }


                    ?>


                    <?php
                    if (isset($_POST["comment_author"])) {
                        // echo $_POST["comment_author"];
                        // so we can use bot at the same time - $_GET - from the URL
                        $the_post_id = $_GET['p_id'];

                        $comment_author = $_POST["comment_author"];
                        $comment_email = $_POST["comment_email"];
                        $comment_content = $_POST["comment_content"];

                        if (!empty($comment_author && !empty($comment_email) && !empty($comment_content))) {
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now()) ";

                            $create_comment_query = mysqli_query($connection, $query);

                            if (!$create_comment_query) {
                                die("Query Failed " . mysqli_error(($connection)));
                            }


                            // $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 ";
                            // $query .= "WHERE post_id = $the_post_id ";
                            // $update_comment_count = mysqli_query($connection, $query);

                            redirect(location: "post.php?p_id=$the_post_id");
                        } else {

                            echo "<script>alert('Fields cannot be empty') </script>";
                            // redirect(location: "post.php?p_id=$the_post_id");
                        }
                        // TODO: where to set it up that it would not give warning?? VIDEO 215
                        // Warning: Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\cms\post.php:63) in C:\xampp\htdocs\cms\admin\functions.php on line 79
                        // redirect(location: "post.php?p_id=$the_post_id");
                    }
                    // redirect(location: "post.php?p_id=$the_post_id");
                    ?>





                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <label for="Author">Author</label>
                                <input type="text" class="form-control" name="comment_author">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" name="comment_email">
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea name="comment_content" class="form-control" name="" id="" rows="3"></textarea>

                            </div>
                            <button class="btn btn-primary" name="create_comment" type="submit">Submit</button>
                        </form>
                    </div>
                    <hr>




                    <!-- comments -->



                    <!-- Comment -->


                    <?php

                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC ";

                    $select_comment_query = mysqli_query($connection, $query);

                    if (!$select_comment_query) {
                        die("Query Failed" . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($select_comment_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                    ?>

                        <!-- Comment -->
                        <div class="media">

                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>


            <?php }
                }
            } else {
                header("Location: index.php");
            } ?>




            <!-- <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
            <!-- Nested Comment -->
            <!-- <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div> -->
            <!-- End Nested Comment -->
            <!-- </div>
            </div> -->





            <!-- First Blog Post -->









            <!-- Pager
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>