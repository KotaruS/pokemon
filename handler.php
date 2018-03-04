<?php

$current = $_GET['theme'];
switch ($current) {
  case 'dark':
    setcookie('theme', 'light', time() + (86400 * 365 * 3), "/");
    break;

  case 'light':
    setcookie('theme', 'dark', time() + (86400 * 365 * 3), "/");

}
if (isset($_GET['theme'])) {
  header('Location:' . $_SERVER['HTTP_REFERER']);
}
if (isset($_GET['limitoff'])) {
  header('Location:' . $_SERVER['HTTP_REFERER'] . '&limitoff=' . $_GET['limitoff']);
}

?>
