<?php
//Check to see if the username and password are valid
function checkValidUser() {
    //validate user
    $sql = "SELECT username, password from `hmong_project` WHERE username=:username
            AND pwd=:pwd";
    //define values for parameters
    $values = array(':username'=>$_POST['username'], ':pwd'=>md5($_POST['pwd']));
    $result = getOneRecord($sql, $values);
    return $result;
}

//Retrieve ONLY one record from the database
function getOneRecord($sql, $parameter = null) {
    global $db;
    $statement = $db->prepare($sql);
    //execute the SQL statement
    $statement->execute($parameter);
    //return the result
    $result = $statement->fetch(PDO::FETCH::FETCH_ASSOC);
    return $result;
}

//Retrieve multiple records from the database
function getAllRecords($sql, $parameter = null) {
    global $db;
    $statement = $db->prepare($sql);
    //execute the SQL statement
    $statement->execute($parameter);
    //return the result
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result
}
?>
