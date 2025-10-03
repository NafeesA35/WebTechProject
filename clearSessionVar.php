<?php
session_start();
unset($_SESSION['title']);
unset($_SESSION['content']);

header('Location: addEntry.php');
exit;
?>