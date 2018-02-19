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
if(isset($_GET['trainerdel'])) {
  /* Kontrola existence zvirete */
  $db = connection();
  $sql = 'DELETE FROM clovek WHERE id = :id';
  $stmt = $db->prepare($sql);
  $idet = $_GET['trainerdel'];
  $stmt->execute([':id' => $idet]);
}
header('Location: vypis.php');

?>
