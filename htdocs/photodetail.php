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
        echo "<img src='{$_GET['image']}' />";
        echo '</br>';

        $username = $_GET['username'];
        $key = $_GET['imageNum'];
        
        $currentDirectory = getcwd(); //This is based on the logic found in searchScript.php
        $usrDir = "\\images\\" . strval($username) . "\\";

        $num_file = $currentDirectory . $usrDir . "num_imgs.txt";
        $index_file =  $currentDirectory . $usrDir . "index.txt";
        $keywords = "";
        $lines = file($index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
          $line_arr = explode(",", $line);
          $count = count($line_arr);
          for($i = 1; $i <= $count - 1; $i++){
            if($line_arr[$i] == $key){
              $keywords .= '\'';
              $keywords .= $line_arr[0];
              $keywords .= '\' ';
            }
          }
        }
		    echo "</br>";
      echo "<h2> Keywords: {$keywords}<h2>";
		  echo "<a href='mainpage.php?username={$username}'>Back to Main Page</a>";
		
    ?>
    

  </body>
</html>