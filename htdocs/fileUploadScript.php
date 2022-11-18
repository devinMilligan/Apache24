<?php
	header( "refresh:10;url=upload.html" );
	$username = "milldev";


    $currentDirectory = getcwd();
    $uploadDirectory = "/images/" . $username . "/";

	$num_file = $currentDirectory . $uploadDirectory . "num_imgs.txt";
	$index_file =  $currentDirectory . $uploadDirectory . "index.txt";
	
	$numFile = 0;
	

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
		  
		if(!is_file($num_file)){
		
			file_put_contents($num_file, $numFile+1);
		
		}else{
			$myfile = fopen($num_file, "r");
			$numFile = fread($myfile,filesize($num_file));
			fclose($myfile);
			file_put_contents($num_file, $numFile+1);
		}
		
		$uploadPath = $currentDirectory . $uploadDirectory . $numFile . "." . $fileExtension; 
		  
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
			
			if ( ! empty($_POST['keywords'])){
				if(!is_file($index_file)){
					$contents = "File Header";
					file_put_contents($index_file, $contents);
				}
				$temp = $_POST['keywords'];
				$delimStr = str_replace(' ', '', $temp);
				$keywords = explode(",", $delimStr);
				$num_keys = count($keywords);
				$lines = file($index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
				
				$row_count = 0;
				
				foreach($keywords as $key) {
					$check = 0;
					foreach($lines as $ind => $line){
						$line_temp = str_replace(' ', '', $line);
						$lineArr = explode(",", $line_temp);
						if($key == $lineArr[0]){
							$lines[$ind] .= "," . $numFile;
							$check = 1;
						}
					}
					if($check==0){
						$line_count = count($lines);
						echo $line_count;
						if($line_count==0){
							$lines[$row_count] = $key . "," . $numFile;
							$row_count = $row_count + 1;
						}else{
							array_push($lines,$key . "," . $numFile);
						}
					}
				}
				
				file_put_contents($index_file, implode(PHP_EOL, $lines));
				
			}
			
			
			
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
?>