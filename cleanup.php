<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cleanup'])) {
    $uploadDir = __DIR__ . '/upload/';

    // Get all files in the uploads directory
    $files = glob($uploadDir . '*');

    foreach ($files as $file) {
        // Delete the file
        if (is_file($file) && unlink($file)) {
           
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleanup Files</title>
    <script>
        
        setTimeout(function() {
            document.getElementById('cleanupForm').submit();
        }, 120000); // 60000 milliseconds = 1 minute
    </script>
</head>
<body>
    <h1>Cleanup Files</h1>

    <p>Files will be deleted automatically after one minute.</p>
    <form method="post" id="cleanupForm">
        <input type="hidden" name="cleanup" value="1">
    </form>
</body>
</html>
