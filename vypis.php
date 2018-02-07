<?php
 require 'config.php';
 include_once 'header.php';
?>
  <title>Pokédex - Your best source of information</title>
  <link rel="stylesheet" type="text/css" href="vyp.css">
<?php
$numba = 0;

      $db = connection();
      $sql = 'SELECT * FROM pokemon;';
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($pokemons);



  ?>
</head>
<body>
<div class="container">



<?php
// vypis v kartickach
foreach ($pokemons as $pokemon) {

if(($pokemon['id']-1) % 4 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) {
 echo "<div class='row'>";
 $numba = $pokemon['id'];
}
?>
<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-0 id-<?php echo $pokemon['id'];?>">
<div class="cardo bg-white rounded">
<a href="#"><span class="btns oi oi-x" title="delete" aria-hidden="true"></span></a>
<a href="#"><span class="btns oi oi-pencil" title="edit" aria-hidden="true"></span></a>
<a href="<?php # TO DO odkaz na pokemona detail ?>">
<img class='mw-100 pictur' src='images/<?php echo $pokemon['obrazek']; ?>' alt='pokemon-<?php echo strtolower($pokemon['nazev']);  ?>'>
</a>
<div class="content p-2 bg-light rounded">
<h4 class="px-2"><?php echo $pokemon['nazev'];?></h4>


  <div class="row m-0">
<?php
  $sql2 = 'SELECT nazev_typu FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
  $stmt2 = $db->prepare($sql2);
  $stmt2->execute([':id' => $pokemon['id']]);
  $type = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  foreach ($type as $onetype) {
    //echo $onetype['nazev_typu'];
    //var_dump($onetype);
    echo "<div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2  text-center p-0 rounded bgcolor-" . strtolower($onetype['nazev_typu']) . "'>" . $onetype['nazev_typu'] . "</div>" ;
  }
//  echo "";
  echo "</div></div></div></div>";
//konec jednotlive karty

  if($pokemon['id'] % 4 == 0) {echo "</div>";}
}
 ?>

  </div>
<?php include_once 'footer.php'; ?>
