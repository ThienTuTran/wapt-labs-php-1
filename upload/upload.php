<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //print_r($_FILES);
    //echo "</pre>";

    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "File uploaded successfully: <a href='$uploadFile'>$uploadFile</a>";
        } else {
            echo "Upload failed.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Insecure File Upload</title></head>
<body>
<h2>Upload a File</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>

