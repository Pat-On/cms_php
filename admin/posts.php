<?php include "includes/admin_header.php" ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        POSTS
                        <small>Author</small>
                    </h1>

                    <?php
                        if(isset($_GET['source'])){
                            // http://localhost/cms/admin/posts.php?source=34 <- from this
                            $source = $_GET["source"];
                        } else {
                            // you need create else case to assign some value to variable - no error then
                            $source = "";
                        }

                        // conditional rendering of pages in PHP
                        switch($source) {
                            case "add_post";
                            include "includes/add_posts.php";
                            break;

                            case "edit_post";
                            include "includes/edit_post.php";
                            break;

                            default;

                            include "includes/view_all_posts.php";

                            break;
                        }

                    ?>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>