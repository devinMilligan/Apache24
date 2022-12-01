<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
  </head>
  <body>
    <?php
      error_reporting(E_ALL ^ E_NOTICE);

      require_once('C:/Apache24/htdocs/mainpageScript.php');

      $script = new mainpage($_GET['username']);
      $script->getImages();
      $script->displayHeader();
      $script->displayButtons();
      $script->displayImages();
    ?>
  </body>
</html>