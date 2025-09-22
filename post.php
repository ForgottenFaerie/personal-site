<?php
include 'config.php'; // loads env + DB connection
?>


<?php include 'db.php'; ?>

<?php
function makeLinksClickable($text) {
    return preg_replace(
        '/(https?:\/\/[^\s]+)/',
        '<a href="$1" target="_blank">$1</a>',
        $text
    );
}

function sanitizeContent($text) {
    // Allow only these tags
    return strip_tags($text, '<b><i><strong><em><a><br>');
}

function parseCodeBlocks($text) {
    // Replace ```code``` with <pre><code>code</code></pre>
    return preg_replace_callback('/```(.*?)```/s', function($matches) {
        // Escape inside code block to prevent HTML execution
        $code = htmlspecialchars($matches[1], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        return "<pre><code>$code</code></pre>";
    }, $text);
}

function formatPost($text) {
    // Step 1: Sanitize (allow basic tags only)
    $text = sanitizeContent($text);

    // Step 2: Convert code blocks first (so links inside code don't become clickable)
    $text = parseCodeBlocks($text);

    // Step 3: Auto-link URLs
    $text = makeLinksClickable($text);

    return nl2br($text); // keep line breaks
}

?>

<?php
// Get slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Fetch post by slug
$stmt = $conn->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
    echo "<h1>" . htmlspecialchars($post['title']) . "</h1>";
    echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
} else {
    http_response_code(404);
    include 'errors/404.php';
    exit();
}

$stmt->close();
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
