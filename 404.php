<?php
include_once 'header.php';
?>  <title>Error 404</title>
  <style>
  #root {
    font-family: 'Open Sans', sans-serif;
    font-size: 4em;

  }
  a {
    font-family: 'Open Sans', sans-serif;
    font-size: 3em;

    text-decoration: none;
  }
  </style>
</head>
<body>
  <div id="root"><h1>Stránka není dostupná</h1></div>
  <a href="index.php">Zpět</a>

  <!-- Button trigger modal -->
  <button type="button"  data-toggle="modal" data-target="#confirmation">
    baaaaa
  </button>

  <!-- Modal -->
  <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Title">Are you sure you want to do that?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Confirm deletion</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Button trigger modal -->
    <button type="button"  data-toggle="modal" data-target="#confirmation1">
      baaaaa
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmation1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Title">Are you sure you want that?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="vypis.php?id=2"><button type="button" class="btn btn-primary">Confirm deletion</button></a>
          </div>
        </div>
      </div>
    </div>

<?php include_once 'footer.php'; ?>
