<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- local only -->
  <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <!-- Online CDN
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  -->
<?php  if (isset($_COOKIE['theme'])) {
    $odkaz = ($_COOKIE['theme'] == 'dark') ? 'dark' : 'light';
    switch ($_COOKIE['theme']) {
      case 'dark':
        echo '<link rel="stylesheet" type="text/css" href="dark.css">';
        break;

      case 'light':
        echo '<link rel="stylesheet" type="text/css" href="light.css">';
        break;
    }
  } else {
    echo '<link rel="stylesheet" type="text/css" href="light.css">';
  $odkaz = 'light';
  }

  $counter = 0;
?>
<!-- </head> required -->
