<?php
http_response_code(429);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>429 Too Many Requests</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        h1 { font-size: 3em; color: #27ae60; }
    </style>
</head>
<body>
    <h1>429</h1>
    <p>Whoa there! You’re making too many requests. Please slow down.</p>
    <a href="/">Return to Home</a>
</body>
</html>
