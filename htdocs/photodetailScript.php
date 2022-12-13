<?php
  error_reporting(E_ALL ^ E_NOTICE);

  class photodetail {
        
    public String $username;
    public String $currentDirectory;
    public String $usrDir;
    public $image;
    public int $key;

    public function __construct(String $username, int $key, $image) {
      $this->username = $username;
      $this->key = $key;
      $this->currentDirectory = getcwd();
      $this->usrDir = "/images/" . $username . "/";
      $this->image = $image;
      print $this->key;
    }
    public function display_image(){
      echo $this->image;
      echo "<img src='{$this->image}' />";
      echo '</br>';
    }
    public function display_image_name(){
      
    }
    public function list_keywords(){
        $num_file = $this->currentDirectory . $this->usrDir . "num_imgs.txt";
        $index_file =  $this->currentDirectory . $this->usrDir . "index.txt";
        $keywords = "";
        $lines = file($index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
          $line_arr = explode(",", $line);
          $count = count($line_arr);
          for($i = 1; $i <= $count - 1; $i++){
            if($line_arr[$i] == $this->key){
              $keywords .= '\'';
              $keywords .= $line_arr[0];
              $keywords .= '\' ';
            }
          }
        }
		    echo "</br>";
      echo "<h2> Keywords: {$keywords}<h2>";
echo "<a href='mainpage.php?username={$this->username}'>Back to Main Page</a>";
    }
  }




?>