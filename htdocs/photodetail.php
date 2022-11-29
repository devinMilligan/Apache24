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
        echo $_GET['image'];
        echo "<img src='{$_GET['image']}' width='{$_GET['width']}' height='{$_GET['height']}'/>";
        echo '</br>';
        $username = $_GET['username'];
        
		echo "</br>";
		echo "<a href='mainpage.php?username={$username}'>Back to Main Page</a>";
		
    ?>
    

  </body>
</html>