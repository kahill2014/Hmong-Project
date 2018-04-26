<?php
if(isset($_POST["submit"])){
    $country = $_POST['country'];
    $year = $_POST['year'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
        $dbHost     = 'localhost';
        $dbUsername = 'weyrougham10';
        $dbPassword = 'Baseb@ll13!';
        $dbName     = 'hmong_project';
        
        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        
        $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $db->query("INSERT into `images` (`image`, `created`, `country`, `year`) VALUES ('$imgContent', '$dataTime', '$country', '$year')");
        if($insert){
            echo "File uploaded successfully.";
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}

?>
<!-- Just to go back because I am lazy -->
<a href="index.php">Add another?</a>
