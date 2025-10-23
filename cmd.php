<!DOCTYPE html>
<html>
<head>
  <title>Command Execution Lab</title>
</head>
<body>
  <h2>Ping a Host</h2>
  <form method="GET">
    <input type="text" name="ip" placeholder="Enter IP address">
    <input type="submit" value="Ping">
  </form>

  <pre>
<?php
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    system("ping -c 2 " . $ip);
}
?>
  </pre>
</body>
</html>
