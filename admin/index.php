    <?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <?php
        // testing connection <- debugging
        // if ($connection) echo "connection working"



        ?>



        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">



                        <h1 class="page-header">
                            Welcome to admin

                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <!-- <ol class="breadcrumb"> -->
                        <!-- <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li> -->
                        <!-- </ol> -->
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">


                                        <?php
                                        // POST COUNT
                                        // $query = "SELECT * FROM posts";
                                        // $select_all_posts = mysqli_query($connection, $query);

                                        // $post_count = mysqli_num_rows($select_all_posts);

                                        $post_count = recordCount('posts');
                                        echo "<div class='huge'>{$post_count}</div>";


                                        ?>



                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        // COMMENT COUNT
                                        $comments_count = recordCount('comments');
                                        echo "<div class='huge'>{$comments_count}</div>";
                                        ?>


                                        <!-- <div class='huge'>23</div> -->
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        // USERS COUNT
                                        $users_count = recordCount('users');

                                        echo "<div class='huge'>{$users_count}</div>";
                                        ?>



                                        <!-- <div class='huge'>23</div> -->
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        // CATEGORIES COUNT
                                        $categories_count = recordCount("categories");

                                        echo "<div class='huge'>{$categories_count}</div>";
                                        ?>

                                        <!-- <div class='huge'>13</div> -->
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                // $query = "SELECT * FROM posts WHERE post_status = 'published'";
                // $select_all_published_posts = mysqli_query($connection, $query);
                // $post_published_count = mysqli_num_rows($select_all_published_posts);

                $post_published_count = checkStatus('posts', 'post_status', 'published');

                $post_draft_count = checkStatus('posts', 'post_status', 'draft');

                $unapproved_comment_count = checkStatus('comments', 'comment_status', 'unapproved');

                $subscriber_users_count = checkStatus('users', 'user_role', 'subscriber');
                ?>


                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                // so we are inside HTML, then inside javascript, outputting from PHP sub-arrays xD
                                <?php
                                // HTML JS PHP xD ^^
                                $element_text = ['All Posts', "Published Posts", "Draft Posts", "Comments", "Pending Comments", "Users", "Subscribers", "Categories"];
                                $element_count = [$post_count, $post_published_count, $post_draft_count, $comments_count, $unapproved_comment_count, $users_count, $subscriber_users_count, $categories_count,];

                                for ($i = 0; $i < count($element_count); $i++) {
                                    //  :D
                                    echo "['{$element_text[$i]}'" . " ," . "{$element_count[$i]}],";
                                }


                                ?>


                                // ['Posts', 1000]
                            ]);

                            const options = {
                                chart: {
                                    title: 'TITLE',
                                    subtitle: 'SUBTITLE',
                                }
                            };

                            const chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php" ?>