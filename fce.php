<?php
require 'config.php';

function ukazVse() {

$db = connection();
$sql = 'SELECT * FROM pokemon;';
$stmt = $db->prepare($sql);
$stmt->execute();
$pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $pokemons;


/*
foreach ($pokemons as $pokemon) {
  var_dump($pokemon);
  $sql2 = 'SELECT nazev_typu FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
  $stmt2 = $db->prepare($sql2);
  $stmt2->execute([':id' => $pokemon['id']]);
  $type = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  return $pokemon;
  foreach ($type as $onetype) {
    echo $onetype['nazev_typu'];
    //var_dump($onetype);
  return $onetype;
    }
  }
  */
}
?>
