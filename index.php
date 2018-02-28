<?php
require_once 'fce.php';
include_once 'header.php';


?>
<head>
  <title>Pokédex - Your best source of information</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="idx.css">
  <link rel="stylesheet" type="text/css" href="/bootstrap-4.0.0-dist/css/bootstrap.min">

</head>

<body>
  <div id="root">
    <div id='landpage'>
      <img id="pic" src="images/pokemon_logo.png" alt="logo">
      <h1>Vítejte na Pokédexu</h1>
      <h2>Seznam všech pokémonů i s popisem.</h2>
      <div id="menu">
        <ul  class="nav justify-content-center">
 
          <li class="nav-item">
            <a class="nav-link" href="vypis.php">Katalog pokémonů</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="add.php">Přidat</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  



<?php include_once 'footer.php'; ?>

</body>