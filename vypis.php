<?php
 require 'config.php';
 include_once 'header.php';
?>
  <title>Pokédex - Your best source of information</title>
  <link rel="stylesheet" type="text/css" href="vyp.css">
<?php

$numba = 0;
$counter = 0;

      $db = connection();
      // Filtr pro typy pokemonu
      if(isset($_GET['typ'])) {
        $typus = $_GET['typ'];
        $typek = implode(',', $typus);

        $sql = 'SELECT pokemon.id, pokemon.nazev, pokemon.popis, pokemon.obrazek, GROUP_CONCAT(typ_id ORDER BY typ_id ASC) as type FROM `pokemon_typ` JOIN pokemon ON pokemon_id = pokemon.id GROUP BY pokemon_id HAVING type LIKE :type OR type LIKE :type1 OR type LIKE :type2';
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':type' => '%,' . $typek,
          ':type1' => $typek . ',%',
          ':type2' => $typek]);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // vyhledavani
      } else if(isset($_GET['search'])) {
        $boi = $_GET['search'];
        $sql = 'SELECT * FROM pokemon WHERE nazev LIKE :nazev';
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':nazev' => '%' . $boi . '%']);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //filtrovat podle cloveka
      } else if(isset($_GET['clovek'])) {
        $human = $_GET['clovek'];
        $sql = 'SELECT * FROM `pokemon_clovek` JOIN pokemon ON pokemon_id = pokemon.id WHERE clovek_id = :clovek';
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':clovek' => $_GET['clovek']]);
        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {

      $sql = 'SELECT * FROM pokemon';
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

  <!-- tmavy/svetly vzhled toggle -->
<a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>

<div class="container">
  <!-- menu s filtry -->
<div class="row bg-filters rounded-bottom py-1 mb-4">
  <form method="get" class="col-12 p-3">
   <div class="input-group col-lg-11 mx-auto">
    <input class="searchbar-main form-control" type="search" name="search" placeholder="Search for pokémon..." autocomplete="off" >

    <button class="btn appender" type="submit"><span class="search-icon oi oi-magnifying-glass" aria-hidden="true"></span></button>

   </div>
  </form>
  <form class="row m-0 p-2">

    <?php if (count($humans_filter)>3) { ?>
      <div class="col-12 col-sm-12 col-md-12">
    <?php } else { ?>
    <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 ">
    <?php } ?>

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


   <?php if (count($humans_filter)>3) { ?>
    <div class="row col-12 col-sm-12 col-md-12 m-0">

   <?php } else { ?>

     <div class="row col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 m-0">

   <?php } ?>


     <h3 class="p-1 color-main">Trainers:</h3><div class="w-100"></div>
     <?php foreach ($humans_filter as $human_filter)
      {
    //  if(($human_filter['id']-1) % 6 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) { echo '<div class="row">';}
     ?>

     <?php if (count($humans_filter)>3) { ?>
      <div class="lidi col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 px-0 px-md-2 px-xl-1 mx-0 mb-1 mt-1">

   <?php } else { ?>

     <div class="lidi col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 px-0 px-md-2 px-xl-1 mx-0 mb-1 mt-1">

   <?php } ?>

        <label class="typ_nazev col-12 py-2 py-sm-2 py-md-1 bg-human" ><?php echo $human_filter['jmeno']; ?>
        <input type="radio" name="clovek" value="<?php echo $human_filter['id']; ?>">
        <span class="checkmark"></span>
        </label>
       </div>
      <?php
    //  if($human_filter['id'] % 6 == 0) {echo "</div>";}
      }
      ?>
    </div>
   <div class="col-12 col-md-10 offset-md-1 col-lg-2 offset-lg-10 px-2 py-lg-2 btn-group" role="group">

   <button type="reset" class="btn btn-primary col-3 col-sm-2 col-lg-4"><span class="oi oi-reload" aria-hidden="true"></span></button>
     <button type="submit" class="btn sibmit col"><span class="color-main">Submit</span></button>
   </div>

  </form>
</div>





<?php
// vypis
$ssss = (count($pokemons)==1) ? '' : 's' ;
if (!empty($pokemons)) {
  echo '<h5>' . count($pokemons) . ' result' . $ssss .'</h5>';
}
if(isset($_GET['typ']) && isset($_GET['clovek'])) {
  //do nothing
} else if(isset($_GET['clovek'])) {
  if (empty($pokemons)) {
    ?>
    <h2><a class='notblue' href='trainer.php?trainer=<?php echo $humans_filter[$human-1]['id'] ; ?>'><strong><?php echo $humans_filter[$human-1]['jmeno'] ;?></strong></a> doesn't have any pokémon</h2>
    <div class="row">


    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 ">
      <div class="cardo bg-main unique">
      <a href="edit.php?trainer=<?php echo $humans_filter[$human-1]['id'];?>">
      <img class='mw-100 pictur' id='lastone' src='images/blank.png' alt='add pokemon'>
      <span class="add-plus oi oi-plus "  aria-hidden="true"></span>
      <p class="add-text">Add pokemon</p>
      <div class="content px-2 py-3 bg-accent invisible">
      <h4 class="px-2 color-accent">Add Pokemon</h4>


        <div class="row m-0">
        <div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2 bgcolor-fairy text-center p-0 rounded'>aaaa </div>
        </div>
    <?php    echo "</div></div></div></a></div>";
  } else {  echo "<h3 class='color-reverse'><a class='notblue' href='trainer.php?trainer=" . $humans_filter[$human-1]['id'] . "'><strong>" . $humans_filter[$human-1]['jmeno'] . "</strong></a>'s collection:</h3>";
}

}

if(isset($_GET['search'])&& !empty($boi)&& !empty($pokemons)) {
  echo "<h3 class='color-reverse' >Results containing <strong>'" . $boi . "'</strong> </h3>";
}

if(empty($pokemons)&& isset($_GET['search'])) {
?>  <div class="alert alert-danger" role="alert">
    Unfortunately there is no pokémon with name '<?php echo $boi;?>'</div>
<?php }

if(empty($pokemons)&& isset($_GET['typ'])) { ?>
  <div class="alert alert-danger" role="alert">
    Unfortunately there is no pokémon with type<?php if((count($typus)) <= 1) {echo ': ';} else {echo 's: ';}?>
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
<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 id-<?php echo $pokemon['id'];?>">
<div class="cardo bg-main">
<a href="delete.php?delete=<?php echo $pokemon['id'] ?> "><span class="btns btn-1 oi oi-x" title="Are you sure you want to delete this pokemon?" aria-hidden="true"></span></a>
<a href="edit.php?edit=<?php echo $pokemon['id']; ?>"><span class="btns btn-2 oi oi-pencil" title="edit" aria-hidden="true"></span></a>
<a href="detail.php?pokeid=<?php echo $pokemon['id'];?>">
<img class='mw-100 pictur' src='<?php echo $pokemon['obrazek']; ?>' alt='pokemon-<?php echo strtolower($pokemon['nazev']);  ?>'>
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
//   if(($counter+1) % 4 == 0) {echo "</div>";}
//    $counter++;
// }

//konec jednotlive karty
//karta pridani pokemona


  // if (($counter+1) == count($pokemons)) {
   ?>
    <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-0 p-2 ">
    <div class="cardo bg-main unique">
    <a href="add.php">
    <img class='mw-100 pictur' id='lastone' src='images/blank.png' alt='add pokemon'>
    <span class="add-plus oi oi-plus "  aria-hidden="true"></span>
    <p class="add-text">Add pokémon</p>
    <div class="content px-2 py-3 bg-accent invisible">
    <h4 class="px-2 color-accent">Add Pokémon</h4>


      <div class="row m-0">
      <div class='col-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-2 bgcolor-fairy text-center p-0 rounded'>empty</div> -->

  <?php
     // echo "</div></div></div></a></div>";
  // }


  // important shit bez toho nefunguje radkovani
  if(($counter+1) % 4 == 0) {echo "</div>";}
   $counter++;
}
$counter = 0;
}
 ?>

 </div>
</div>
  <footer class="container-fluid p-3 mt-2">
  <div class="row">
    <div class="col-12 col-sm-6 col-md-4 footerlink"><a href="add.php">Add trainer</a></div>
    <div class="col-12 col-sm-6 col-md-4 footerlink"><a href="add.php">Add pokémon</a></div>
    <div class="col-12 col-sm-6 col-md-4 footerlink"><a href="index.php">Landpage</a></div>
  </div>
  </footer>
<?php include_once 'footer.php'; ?>
