<?php
require 'config.php';

if(isset($_GET['delete'])) {
  /* Kontrola existence zvirete */
  $db = connection();
  $sql = 'DELETE FROM pokemon WHERE id = :id';
  $stmt = $db->prepare($sql);
  $idel = $_GET['delete'];
  $stmt->execute([':id' => $idel]);
}
header('Location: vypis.php');

?>
