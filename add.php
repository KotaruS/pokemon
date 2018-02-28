<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/bootstrap-4.0.0-dist/css/bootstrap.min">
  <link rel="stylesheet" type="text/css" href="ed.css">

<title>Přidání</title>

</head>
<body>
    <div id='landpage'>

  
  
<?php
mb_internal_encoding("UTF-8");
$db = new PDO("mysql:host=localhost; dbname=pokedex; charset=utf8", "root", "");
	if(isset($_POST["vlozit"])) {
	$sql = "INSERT INTO clovek (jmeno, popis_cloveka)
            VALUES (:jmeno, :popis_cloveka)";
	$stmt = $db -> prepare($sql);
	$stmt -> execute([
			":jmeno" => $_POST["jmeno"],
			":popis_cloveka" => $_POST["popis_cloveka"]]);

}
?>
<h1>Přidání trenéra</h1>
<form action="add.php" method="post">
	<input type="text" name="jmeno" placeholder="Jméno">
	<textarea name="popis_cloveka" placeholder="Popis"></textarea>
	   
	<button type="submit" name="vlozit">Vložit</button>
</form>









<h1>Přidání pokémona</h1>



<?php

$db = new PDO("mysql:host=localhost; dbname=pokedex; charset=utf8", "root", "");
	if(isset($_POST["vlozit_pokemona"])) {
	$sql = "INSERT INTO pokemon (nazev, popis, obrazek)
            VALUES (:nazev, :popis, :obrazek)";
	$stmt = $db -> prepare($sql);
	$stmt -> execute([
			":nazev" => $_POST["nazev"],
			":obrazek" => $_POST["obrazek"],
			":popis" => $_POST["popis"]]);


}
?>

<form action="add.php" method="post">
	<input type="text" name="nazev" placeholder="Název">
	<textarea class="form-control" name="popis" placeholder="Popis"></textarea>
    <input type="file" name="obrazek" accept="image/*">
    
    
    
    
	
    
	
	<button type="submit" name="vlozit_pokemona" class="btn btn-primary">Vložit</button>
</form>

 <a href="vypis.php"><button type="button" class="btn btn-primary" name="button" id="back"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
        </div>
</body>
</html>