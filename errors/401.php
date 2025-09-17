<?php
http_response_code(401);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>401 Unauthorized</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        h1 { font-size: 3em; color: #d35400; }
    </style>
</head>
<body>
    <h1>401</h1>
    <p>You must be logged in to view this page.</p>
    <a href="/login.php">Login Here</a>
</body>
</html>
