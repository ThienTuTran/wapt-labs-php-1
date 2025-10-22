<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    if ($username === '') {
        echo "<p style='color: red;'>Username cannot be empty!</p>";
        exit;
    }

    $users = json_decode(file_get_contents("users.json"), true);
    
    // Check if username already exists
    foreach ($users as $id => $user) {
        if ($user['name'] === $username) {
            echo "<p style='color: red;'>Username already taken!</p>";
            exit;
        }
    }

    // Generate unique ID
    $id = rand(1000, 9999);
    $users[$id] = ['name' => $username, 'email' => "$username@example.com"];

    $saved = file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
    if ($saved === false) {
        echo "<p style='color:red;'>Failed to write to file.</p>";
        exit;
    }

    header("Location: index.php");
    exit;
}
?>

<form method="POST">
  <h2>Create Account</h2>
  <input type="text" name="username" placeholder="Enter username" required>
  <input type="submit" value="Register">
</form>
