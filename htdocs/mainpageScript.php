<?php
    error_reporting(E_ALL ^ E_NOTICE);

    class mainpage {

        public String $username;
        public String $currentDirectory;
        public String $imageDirectory;
        public $images;

        public function __construct(String $username) {
        $this->username = $username;
        $this->currentDirectory = "C:\Apache24\htdocs";
        $this->imageDirectory = "/images/" . $username . "/";
        }

        public function displayHeader() {
        echo "<h2> " . $this->username . " </h2>";
        echo "<h1> Main Page </h1>";
        }

        public function displayButtons() {
        echo "
        <a href='upload.php?username={$this->username}'>Upload Image</a></br>
        <a href='search.php?username={$this->username}'>Search for Image</a></br>
        <a href='login.php'>Logout</a></br>
        ";
        }

        public function getImages(): int {
            $this->images = glob($this->currentDirectory.$this->imageDirectory."*.{jpeg,jpg,png}", GLOB_BRACE);
            return sizeof($this->images);
        }

        public function displayImages(){
        echo "<h2>Image Gallery</h2>";
        foreach($this->images as $image) {
            $imageSize = getimagesize($image);
            $image = str_replace($this->currentDirectory, '', $image);

            $width = $imageSize[0];
            $height = $imageSize[1];
            $fileNum = pathinfo($image, PATHINFO_FILENAME);
            echo " 
                <a href='photodetail.php?image={$image}&username={$this->username}&imageNum={$fileNum}'>
                    <img src='{$image}' width='{$width}' height='{$height}' />
                </a>
                <br />";
        }
        }

        public function getUsername(): String {
            return $this->username;
        }

        public function getPWD(): String {
            return $this->currentDirectory;
        }
        public function getImageDirectory(): String {
            return $this->imageDirectory;
        }
    }

?>