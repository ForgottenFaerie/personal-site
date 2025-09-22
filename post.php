<?php
include 'config.php'; // DB connection from .env

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
        echo formatPost($row['content']);
        echo "<small>Posted on " . $row['created_at'] . "</small>";
    } else {
        http_response_code(404);
        echo "Post not found.";
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo "Invalid request.";
}
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Post</title>
</head>
<body>
    <a href="blog.php">← Back to Blog</a>
    <hr>
    <?php
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo "<h1>".$row['title']."</h1>";
            echo formatPost($row['content']);
            echo "<small>Posted on ".$row['created_at']."</small>";
        } else {
            echo "Post not found.";
        }
    }

    if (!empty($row['media'])) {
    $ext = pathinfo($row['media'], PATHINFO_EXTENSION);
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<img src='".$row['media']."' alt='Post Media' style='max-width:400px;'><br>";
    } elseif ($ext == 'mp4') {
        echo "<video controls width='400'>
                <source src='".$row['media']."' type='video/mp4'>
              Your browser does not support the video tag.
              </video><br>";
        }
    }
    ?>
</body>
</html>
