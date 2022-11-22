<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Images</title>
  </head>
  <body>
		
		<?php
			$username = $_GET['username'];
			
			echo "<h2> {$username} </h2>";
			echo "<h1> Upload Image </h1>";
			
			echo "
				<form action='fileUploadScript.php?username={$username}' method='post' enctype='multipart/form-data'>
					Enter keywords seperated by commas:
					<input type='text' name='keywords' id='idKeywords'>
					<br>
					<input type='file' name='the_file' id='fileToUpload'>
					<br>
					<input type='submit' name='submit' value='Start Upload'>
				</form>
			";
			echo "<a href='mainpage.php?username={$username}'>Back to Main Page</a>";
		?>
		
  </body>
</html>