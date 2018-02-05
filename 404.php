<?php
include_once 'header.php';
?>  <title>Error 404</title>
  <style>
  #root {
    font-family: 'Open Sans', sans-serif;
    font-size: 4em;
    text-shadow: -5px 5px 0px #252eff, -10px 10px 0px #f0ff00;
  }
  a {
    font-family: 'Open Sans', sans-serif;
    font-size: 3em;
    text-shadow: -5px 5px 0px #f0ff00;
    color: black;
    text-decoration: none;
  }
  </style>
</head>
<body>
  <div id="root"><h1>Stránka není dostupná</h1></div>
  <a href="index.php">Zpět</a>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


<?php include_once 'footer.php'; ?>
