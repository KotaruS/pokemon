<?php
require 'config.php';
include_once 'header.php';
echo '<link rel="stylesheet" type="text/css" href="vyp.css">';
echo '<link rel="stylesheet" type="text/css" href="det.css">';
echo '<link rel="stylesheet" type="text/css" href="pokedit.css">';
$pokeid = $_GET['pokeid'];
$pokeid = filter_input(INPUT_GET, 'pokeid', FILTER_VALIDATE_INT);
if(!$pokeid) {
  header("Location: 404.php");
}
$db = connection();

$sql = 'SELECT * FROM pokemon where id = :id;';
$stmt = $db->prepare($sql);
$stmt->execute([':id' => $pokeid]);
$pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

?>  <title>Pokemon - <?php echo $pokemon['nazev']; ?></title> <?php
// $sql2 = 'SELECT * FROM pokemon_typ;';
// $stmt2 = $db->prepare($sql2);
// $stmt2->execute();
// $poketypes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//
//
$sql1 = 'SELECT * FROM `pokemon_typ` JOIN typ ON pokemon_typ.typ_id = typ.id WHERE pokemon_id = :id;';
$stmt = $db->prepare($sql1);
$stmt->execute([':id' => $pokemon['id']]);
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql4 = 'SELECT * FROM pokemon_clovek JOIN clovek ON clovek_id = clovek.id WHERE pokemon_id = :pokemon_id;';
$stmt = $db->prepare($sql4);
$stmt->execute([':pokemon_id' => $pokeid]);
$humans_filter = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['edit'])&& $_GET['edit']=='false') {



  if (isset($_POST['confirm'])) {
    #pokud je nastaveno jmeno a popis
  if (isset($_POST['name'])&& isset($_POST['popis'])) {
    $sqlc = 'UPDATE pokemon SET nazev = :name, popis = :popis WHERE id = :id; ';
    $stmt = $db->prepare($sqlc);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':popis' => $_POST['popis'],
        ':id' => $pokeid
    ]);
  }
  #pokud se obe hodnoty rovnaji 0 atd..
  if (isset($_POST['typ1']) && isset($_POST['typ2']) && $_POST['typ1']==0 && $_POST['typ2']==0) {
    # DO nothing...
  } else if (isset($_POST['typ1']) && $_POST['typ1']==0 && isset($_POST['typ2insert']) && $_POST['typ2insert']==0) {
    # DO nothing...
  } else if (isset($_POST['typ2'])&& $_POST['typ2']==0) {
    $sqlt1 = 'DELETE FROM pokemon_typ WHERE pokemon_id = :poke_id AND typ_id = :typ';
    $stmt = $db->prepare($sqlt1);
    $stmt->execute([
      ':typ' => $types[1]['typ_id'],
      ':poke_id' => $pokeid
    ]);
  } else if (isset($_POST['typ1'])&& $_POST['typ1']==0) {
    $sqlt1 = 'DELETE FROM pokemon_typ WHERE pokemon_id = :poke_id AND typ_id = :typ';
    $stmt = $db->prepare($sqlt1);
    $stmt->execute([
      ':typ' => $types[0]['typ_id'],
      ':poke_id' => $pokeid
    ]);
  }
  if (isset($_POST['typ2'])&& $_POST['typ2']!=0) {
    $sqlt2 = 'UPDATE pokemon_typ SET typ_id = :typ WHERE pokemon_id = :poke_id AND typ_id = :typcurr ';
    $stmt = $db->prepare($sqlt2);
    $stmt->execute([
        ':typ' => $_POST['typ2'],
        ':poke_id' => $pokeid,
        ':typcurr' => $types[1]['typ_id']
    ]);
  }
  if (isset($_POST['typ1'])&& $_POST['typ1']!=0) {

    $sqlt1 = 'UPDATE pokemon_typ SET typ_id = :typ WHERE pokemon_id = :poke_id AND typ_id = :typcurr ';
    $stmt = $db->prepare($sqlt1);
    $stmt->execute([
      ':typ' => $_POST['typ1'],
      ':poke_id' => $pokeid,
      ':typcurr' => $types[0]['typ_id']
    ]);
  }

  else if (isset($_POST['typ2insert'])&& $_POST['typ2insert']==0) {
    # DO nothing...
  }
  if (isset($_POST['typ2insert'])&& $_POST['typ2insert']!=0) {

    $sqlt2i = 'INSERT INTO pokemon_typ (pokemon_id, typ_id) VALUES (:poke_id, :typ) ';
    $stmt = $db->prepare($sqlt2i);
    $stmt->execute([
      ':poke_id' => $pokeid,
      ':typ' => $_POST['typ2insert']
    ]);
  }



 }
 header('Location: detail.php?pokeid=' . $pokeid);
}
?>
</head>
<body>
  <a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>
<div class="container">
  <div class="section row mt-0 mb-2 mt-sm-5">
    <div class="sidebar col-12 col-lg-4">
      <img src="<?php echo $pokemon['obrazek'];?>" class="mw-100" alt="pokemon">
    </div>
     <div class="description col-12 col-lg-8">
       <?php if (isset($_GET['edit'])&& $_GET['edit']=='true') {
         ?>
         <form class="" action="detail.php?pokeid=<?php echo $pokeid; ?>&edit=false" method="post">


         <div class="form-group">
           <label for="name">Pokémon name:</label>
           <input type="text" id="name" class="form-control bar-main" name="name" value="<?php echo $pokemon['nazev'];?>">
         </div>
         <div class="form-group">
           <label for="popis">Bio:</label>
           <textarea rows="4" id="popis" class="form-control bar-main" name="popis" ><?php echo $pokemon['popis']; ?></textarea>
         </div>

       <?php } else {?>
       <h1><?php echo $pokemon['nazev'];?></h1>
       <h3>Bio</h3>
       <p><?php echo $pokemon['popis'];?></p>
     <?php } ?>
       <h3>Types</h3>
       <div class="row mx-0 my-3">

       <?php


       if (isset($_GET['edit'])&& $_GET['edit']=='true') {

       $sql2 = 'SELECT * FROM typ';
       $stmt = $db->prepare($sql2);
       $stmt->execute();
       $alltypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $numberplus = 0;

       foreach ($types as $type) {


         ?><div class="form-group ml-2">

           <select class="custom-select selecttype" name="typ<?php echo $numberplus+1;?>">
             <option value="0">None</option>
             <?php foreach ($alltypes as $alltype) {
               $selected = ($type['id']==$alltype['id']) ? 'selected' : '' ;
               echo "<option value='" . $alltype['id'] . "'". $selected . ">" . $alltype['nazev_typu'] . "</option>";
             } ?>
          </select>
         </div>

         <?php
         $numberplus++;
      }
      if (count($types)<2) {
        ?>
        <div class="form-group ml-2">

          <select class="custom-select selecttype" name="typ2insert">
            <option value="0">None</option>
            <?php foreach ($alltypes as $alltype) {

              echo "<option value='" . $alltype['id'] . "'>" . $alltype['nazev_typu'] . "</option>";
            } ?>
         </select>
        </div>


        <?php
      }

    } else {



       foreach ($types as $type) {
         //echo $type['nazev_typu'];
         //var_dump($type);
         echo "<div class='col-3 col-sm-2 ml-2 text-center p-0 rounded bgcolor-" . strtolower($type['nazev_typu']) . "'>" . $type['nazev_typu'] . "</div>" ;
       }
    }   ?>
      </div>
     </div>
<?php if (!isset($_GET['edit'])) {

?>
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
           <a class="notblue" href="trainer.php?trainer=<?php echo $human_filter['id']; ?>">
          <div class="human col-12 py-2 py-sm-2 py-md-1 bg-human" ><?php echo $human_filter['jmeno']; ?>
          </div>
        </a>
     </div>


<?php }?>
  </div>
    </div>

  <?php } ?>
  </div>
  <div class="my-2">
    <?php if (isset($_GET['edit'])&& $_GET['edit']=='true') { ?>
      <a href="detail.php?pokeid=<?php echo $pokeid;?>"><button type="button" class="btn btn-danger my-1" name="button"><span class="oi oi-x pr-1" aria-hidden="true"></span>Abandon</button></a>
      <button type="submit" class="btn btn-success my-1" name="confirm"><span class="oi oi-check pr-1" aria-hidden="true"></span>Save</button>
    </form>
  <?php } else { ?>
  <a href="vypis.php"><button type="button" class="btn btn-accent my-1" name="button"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
  <a href="detail.php?pokeid=<?php echo $pokeid; ?>&edit=true"><button type="button" class="btn btn-primary my-1" name="button"><span class="oi oi-pencil pr-1" aria-hidden="true"></span>Edit</button></a>
  <a href="delete.php?delete=<?php echo $pokeid;?>"><button type="button" class="btn btn-danger my-1" name="button"><span class="oi oi-trash pr-1" aria-hidden="true"></span>Delete</button></a>
  <?php } ?>
  </div>
</div>
<?php include_once 'footer.php'; ?>
