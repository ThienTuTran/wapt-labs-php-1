<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $users = json_decode(file_get_contents("users.json"), true);
    
    foreach ($users as $id => $user) {
        if ($user['name'] === $username) {
            // Login successful
            header("Location: info.php?user=$id");
            exit;
        }
    }

    echo "<p style='color: red;'>User not found!</p>";
}
?>

<h2>Login</h2>
<form method="POST">
  <input type="text" name="username" placeholder="Enter username" required>
  <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>
