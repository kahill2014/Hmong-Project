<?php
include('../login/pageFiles/pageheader.php');
include('../login/pageFiles/pagenav.php');
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
    echo '<div class="container">';
    echo '<div class="row">';
    		while ( $result = mysqli_fetch_array($sth)){
                 echo '<div class="col-lg-3 col-md-4 col-xs-6">';

			echo '<img src="data:image/jpeg;base64,'.base64_encode($result['image']).'" class="img-responsive"
             			height="512px" width="512px"/>';
		 echo'</div>';
    }

    echo'</div></div>';

?>
<style>
.row{
}

img{
padding-bottom: 15px;
padding-top: 15px;
}
</style>
