<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
</head>
<body>
<h1>Blog Posts</h1>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<h2><a href='post.php?id=".$row['id']."'>".$row['title']."</a></h2>";
    echo "<p>".substr($row['content'],0,200)."...</p>";
}
?>
</body>
</html>
