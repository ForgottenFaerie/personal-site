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
    <form method="post" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="50" required></textarea><br><br>

        <label>Upload Media (Image, GIF, or MP4 Video):</label><br>
        <input type="file" name="media"><br><br>

        <input type="submit" name="submit" value="Publish">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $mediaPath = null;

        // Handle file upload if exists
        if (!empty($_FILES['media']['name'])) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // create uploads folder if missing
            }

            $fileName = time() . "_" . basename($_FILES['media']['name']);
            $targetFile = $targetDir . $fileName;

            // Allowed file types
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4'];
            if (in_array($_FILES['media']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
                    $mediaPath = $targetFile;
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Only JPG, PNG, GIF, and MP4 files are allowed.";
            }
        }

        // Insert post
        $stmt = $conn->prepare("INSERT INTO posts (title, content, media) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $mediaPath);
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
