<?php
 require 'config.php';
 include_once 'header.php';
?>
  <title>Pokédex - Your best source of information</title>
  <link rel="stylesheet" type="text/css" href="vyp.css">
<?php
if (isset($_COOKIE['theme'])) {
  $odkaz = ($_COOKIE['theme'] == 'dark') ? 'dark' : 'light';
  switch ($_COOKIE['theme']) {
    case 'dark':
      echo '<link rel="stylesheet" type="text/css" href="dark.css">';
      break;

    case 'light':
      echo '<link rel="stylesheet" type="text/css" href="light.css">';
      break;
  }
} else
{
  echo '<link rel="stylesheet" type="text/css" href="light.css">';
$odkaz = 'light';
}
$numba = 0;
$counter = 0;
      $db = connection();


      if(isset($_GET['typ'])) {
        $typus = $_GET['typ'];
        $typek = implode(',', $typus);

        $sql = 'SELECT pokemon.id, pokemon.nazev, pokemon.popis, pokemon.obrazek, GROUP_CONCAT(typ_id ORDER BY typ_id ASC) as type FROM `pokemon_typ` JOIN pokemon ON pokemon_id = pokemon.id GROUP BY pokemon_id HAVING type LIKE :type OR type LIKE :type1 OR type LIKE :type2;';
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':type' => '%,' . $typek,
          ':type1' => $typek . ',%',
          ':type2' => $typek]);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);

      } else if(isset($_GET['search'])) {
        $boi = $_GET['search'];
        $sql = 'SELECT * FROM pokemon WHERE nazev LIKE :nazev';
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':nazev' => '%' . $boi . '%']);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {

      $sql = 'SELECT * FROM pokemon;';
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $sql2 = 'SELECT * FROM pokemon_typ;';
      $stmt2 = $db->prepare($sql2);
      $stmt2->execute();
      $poketypes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      }

      $sql3 = 'SELECT * FROM typ;';
      $stmt3 = $db->prepare($sql3);
      $stmt3->execute();
      $types_filter = $stmt3->fetchAll(PDO::FETCH_ASSOC);

      $sql4 = 'SELECT * FROM clovek;';
      $stmt4 = $db->prepare($sql4);
      $stmt4->execute();
      $humans_filter = $stmt4->fetchAll(PDO::FETCH_ASSOC);
//
// if (je to jedna) {
//   # link black css...
// }


  ?>
</head>
<body>
<a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>
<div class="container">
<div class="row bg-filters rounded-bottom py-1 mb-4">
  <form method="get" class="col-12 p-3">
   <div class="input-group col-lg-11 mx-auto">
    <input class="searchbar-main form-control" type="search" name="search" placeholder="Search for pokemon..." autocomplete="off" ><span class="search-icon oi oi-magnifying-glass" aria-hidden="true"></span>
   </div>
  </form>
  <form class="row m-0 p-2">

  <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 ">
    <h3 class="p-1 color-main">Types:</h3><div class="w-100"></div>
    <?php foreach ($types_filter as $type_filter)
     {

     if($counter % 6 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) { echo '<div class="row">';}
    ?>
      <div class="col-xs-12 col-6 col-sm-6 col-md-4 col-lg-2 col-xl-2 mx-0 my-1">
       <label class="typ_nazev col-12 py-2 py-sm-2 py-md-1 bgcolor-<?php echo strtolower($type_filter['nazev_typu']);?>" ><?php echo $type_filter['nazev_typu']; ?>
       <input type="checkbox" name="typ[]" value="<?php echo $type_filter['id']; ?>">
       <span class="checkmark bgcolor-<?php echo strtolower($type_filter['nazev_typu']);?>"></span>
       </label>
      </div>
     <?php
     if(($counter+1) % 6 == 0) {echo "</div>";}
     $counter++;
   }
   $counter = 0;
     ?>
   </div>
   <div class="row col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 m-0">
     <h3 class="p-1 color-main">Trainers:</h3><div class="w-100"></div>
     <?php foreach ($humans_filter as $human_filter)
      {
    //  if(($human_filter['id']-1) % 6 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) { echo '<div class="row">';}
     ?>
       <div class="lidi col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 px-0 px-md-2 px-xl-1 mx-0 mb-1 mt-1">
        <label class="typ_nazev col-12 py-2 py-sm-2 py-md-1 bg-human" ><?php echo $human_filter['jmeno']; ?>
        <input type="checkbox" name="clovek[]" value="<?php echo $human_filter['id']; ?>">
        <span class="checkmark"></span>
        </label>
       </div>
      <?php
    //  if($human_filter['id'] % 6 == 0) {echo "</div>";}
      }
      ?>
    </div>
   <div class="col-12 col-md-10 offset-md-1 col-lg-2 offset-lg-10 pl-lg-4 pr-lg-2 py-lg-2 pr-xl-3 pl-xl-3" ><button type="submit" class="sibmit col-12 py-2"><span class="color-main">Submit</span></button></div>
  </form>
</div>

<?php
// vypis
if(isset($_GET['search'])&& !empty($boi)&& !empty($pokemons)) {
  echo "<h3 class='color-reverse' >Results containing <strong>'" . $boi . "'</strong> </h3>";
}
if(empty($pokemons)&& isset($_GET['search'])) {
?>  <div class="alert alert-danger" role="alert">
    Unfortunately there is no pokemon with name '<?php echo $boi;?>'
<?php }
if(empty($pokemons)&& isset($_GET['typ'])) { ?>
  <div class="alert alert-danger" role="alert">
    Unfortunately there is no pokemon with type<?php if((count($typus)) <= 1) {echo ': ';} else {echo 's: ';}?>
<?php
foreach ($types_filter as $type) {
  if((count($typus)) <= 1) {
    if($type['id']==$typus[0]) {
      echo "<strong>" . $type['nazev_typu'] . "</strong> ";
    }
  } else {
    foreach ($typus as $taipey) {
      if($type['id']==$taipey) {
        echo "<strong>" . $type['nazev_typu'] . "</strong> ";
      }
    }
  }
}

?>  </div>
<?php } else {
foreach ($pokemons as $pokemon) {

if($counter % 4 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) {
 echo "<div class='row'>";
}
?>
<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-0 id-<?php echo $pokemon['id'];?>">
<div class="cardo bg-main rounded ">
<a href="delete.php?delete=<?php echo $pokemon['id'] ?> "><span class="btns oi oi-x" title="Are you sure you want to delete this pokemon?" aria-hidden="true"></span></a>
<a href="#"><span class="btns oi oi-pencil" title="edit" aria-hidden="true"></span></a>
<a href="<?php # TO DO odkaz na pokemona detail ?>">
<img class='mw-100 pictur' src='images/<?php echo $pokemon['obrazek']; ?>' alt='pokemon-<?php echo strtolower($pokemon['nazev']);  ?>'>
</a>
<div class="content px-2 py-3 bg-accent rounded-bottom">
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
    echo "<div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2  text-center p-0 rounded bgcolor-" . strtolower($type['nazev_typu']) . "'>" . $type['nazev_typu'] . "</div>" ;
  }
//  echo "";
  echo "</div></div></div></div>";
//konec jednotlive karty

  if(($counter+1) % 4 == 0) {echo "</div>";}
   $counter++;
}
$counter = 0;
}
 ?>

  </div>
<?php include_once 'footer.php'; ?>
