<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html>
<head><title>Post</title></head>
<body>
<?php
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
if ($row = $result->fetch_assoc()) {
    echo "<h1>".$row['title']."</h1>";
    echo "<p>".$row['content']."</p>";
} else {
    echo "Post not found!";
}
?>
</body>
</html>
