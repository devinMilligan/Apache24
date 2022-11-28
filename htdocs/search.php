<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
  </head>
  <body>
		
		<?php
			$username = $_GET['username'];
			
			echo "<h2> {$username} </h2>";
			echo "<h1> Search </h1>";
			
			echo "
				<form action='searchScript.php?username={$username}'  method='post' enctype='multipart/form-data'>
					Enter a keyword:
					<input type='text' name='keyword' id='idKeyword'>
					<br>
					<input type='submit' name='search' value='Search'>
				</form>
			";
			echo "<a href='mainpage.php?username={$username}'>Back to Main Page</a>";
		?>
		
  </body>
</html>