<?php
include_once 'header.php';

?>
<style>
body {
  background: var(--bg-body);
}
  h1 {
    color: var(--txt-main);
    font-size: 4rem;
  }
  h2 {
    color: var(--txt-accent);
    font-size: 1.5rem;
  }

</style>
<title>Error 404</title>

</head>
<body>
<a class="theme-toggle rounded-left" href="handler.php?theme=<?php echo $odkaz;?>" ><span class="oi oi-droplet" aria-hidden="true"></span></a>

<div class="container p-3">

<h1>Error 404</h1>
<h2>Stránka nebyla nalezena</h2>
<a href="vypis.php"><button type="button" class="btn btn-accent my-1" name="button"><span class="oi oi-action-undo pr-1" aria-hidden="true"></span>Back</button></a>
</div>
<?php include_once 'footer.php'; ?>
