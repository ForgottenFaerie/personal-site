<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
</head>
<body>
    <h1>Add New Post</h1>
    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="50" required></textarea><br><br>
        <input type="submit" name="submit" value="Publish">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $content);
        if ($stmt->execute()) {
            echo "Post published! <a href='index.php'>Go to Blog</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    ?>

    <p>Welcome, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></p>
</body>
</html>
