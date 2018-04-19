<?php
//Check to see if the username and password are valid
function checkValidUser() {
    //validate user
    $sql = "SELECT email, password from `users` WHERE email='$email' AND password='$password'";
    //define values for parameters
    $values = array('$email'=>$_POST['email'], '$password'=>$_POST['password']);
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
    $result = $statement->fetch(PDO, FETCH::FETCH_ASSOC);
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
    return $result;
}
?>
