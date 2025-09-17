<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="title" content="Blog. | The NBS">
    <meta name="description" content="Welcome to The NBS Blog! Nonbinarybyte's personal website's blog. This blog is home to any updates I have for people that like what I do. Follow along for the ride & Have fun!!">
    <meta name="keywords" content="nonbinarybyte, LGBT, LGBTQIA, LGBTQ, software engineer, software, developer, dev, code, coding, personal, personal site, personal website, homepage, home, home page, Blog, Blogs, Blogging, Blogger, Vlog, Vlogger, Vlogging, Vloggers">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
</head>
<body>
        <header>
            <h1>My Blog</h1>
            <a href="add_post.php">Add New Post</a>
        </header>
        <div class="content">
                    <hr />
                <?php
                    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
                    while ($row = $result->fetch_assoc()) {
                        echo "<h2><a href='post.php?id=".$row['id']."'>".$row['title']."</a></h2>";
                        echo "<p>".substr($row['content'], 0, 200)."...</p>";
                        echo "<small>Posted on ".$row['created_at']."</small><hr />";
                    }
                ?>
            </div>
</body>
</html>
