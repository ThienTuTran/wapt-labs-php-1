<?php
$users = json_decode(file_get_contents("users.json"), true);

if (isset($_GET['user'])) {
    $uid = $_GET['user'];

    if (isset($users[$uid])) {
        echo "<h2>Account Info</h2>";
        echo "<p>User ID: $uid</p>";
        echo "<p>Name: " . $users[$uid]['name'] . "</p>";
        echo "<p>Email: " . $users[$uid]['email'] . "</p>";
    } else {
        echo "User not found.";
    }
} else {
    echo "No user specified.";
}
?>

