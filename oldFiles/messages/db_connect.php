<?php
require ("config.php");
    //This part actually selects the database from any others on the server and lets you select tables to get data from and insert into and stuff
    //$db = mysql_select_db("$DBNAME", $connection)
    $db = mysqli_connect($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME)
    or die("Couldn't select database.");
?>
