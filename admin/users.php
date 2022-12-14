<?php include "includes/admin_header.php" ?>

<?php 

    if(!is_admin($_SESSION['username'])){
        header("Location: index.php");
    }




?>

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

                        // conditional rendering of pages in PHP - routing
                        switch($source) {
                            case "add_user";
                            include "includes/add_users.php";
                            break;

                            case "edit_user";
                            include "includes/edit_users.php";
                            break;

                            default;

                            include "includes/view_all_users.php";

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