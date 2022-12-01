<?php
error_reporting(E_ALL ^ E_NOTICE);



if (isset($_POST['submit'])) {
	
	$script = new UploadScript($_GET['username']);

header( "refresh:5;url=upload.php?username={$script->username}" );

$script->createDirectory();
$script->getFileInformation();
	
		if(!$script->isFileExtAllowed()){
			
			printErrors($script->errors);
			exit();
		}
		
		if(!$script->isFileSizeOk()){
			
			printErrors($script->errors);
			exit();
		}
		
		$script->createNumFile();
		
		if(!$script->uploadFile()){
			
			echo "An error occurred while uploading the file";
			exit();
		}
		
		if(!$script->addKeywords($_POST['keywords'])){
			
			echo "Please add some keywords to upload picture";
			exit();
		}
		
		echo "The file has been uploaded";

}

function printErrors(array $errs){
	
	foreach ($errs as $error) {
          echo $error . "These are the errors" . "\n";
    }
	
}

class UploadScript{
	
	public array $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

	public string $username;
	public string $currentDirectory;
	public string $uploadDirectory;
	public string $num_file;
	public string $index_file;
	public array $errors = [];
	public int $numFile;
	
	
    public string $fileName;
    public int $fileSize;
    public string $fileTmpName;
    public string $fileType;
    public string $fileExtension;

	
	public function __construct(string $usern){
		
		$this->username = $usern;
		$this->numFile = 0;
		$this->errors = [];
		$this->currentDirectory = "c:/Apache24/htdocs";
		$this->uploadDirectory = "/images/" . $usern . "/";
		$this->num_file = $this->currentDirectory . $this->uploadDirectory . "num_imgs.txt";
		$this->index_file =  $this->currentDirectory . $this->uploadDirectory . "index.txt";
		
	}
	
	public function createDirectory(): bool{
				
		if(!is_dir("." . $this->uploadDirectory)){
			mkdir("." . $this->uploadDirectory);
			return true;
		}
		return false;
	}
	
	public function getFileInformation(){
		
		
		$this->fileName = $_FILES['the_file']['name'];
		$this->fileSize = $_FILES['the_file']['size'];
		$this->fileTmpName  = $_FILES['the_file']['tmp_name'];
		$this->fileType = $_FILES['the_file']['type'];
		$this->fileExtension = strtolower(end(explode('.',$this->fileName)));
		
	}
	
	public function isFileExtAllowed(): bool{
		
		if (! in_array($this->fileExtension,$this->fileExtensionsAllowed)) {
			$this->errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
			return false;
		}
		return true;
	}
	
	public function isFileExtAllowed_t(string $fileExt): bool{
		
		if (! in_array($fileExt,$this->fileExtensionsAllowed)) {
			$this->errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
			return false;
		}
		return true;
	}
	
	
	public function isFileSizeOk(): bool{
		
		if ($this->fileSize > 4000000) {
			$this->errors[] = "File exceeds maximum size (4MB)";
			return false;
		}
		return true;
		
	}
	
	public function isFileSizeOk_t(int $val): bool{
		
		if ($val > 4000000) {
			$this->errors[] = "File exceeds maximum size (4MB)";
			return false;
		}
		return true;
		
	}
	
	public function createNumFile(): bool{
		if(!is_file($this->num_file)){
		
			file_put_contents($this->num_file, $this->numFile+1);
			$this->uploadPath = $this->currentDirectory . $this->uploadDirectory . $this->numFile . "." . $this->fileExtension; 

			return true;
		
		}else{
			$myfile = fopen($this->num_file, "r");
			$this->numFile = fread($myfile,filesize($this->num_file));
			fclose($myfile);
			file_put_contents($this->num_file, ($this->numFile)+1);
			$this->uploadPath = $this->currentDirectory . $this->uploadDirectory . $this->numFile . "." . $this->fileExtension; 
			
			return false;
		}
		
	}
	
	public function uploadFile(): bool{
		
		return move_uploaded_file($this->fileTmpName, $this->uploadPath);
		
	}
	
	public function addKeywords(string $in_keywords): bool{
		
		if ( ! empty($in_keywords)){
			if(!is_file($this->index_file)){
				$contents = "File Header";
				file_put_contents($this->index_file, $contents);
			}
			$delimStr = str_replace(' ', '', $in_keywords);
			$keywords = explode(",", $delimStr);
			$num_keys = count($keywords);
			$lines = file($this->index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
			
			$row_count = 0;
			
			foreach($keywords as $key) {
				$check = 0;
				foreach($lines as $ind => $line){
					$line_temp = str_replace(' ', '', $line);
					$lineArr = explode(",", $line_temp);
					if($key == $lineArr[0]){
						$lines[$ind] .= "," . $this->numFile;
						$check = 1;
					}
				}
				if($check==0){
					$line_count = count($lines);
					if($line_count==0){
						$lines[$row_count] = $key . "," . $this->numFile;
						$row_count = $row_count + 1;
					}else{
						array_push($lines,$key . "," . $this->numFile);
					}
				}
			}
			
			file_put_contents($this->index_file, implode(PHP_EOL, $lines));	
				
			return true;
				
		}else{
			
			return false; 
			
		}
		
		
	}
	

	
}

 /*   if (isset($_POST['submit'])) {

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

    }*/
?>