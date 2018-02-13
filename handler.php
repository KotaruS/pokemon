<?php

$current = $_GET['theme'];
switch ($current) {
  case 'dark':
    setcookie('theme', 'light', time() + (86400 * 365 * 3), "/");
    break;

  case 'light':
    setcookie('theme', 'dark', time() + (86400 * 365 * 3), "/");
    break;
}
header('Location: vypis.php');
?>
