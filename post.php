<?php
include 'config.php'; // DB connection from .env

// Provide a minimal formatPost if not defined elsewhere
if (!function_exists('formatPost')) {
    function formatPost($content) {
        $safe = htmlspecialchars($content ?? '');
        // break on double newlines into paragraphs
        $parts = preg_split('/\r?\n{2,}/', $safe);
        $out = '';
        foreach ($parts as $p) {
            $out .= '<p>' . nl2br(trim($p)) . '</p>';
        }
        return $out;
    }
}

$row = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
        }
        $stmt->close();
    }
} else {
    http_response_code(400);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Post</title>
    <meta charset="utf-8">
</head>
<body>
    <a href="blog.php">← Back to Blog</a>
    <hr>
    <?php if (!$row): ?>
        <p>Post not found.</p>
    <?php else: ?>
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <?php echo formatPost($row['content']); ?>
        <small>Posted on <?php echo htmlspecialchars($row['created_at']); ?></small>

        <?php if (!empty($row['media'])):
            $ext = strtolower(pathinfo($row['media'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','gif'])): ?>
                <div><img src="<?php echo htmlspecialchars($row['media']); ?>" alt="Post Media" style="max-width:400px;"></div>
            <?php elseif ($ext === 'mp4'): ?>
                <div>
                    <video controls width="400">
                        <source src="<?php echo htmlspecialchars($row['media']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
