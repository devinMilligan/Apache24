<?php
	$username = $_GET['username'];
	error_reporting(E_ALL ^ E_NOTICE);

    $currentDirectory = getcwd();
    $usrDir = "\\images\\" . $username . "\\";

    $num_file = $currentDirectory . $usrDir . "num_imgs.txt";
    $index_file =  $currentDirectory . $usrDir . "index.txt";

    $flag = 0;
    $not_empty = 0;
    
    if ( ! empty($_POST['keyword'])){
        $not_empty = 1;
        $key = $_POST['keyword'];
        $lines = file($index_file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    
        foreach($lines as $line) {
            $line_arr = explode(",", $line);
            $count = count($line_arr);

            if($line_arr[0] == $key){
                $flag = 1;
                echo "<h1>Search Results</h1>";
                for ($x = 1; $x <= $count-1; $x++) {
                    $image = $currentDirectory . $usrDir . $line_arr[$x] . ".png";
                    $imageSize = getimagesize($image);
                    $image = str_replace($currentDirectory, '', $image);

                    $width = $imageSize[0] / 2;
                    $height = $imageSize[1] / 2;
                    $fileNum = pathinfo($image, PATHINFO_FILENAME);
                    echo " 
                        <a href='photodetail.php?image={$image}&username={$username}&imageNum={$fileNum}'>
                            <img src='{$image}' width='{$width}' height='{$height}' />
                        </a>
                        <br />";
                }
            }
        }
        if($flag == 1){
            echo "<a href='search.php?username={$username}'>Back to Search Page</a>";
        }
    }
    else{
	    header( "refresh:5;url=search.php?username={$username}" );
        echo "Please enter keywords to search for. Returning to search page...";
    }
    
    if(($flag == 0) && ($not_empty == 1)){
        header( "refresh:5;url=search.php?username={$username}" );
        echo "No images found matching keyword. Returning to search page...";
    }
?>