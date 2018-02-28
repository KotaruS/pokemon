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
if (isset($_GET['pokemon'])&& isset($_GET['trainer'])) {
  $db = connection();
  $sql = 'DELETE FROM pokemon_clovek WHERE pokemon_id = :pokemon_id AND clovek_id = :clovek_id';
  $stmt = $db->prepare($sql);
  $stmt->execute([':pokemon_id' => $_GET['pokemon']],
                  ':clovek_id' => $_GET['trainer']);
}
header('Location: vypis.php');

?>
