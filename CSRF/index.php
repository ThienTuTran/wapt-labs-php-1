<?php
session_start();

// Load users from file
function loadUsers() {
    $file = "users.json";
    if (!file_exists($file)) {
        return [];
    }
    return json_decode(file_get_contents($file), true);
}

// Save users to file
function saveUsers($users) {
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
}

$users = loadUsers();

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user exists and password matches
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION["username"] = $username;
    } else {
        echo "<p style='color: red;'>Invalid username or password!</p>";
    }
}

// Handle password change (VULNERABLE TO CSRF)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["new_password"])) {
    if (!isset($_SESSION["username"])) {
        echo "<p style='color: red;'>You must be logged in to change your password!</p>";
    } else {
        $users[$_SESSION["username"]] = $_POST["new_password"];
        saveUsers($users);
        echo "<p style='color: green;'>Password changed successfully!</p>";
    }
}

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Change Password</title>
</head>
<body>

<?php if (!isset($_SESSION["username"])): ?>
    <h2>Login</h2>
    <form method="POST" action="index.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
<?php else: ?>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
    <a href="index.php?logout=true">Logout</a>

    <h2>Change Your Password</h2>
    <form method="POST" action="index.php">
        <label>New Password:</label>
        <input type="text" name="new_password" required>
        <button type="submit">Change Password</button>
    </form>
<?php endif; ?>

</body>
</html>
