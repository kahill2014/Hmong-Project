<?php
require ("config.php");
public class DatabaseConnect
{
function __construct()
{
    mysql_connect(DBHOST,DBUSER,DBPASSWORD) or die('Could not connect to MySQL server.');
    mysql_select_db(DBNAME);
}

}
?>