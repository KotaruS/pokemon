<?php
require 'config.php';
include_once 'header.php';
echo '<link rel="stylesheet" type="text/css" href="vyp.css">';
echo '<link rel="stylesheet" type="text/css" href="train.css">';
$gettrainer = filter_input(INPUT_GET, 'trainer', FILTER_VALIDATE_INT);
if(!$gettrainer) {
  header("Location: 404.php");
}
$db = connection();
$counter = 0;
$sql = 'SELECT * FROM clovek where id = :id;';
$stmt = $db->prepare($sql);
$stmt->execute([':id' => $gettrainer]);
$human = $stmt->fetch(PDO::FETCH_ASSOC);

?>  <title>Trainer - <?php echo $human['jmeno']; ?></title> <?php
// $sql2 = 'SELECT * FROM pokemon_typ;';
// $stmt2 = $db->prepare($sql2);
// $stmt2->execute();
// $poketypes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//
//
// $sql3 = 'SELECT * FROM typ;';
// $stmt3 = $db->prepare($sql3);
// $stmt3->execute();
// $types_filter = $stmt3->fetchAll(PDO::FETCH_ASSOC);
//
// $sql4 = 'SELECT * FROM pokemon_clovek JOIN clovek ON clovek_id = clovek.id WHERE pokemon_id = :pokemon_id;';
// $stmt4 = $db->prepare($sql4);
// $stmt4->execute([':pokemon_id' => $_GET['pokeid']]);
// $humans_filter = $stmt4->fetchAll(PDO::FETCH_ASSOC);

// echo '<a href="delete.php?pokemon=<php echo $pokemon['id']. '&trainer=' . $gettrainer;>"></a>';
$sql2 = 'SELECT * FROM `pokemon_clovek` JOIN pokemon ON pokemon_id = pokemon.id WHERE clovek_id = :clovek';
$stmt2 = $db->prepare($sql2);
$stmt2->execute([
  ':clovek' => $gettrainer]);
$pokemons = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
</head>
<body>
  <a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>
<div class="container">

<?php if (isset($_GET['edit'])) { ?>
  <form class="" action="trainer.php?trainer=<?php echo $gettrainer; ?>" method="post">

  </form>
<input type="text" name="jmeno" value="<?php echo $human['jmeno'];?>">
<?php } else { ?>


<h1><?php echo $human['jmeno']; ?></h1>
<p><?php echo $human['popis_cloveka']; ?></p>

<?php } ?>
<h2><?php echo $human['jmeno']; ?>'s collection</h2>
<?php
foreach ($pokemons as $pokemon) {

if($counter % 4 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) {
 echo "<div class='row'>";
}
?>
<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 id-<?php echo $pokemon['id'];?>">
<!-- TO DO <span class="delete oi oi-trash "  aria-hidden="true"></span> -->
<div class="cardo bg-main">
<a href="detail.php?pokeid=<?php echo $pokemon['id'];?>">
<img class='mw-100 pictur' src='images/<?php echo $pokemon['obrazek']; ?>' alt='pokemon-<?php echo strtolower($pokemon['nazev']);  ?>'>
</a>
<div class="content px-2 py-3 bg-accent">
<h4 class="px-2 color-accent"><?php echo $pokemon['nazev'];?></h4>


  <div class="row m-0">
<?php
  $sql1 = 'SELECT nazev_typu FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
  $stmt1 = $db->prepare($sql1);
  $stmt1->execute([':id' => $pokemon['id']]);
  $types = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  foreach ($types as $type) {
    //echo $type['nazev_typu'];
    //var_dump($type);
    echo "<div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2 text-center p-0 rounded bgcolor-" . strtolower($type['nazev_typu']) . "'>" . $type['nazev_typu'] . "</div>" ;
  }
//  echo "";
  echo "</div></div></div></div>";


   if ($counter+1 == count($pokemons)) {
   ?>  <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 ">
     <div class="cardo bg-main unique">
     <a href="edit.php?trainer=<?php echo $gettrainer;?>">
     <img class='mw-100 pictur' id='lastone' src='images/blank.png' alt='add pokemon'>
     <span class="add-plus oi oi-plus "  aria-hidden="true"></span>
     <p class="add-text">Add pokemon</p>
     <div class="content px-2 py-3 bg-accent invisible">
     <h4 class="px-2 color-accent">Add Pokemon</h4>


       <div class="row m-0">
       <div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2 bgcolor-fairy text-center p-0 rounded'>aaaa </div>

   <?php    echo "</div></div></div></a></div>";
   }
   if(($counter+1) % 4 == 0) {echo "</div>";}
    $counter++;
 }
 $counter = 0;


?>

  <div class="buttons col-12 m-2">
    <?php if (isset($_GET['edit'])) { ?>
      <a href="trainer.php?trainer=<?php echo $gettrainer;?>"><button type="button" class="btn btn-danger my-1" name="button"><span class="oi oi-x pr-1" aria-hidden="true"></span>Abandon</button></a>
      <button type="submit" class="btn btn-success my-1" name="button"><span class="oi oi-check pr-1" aria-hidden="true"></span>Save</button>
    </form>
  <?php } else { ?>
  <a href="vypis.php"><button type="button" class="btn btn-accent my-1" name="button"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
  <a href="trainer.php?trainer=<?php echo $gettrainer;?>&edit=true"><button type="button" class="btn btn-primary my-1" name="button"><span class="oi oi-pencil pr-1" aria-hidden="true"></span>Edit</button></a>
  <a href="delete.php?trainerdel=<?php echo $gettrainer;?>"><button type="button" class="btn btn-danger my-1" name="button"><span class="oi oi-trash pr-1" aria-hidden="true"></span>Delete</button></a>
<?php } ?>
  </div>
 </div>
</div>
<?php include_once 'footer.php'; ?>
