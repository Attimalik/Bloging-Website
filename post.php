<?php
include 'includes/db.php';

$id = $_GET['id'];
$cookie_name = "post_viewed_$id";
$cookie_time = 3600; // 1 hour

// Check if the user has already viewed the post recently
if (!isset($_COOKIE[$cookie_name])) {

    // Increment the view count
    $updateViewsSql = "UPDATE posts SET views = views + 1 WHERE id = $id";
    $conn->query($updateViewsSql);

    // Set a cookie to prevent multiple counts
    setcookie($cookie_name, "viewed", time() + $cookie_time, "/");
}

// Fetch the post details
$sql = "SELECT * FROM posts WHERE id = $id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

// Handle comments form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $author_name = $_POST['author_name'];
    $content = $_POST['content'];

    $sql = "INSERT INTO comments (post_id, author_name, content, created_at) VALUES ('$post_id', '$author_name', '$content', NOW())";
    $conn->query($sql);  // Execute the query
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    </style>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <div class="container blog-container mt-5">
        <p><span style="color:grey;">Updated On: </span><?php echo $post['updated_at']; ?></p>
        <h1 class="display-4"><?php echo $post['title']; ?></h1>
        <div class="text-center">
            <img src="<?php echo $post['image_path']; ?>" alt="Blog Image" class="blog-image">
        </div>

        <div class="lead"><?php echo $post['content']; ?></div>
        <a href="#" class="btn btn-primary" name="post_like" onclick="likeIncrement()">Like</a>

        <script>
            function likeIncrement() {
                <?php
                $cookie_like = "post_$id";
                $cookie_time = 3600; // 1 hour

                // Check if the user has already liked the post recently
                if (!isset($_COOKIE[$cookie_like])) {

                    // Increment the like count
                    $updateViewsSql = "UPDATE posts SET post_like = post_like + 1 WHERE id = $id";
                    $conn->query($updateViewsSql);

                    // Set a cookie to prevent multiple likes
                    setcookie($cookie_like, "liked", time() + $cookie_time, "/");
                }
                ?>
            }
        </script>

        <h2 class="mt-5">Comments</h2>
        <form method="post" class="mb-4 col-8">
            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <div class="form-group">
                <label for="author_name">Name:</label>
                <input type="text" class="form-control" id="author_name" name="author_name" required>
            </div>
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>

        <?php
        $sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC";
        $result = $conn->query($sql);

        while ($comment = $result->fetch_assoc()) :
        ?>
            <div class="border-top border-bottom p-3 mb-3 col-6">
                <p><strong><?php echo $comment['author_name']; ?>:</strong> <?php echo $comment['content']; ?></p>
                <small class="text-muted"><?php echo $comment['created_at']; ?></small>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
