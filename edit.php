
<?php
require 'config.php';
include_once 'header.php';
?>
<link rel="stylesheet" type="text/css" href="vyp.css">
<link rel="stylesheet" type="text/css" href="ed.css">
<title>Choose your pokemons!</title>
<?php
$gettrainer = filter_input(INPUT_GET,'trainer',FILTER_VALIDATE_INT);
$db = connection();
if(empty($gettrainer)){
 header('Location: 404.php');
}
$sql5 = 'SELECT * FROM pokemon WHERE id NOT IN (SELECT pokemon_id FROM pokemon_clovek WHERE clovek_id = :id);';
$stmt = $db->prepare($sql5);
$stmt->execute([':id' => $gettrainer]);
$pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
// if (isset($_POST['submit'])) {
//
//   SELECT * FROM pokemon
// LEFT JOIN pokemon_clovek ON pokemon.id = pokemon_clovek.pokemon_id
//SELECT * FROM pokemon WHERE id NOT IN (SELECT pokemon_id FROM pokemon_clovek WHERE clovek_id = 3)
// WHERE pokemon_clovek.clovek_id <> 3 OR pokemon_clovek.clovek_id IS NULL

#zpracovani

$values = '';
if (isset($_POST['subm']) && isset($_POST['poke'])) {
  $pokes = $_POST['poke'];
  foreach ($pokes as $poke) {
    $carka = (($counter+1) == count($pokes)) ? '' : ',';
    $values .= '('. $poke . ',' . $gettrainer . ')'. $carka;
    $counter++;
  }
  $sqlb = 'INSERT INTO pokemon_clovek (pokemon_id, clovek_id)
  VALUES' . $values .';';
  $stmta = $db->prepare($sqlb);
  $stmta->execute();
  header('Location: trainer.php?trainer=' . $gettrainer);
}
$counter = 0;
?>
</head>
<body>

    <!-- tmavy/svetly vzhled toggle -->
  <a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>

  <div class="container ">
    <a href="trainer.php?trainer=<?php echo $gettrainer;?>"><button type="button" class="btn btn-accent my-1" name="button"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
    <h1 class="color-main">Choose pokemons:</h1>
    <form action="" method="post">



<?php
#vypis
foreach ($pokemons as $pokemon) {
  ?>

  <?php
if($counter % 4 == 0) {
 echo "<div class='row'>";
}
?>
<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 id-<?php echo $pokemon['id'];?>" >
<label class="label">
<input type="checkbox" name="poke[]" class="d-none" value="<?php echo $pokemon['id'];?>">
<span class="check oi oi-check "  aria-hidden="true"></span>
<div class="cardo bg-main">
<img class='mw-100 pictur' src='images/<?php echo $pokemon['obrazek']; ?>' alt='pokemon-<?php echo strtolower($pokemon['nazev']);  ?>'>

<div class="content px-2 py-3 bg-accent">
<h4 class="px-2 color-accent"><?php echo $pokemon['nazev'];?></h4>


  <div class="row m-0">
<?php
  $sql1 = 'SELECT nazev_typu FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
  $stmt1 = $db->prepare($sql1);
  $stmt1->execute([':id' => $pokemon['id']]);
  $types = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  foreach ($types as $type) {

    echo "<div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2 text-center p-0 rounded bgcolor-" . strtolower($type['nazev_typu']) . "'>" . $type['nazev_typu'] . "</div>" ;
  }

  echo "</div></div></div></label></div>";
  if(($counter+1) % 4 == 0) {echo "</div>";}
   $counter++;
}?>
<div class="buttons col-12 m-2">
<button name="subm" class="btn btn btn-primary" type="submit">Submit</button>
</div>
</form>
</div>

<?php include_once 'footer.php'; ?>
