<?php
session_start();

if (!file_exists('../private/chat'))
    file_put_contents('../private/chat', null);

if ($_SESSION['logged_on_user'] != '')
    echo 'Logged on as [' . $_SESSION['logged_on_user'] . ']' . PHP_EOL;
echo '<div style="padding:20px;">';

if ($_SERVER['PHP_SELF'] != "login.php")
    echo '<a href="login.php">Login</a><br>';
if ($_SERVER['PHP_SELF'] != "create.php")
    echo '<a href="create.php">Register</a><br>';
if ($_SERVER['PHP_SELF'] != "modif.php" && $_SESSION['logged_on_user'] != '')
    echo '<a href="modif.php">Modify</a><br>';
if ($_SERVER['PHP_SELF'] != "logout.php" && $_SESSION['logged_on_user'] != '')
    echo '<a href="logout.php">Logout</a><br>';

echo '</div>';

?>
