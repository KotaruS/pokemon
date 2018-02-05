<?php

mb_internal_encoding('UTF-8');

session_start();

define('DSN', 'mysql:host=localhost;dbname=pokedex;charset=utf8;');

define('USERNAME', 'root');

define('PASSWORD', '');
function connection() {
      $db = new PDO(DSN, USERNAME, PASSWORD);
      return $db;
}
?>
