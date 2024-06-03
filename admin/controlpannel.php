<?php 
include '../includes/db.php';


$sql = "SELECT * FROM `posts` WHERE 1";
$result = $conn->query($sql);

$sqll = "SELECT SUM(views) AS total_views FROM `posts`";
$resultt = $conn->query($sqll);

$sqlll = "SELECT * FROM `comments` WHERE 1";
$resulttt = $conn->query($sqlll);

$sqllll = "SELECT SUM(post_like) AS total_like FROM `posts`";
$resultttt = $conn->query($sqllll);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .control_pannel {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_post.php">
                                Create Post
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h2 style="padding:20px;">Dashboard</h2>
                <div class="container-fluid control_pannel">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Posts</div>
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php
                                          if ($result->num_rows > 0) {
                                           $active_posts = $result->num_rows;
                                            echo $active_posts;
                                         }
                                        ?>
                                    </h1>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Views</div>
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php
                                         if ($resultt && $resultt->num_rows > 0) {
                                            // Fetch the total views
                                            $row = $resultt->fetch_assoc();
                                            $totalViews = $row['total_views'];
                                            
                                            // Print the total views
                                            echo $totalViews;
                                        }
                                        ?>
                                    </h1>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header"> Totall Posts Comment</div>
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php
                                         if ($resulttt->num_rows > 0) {
                                            $totall_views = $resulttt->num_rows;
                                            echo $totall_views;
                                          }
                                        ?>
                                    </h1>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header"> Totall Likes</div>
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php
                                           if ($resultttt->num_rows > 0) {
                                            // Fetch the total views
                                            $row = $resultttt->fetch_assoc();
                                            $totalViews = $row['total_like'];
                                            
                                            // Print the total views
                                            echo $totalViews;
                                        }
                                        ?>
                                    </h1>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>