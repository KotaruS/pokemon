<?php
require 'config.php';
include_once 'header.php';
echo '<link rel="stylesheet" type="text/css" href="vyp.css">';
echo '<link rel="stylesheet" type="text/css" href="det.css">';
$db = connection();

$sql = 'SELECT * FROM pokemon where id = :id;';
$stmt = $db->prepare($sql);
$stmt->execute([':id' => $_GET['pokeid']]);
$pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

?>  <title>Pokemon - <?php echo $pokemon['nazev']; ?></title> <?php
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

$sql4 = 'SELECT * FROM pokemon_clovek JOIN clovek ON clovek_id = clovek.id WHERE pokemon_id = :pokemon_id;';
$stmt4 = $db->prepare($sql4);
$stmt4->execute([':pokemon_id' => $_GET['pokeid']]);
$humans_filter = $stmt4->fetchAll(PDO::FETCH_ASSOC);

?>
</head>
<body>
  <a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>
<div class="container">
  <div class="section row mt-0 mb-2 mt-sm-5">
    <div class="sidebar col-12 col-lg-4">
      <img src="images/<?php echo $pokemon['obrazek'];?>" class="mw-100" alt="pokemon">
    </div>
     <div class="description col-12 col-lg-8">
       <h1><?php echo $pokemon['nazev'];?></h1>
       <h3>Bio</h3>
       <p><?php echo $pokemon['popis'];?></p>
       <h3>Types</h3>
       <div class="row mx-0 my-3">

       <?php $sql1 = 'SELECT nazev_typu FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
       $stmt1 = $db->prepare($sql1);
       $stmt1->execute([':id' => $pokemon['id']]);
       $types = $stmt1->fetchAll(PDO::FETCH_ASSOC);
       foreach ($types as $type) {
         //echo $type['nazev_typu'];
         //var_dump($type);
         echo "<div class='col-3 col-sm-2 ml-2 text-center p-0 rounded bgcolor-" . strtolower($type['nazev_typu']) . "'>" . $type['nazev_typu'] . "</div>" ;
       }?>
      </div>
     </div>
     <div class="footerino py-2 col-12">
     <?php if (!empty($humans_filter)) {
     ?><h4>This Pokémon is owned by:</h4>
     <?php } else {
     ?>
       <h4>This pokémon isn't owned by anyone</h4>
     <?php
     }
     ?>
       <div class="row mx-0 my-1 ">

       <?php foreach ($humans_filter as $human_filter)
        {
      //  if(($human_filter['id']-1) % 6 == 0  /*&& count($pokemons) - ($numba+4) !== 0*/) { echo '<div class="row">';}
       ?>
         <div class="col-6 col-sm-4 col-md-3 col-lg-2 px-2  px-xl-1  mb-1 mt-1">
          <div class="human col-12 py-2 py-sm-2 py-md-1 bg-human" ><?php echo $human_filter['jmeno']; ?>



          </div>

     </div>
<?php }?>
  </div>
    </div>
  </div>
  <div class="buttons my-2">

  </div>
  <a href="vypis.php"><button type="button" class="btn btn-accent my-1" name="button"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
  <a href="edit.php"><button type="button" class="btn btn-primary my-1" name="button"><span class="oi oi-pencil pr-1" aria-hidden="true"></span>Edit</button></a>
  <a href="delete.php?delete=<?php echo $_GET['pokeid'];?>"><button type="button" class="btn btn-danger my-1" name="button"><span class="oi oi-trash pr-1" aria-hidden="true"></span>Delete</button></a>
</div>
<?php include_once 'footer.php'; ?>
