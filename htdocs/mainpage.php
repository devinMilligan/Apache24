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
    $username = $_GET['username']; 
  	echo "<h2> " . $username . " </h2>";
	echo "<h1> Main Page </h1>";
	
        $username = $_GET['username']; 
        // Testing
        // $username = 'milldev';

		    echo "
          <a href='upload.php?username={$username}'>Upload Image</a></br>
          <a href='search.php?username={$username}'>Search for Image</a></br>
          <a href='login.php'>Logout</a></br>

          <h2>Image Gallery</h2>
        ";

        $currentDirectory = getcwd();
        $imageDirectory = "/images/" . $username . "/";

        $images = glob($currentDirectory.$imageDirectory."*.{jpeg,jpg,png}", GLOB_BRACE);

        foreach($images as $image) {
            $imageSize = getimagesize($image);
            $image = str_replace($currentDirectory, '', $image);

            $width = $imageSize[0] / 2;
            $height = $imageSize[1] / 2;

            echo " 
                <a href='photodetail.php?image={$image}&username={$username}'>
                    <img src='{$image}' width='{$width}' height='{$height}' />
                </a>
                <br />";
        }
      ?>
		
  </body>
</html>