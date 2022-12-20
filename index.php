<?php include "includes/header.php" ?>
<!-- // from here we are getting $connection variable -->
<?php include "includes/db.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md-8">


            <?php
            $per_page = 5;

            if (isset($_GET["page"])) {

                $page = $_GET["page"];
            } else {
                $page = "";
            }

            $select_post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($connection, $select_post_query_count);
            $count = mysqli_num_rows($find_count);

            $count = ceil($count / $per_page);

            if ($page === "" || $page === 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - 5;
            }


            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page ";
            $select_all_posts_query = mysqli_query($connection, $query);



            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                // reading from the db
                $post_id = $row['post_id'];
                $post_title = $row["post_title"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = substr($row["post_content"], 0, 100);

                $post_status = $row["post_status"];


                // it is not clever way of doing it ^^
                // if ($post_status !== 'published') {
                // better solution




                // this is such a strange syntax in one way!
            ?>
                <!-- DYNAMIC PART -> HTML -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- dynamic part -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>" class="">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Image of the post">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


                <!-- CLOSING BRACKET IN PHP -->
            <?php  }

            if (mysqli_num_rows($select_all_posts_query) == 0) {
                echo '<h1> NO POST SORRY </h1>';
            }
            ?>








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

    <ul class="pager">

        <?php
        for ($i = 1; $i <= $count; $i++) {

            // sending query to index.php
            if ($i == $page) {
                echo "<li ><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>

    </ul>

    <hr>

    <?php include "includes/footer.php" ?>