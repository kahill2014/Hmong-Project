<?php
    //DB details
    $dbHost     = 'localhost';
    $dbUsername = 'weyrougham10';
    $dbPassword = 'Baseb@ll13!';
    $dbName     = 'hmong_project';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    //Check connection
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
    
    //Get image data from database
    $sql = "SELECT * FROM `images`";
    $sth = $db->query($sql);

    while ( $result = mysqli_fetch_array($sth)){
	echo '<img src="data:image/jpeg;base64,'.base64_encode($result['image']).'" height="512" width="512"/>';
    }


?>
