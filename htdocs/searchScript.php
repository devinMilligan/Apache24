<?php

$script = new searchScript($_GET['username']);
$script->search();

class searchScript{

    public String $username;
    public String $usrDir;
    public String $currentDirectory;
    public String $num_file;
    public String $index_file;

    public function __construct(String $un){
        $this->username = $un;
        $this->usrDir = "\\images\\" . $this->username . "\\";
        $this->currentDirectory = getcwd();
        $this->num_file = $this->currentDirectory . $this->usrDir . "num_imgs.txt";
        $this->index_file =  $this->currentDirectory . $this->usrDir . "index.txt";
    }

    public function search(){
        error_reporting(E_ALL ^ E_NOTICE);

        $flag = 0;
        $not_empty = 0;
        
        if ( ! empty($_POST['keyword'])){
            $not_empty = 1;
            $key = $_POST['keyword'];
            $lines = $this->readFile();
        
            foreach($lines as $line) {
                $line_arr = explode(",", $line);
                $count = count($line_arr);
        
                if($line_arr[0] == $key){
                    $flag = 1;
                    $this->keyFound($count, $line_arr);
                }
            }
            $this->printLink($flag);
        }
        else{
            header( "refresh:5;url=search.php?username={$this->username}" );
            echo "Please enter keywords to search for. Returning to search page...";
        }
        
        $this->noResultsCheck($flag, $not_empty);
    }

    public function readFile() : array {
        return file($this->index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    }

    public function keyFound($count, $line_arr) : bool{
        echo "<h1>Search Results</h1>";
        for ($x = 1; $x <= $count-1; $x++) {
            $image = $this->currentDirectory . $this->usrDir . $line_arr[$x] . ".png";
            $imageSize = getimagesize($image);
            $image = str_replace($this->currentDirectory, '', $image);

            $width = $imageSize[0] / 2;
            $height = $imageSize[1] / 2;
            $fileNum = pathinfo($image, PATHINFO_FILENAME);
            echo " 
                <a href='photodetail.php?image={$image}&username={$this->username}&imageNum={$fileNum}'>
                    <img src='{$image}' width='{$width}' height='{$height}' />
                </a>
                <br />";
        }
        return true;
    }

    public function printLink($flag) : bool {
        if($flag == 1){
            echo "<a href='search.php?username={$this->username}'>Back to Search Page</a>";
            return true;
        }
        return false;
    }

    public function noResultsCheck($flag, $not_empty) : bool {
        if(($flag == 0) && ($not_empty == 1)){
            header( "refresh:5;url=search.php?username={$this->username}" );
            echo "No images found matching keyword. Returning to search page...";
            return true;
        }
        return false;
    }
}
?>