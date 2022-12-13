<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo Detail</title>
  </head>
  <body>
    <?php 
        error_reporting(E_ALL ^ E_NOTICE);
        require_once('C:/Apache24/htdocs/photodetailScript.php');
      
        $script = new photodetail($_GET['username'], $_GET['imageNum'], $_GET['image']);
        $script->display_image();
        $script->list_keywords();
        $script->return_to_main_page();
    ?>
    

  </body>
</html>