<?php
include 'includes/db.php';

// Get the current page number or set it to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; // Number of posts per page
$offset = ($page - 1) * $limit;

// Default category is 'latest'
$category = isset($_GET['category']) ? $_GET['category'] : 'latest';

// Modify the query based on the category
if ($category === 'all') {
    $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
} else {
    $sql = "SELECT * FROM posts WHERE category = '$category' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
}

$result = $conn->query($sql);

// Query to fetch the top 4 blogs with the most views
$relatedBlogsSql = "SELECT * FROM posts ORDER BY views DESC LIMIT 4";
$relatedBlogsResult = $conn->query($relatedBlogsSql);

// Fetch the total number of posts for pagination
if ($category === 'all') {
    $countSql = "SELECT COUNT(*) as total FROM posts";
} else {
    $countSql = "SELECT COUNT(*) as total FROM posts WHERE category = '$category'";
}
$countResult = $conn->query($countSql);
$totalPosts = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
      .col-md-4 {
        margin-bottom: 20px;
      }
    </style>
</head>

<body>

    <?php include './includes/header.php'; ?> 

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="col-md-4" data-category="<?php echo $row['category']; ?>">
                            <div class="card blog-card">
                                <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Blog Image">
                                <div class="card-body">
                                    <h5 class="card-title blog-card-title"><?php echo htmlspecialchars(substr($row['title'], 0, 15)). (strlen($row['title']) > 15 ? '...' : '');?></h5>
                                    <p class="card-text blog-card-text"><?php echo htmlspecialchars(substr($row['content'], 0, 100)); ?></p>
                                    <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="index.php?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>

            <!-- Right Side Related Blogs Menu -->
            <div class="col-md-4">
                <div class="related-blogs">
                    <h5>Related Blogs</h5>
                    <?php while ($relatedRow = $relatedBlogsResult->fetch_assoc()) : ?>
                    <div class="card related-blog-card">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <a href="./post.php?id=<?php echo $relatedRow['id'];?>"><img src="<?php echo $relatedRow['image_path']; ?>" class="card-img" alt="Related Blog Image"></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title related-blog-title"><?php echo htmlspecialchars(substr($relatedRow['title'], 0, 15)). (strlen($relatedRow['title']) > 15 ? '...' : '');?></h5>
                                    <p class="card-text related-blog-text"><?php echo htmlspecialchars(substr($relatedRow['content'], 0, 50)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Social Media Links Container -->
                <div class="social-media-container">
                    <h5 class="mb-3">Follow Us</h5>
                    <a href="" class="social-media-link"><i class="fab fa-facebook-f mr-2"></i> Facebook</a>
                    <a href="" class="social-media-link"><i class="fab fa-twitter mr-2"></i> Twitter</a>
                    <a href="" class="social-media-link"><i class="fab fa-instagram mr-2"></i> Instagram</a>
                    <!-- Add more social media links as needed -->
                </div>
            </div>
        </div>
    </div>
<?php include './includes/footer.php'; ?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get all navigation buttons
        var buttons = document.querySelectorAll(".btn-group .btn");

        // Loop through each button and add a click event listener
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Remove 'active' class from all buttons
                buttons.forEach(function(btn) {
                    btn.classList.remove("active");
                });

                // Add 'active' class to the clicked button
                this.classList.add("active");

                // Get the category associated with the clicked button
                var category = this.getAttribute("data-category");

                // Hide all blog cards
                var blogCards = document.querySelectorAll(".blog-card");
                blogCards.forEach(function(card) {
                    card.style.display = "none";
                });

                // Show blog cards with matching category
                var matchingCards = document.querySelectorAll("[data-category='" + category + "']");
                matchingCards.forEach(function(card) {
                    card.style.display = "block";
                });
            });
        });
    });
    </script>
</body>

</html>
