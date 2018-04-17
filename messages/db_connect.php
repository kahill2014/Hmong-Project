<?php
require ("config.php");
 //This part attempts to open a connection to the host of the database with the specified username and password
    $connection = mysql_connect("$DBHOST","$DBUSER","$DBPASSWORD") 
    or die ("Couldn't connect to server.");
    
    //This part actually selects the database from any others on the server and lets you select tables to get data from and insert into and stuff
    $db = mysql_select_db("$DBNAME", $connection)
    or die("Couldn't select database.");
?>