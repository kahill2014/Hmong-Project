<?php
//Check to see if the username and password are valid
function checkValidUser() {
    //validate user
    //gather post data
    $email=$_POST['email'];
    $password=$_POST['password'];
    //protect against injection attack
    $email=stripslashes($email);
    $password=md5(stripslashes($password));
    //prepare sql statement
    $sql = "SELECT id, lastName, firstName, email, username, password from `users`
            WHERE email='$email' AND password='$password'";
    //define values for parameter
    $values = array('email'=>$email, 'password'=>$password);
    $result = getOneRecord($sql, $values);
    return $result;
}

//Register user
function registerUser() {
    //gather post data
    $lastName=$_POST['lastName'];
    $firstName=$_POST['firstName'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    //protect against injection attack
    $lastName=stripslashes($lastName);
    $firstName=stripslashes($firstName);
    $email=stripslashes($email);
    $username=stripslashes($username);
    $password=md5(stripslashes($password));
    //prepare sql statement to check to see if email and username are in use
    $sqlCheck = "SELECT email, username from `users`
                 WHERE email='$email' AND username='$username'";
    //define values for parameter
    $valuesCheck = array('email'=>$email, 'password'=>$password);
    $resultCheck = getOneRecord($sqlCheck, $valuesCheck);
    if (mysqli_num_rows($resultCheck) >= 1)
        //If email and password are in use, print this
        echo "User name already in use";
    else {
        //Else if result comes back as zero, add information
        //prepare sql statement
        $sql = "INSERT INTO `users`(`id`, `lastName`, `firstName`, `email`, `username`, `password`, `pm_count`)
                VALUES ('0','$lastName','$firstName','$email','$username','$password','0')";
        //define values for parameter
        $values = array('lastName'=>$lastName, 'firstName'=>$firstName,
                        'email'=>$email, 'username'=>$username, 'password'=>$password);
        $result = getOneRecord($sql, $values);
        return $result;
    }
}

//Retrieve ONLY one record from the database
function getOneRecord($sql, $parameter = null) {
    global $db;
    $statement = $db->prepare($sql);
    //execute the SQL statement
    $statement->execute($parameter);
    //return the result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//Retrieve multiple records from the database
function getAllRecords($sql, $parameter = null) {
    global $db;
    $statement = $db->prepare($sql);
    //execute the SQL statement
    $statement->execute($parameter);
    //return the result
    $result = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $result;
}
?>
