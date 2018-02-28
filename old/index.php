<?php
// require_once 'fce.php';
include_once 'header.php';
?>
  <title>Pokédex - Your best source of information</title>
  <link rel="stylesheet" type="text/css" href="idx.css">
</head>

<body>
  <div id="root">
    <div id='landpage'>
      <img id="pic" src="images/pokemon_logo.png" alt="logo">
      <form method="get" id="searchform" action="">
        <input name="search" placeholder="Search for pokemon..." type="search"><button id="send" type="submit" value="search-send">&gt;</button>
      </form>
    </div>
  </div>
<?php include_once 'footer.php'; ?>
