<?php
session_start();

// Get number of unread messaages for active user
function getUnreadMessageCount($uid){
    $unreadTotal = 0;
    $sql = "SELECT receiverRead, receiverId FROM `messages` WHERE receiverId = '$uid'";
    $result = getAllRecords($sql);
    for($i = 0; $i < count($result); $i++){
	if($result[$i]['receiverRead'] == 0){
	    $unreadTotal++;
	}
    }
    return $unreadTotal;
}

//Search for specific photos function
function searchFor() {
    //searchFilter is the value of the select box in the navbar
    $searchFilter = $_POST['searchFilter'];
    //searchString is the value of the search text field
    $searchString = $_POST['searchString'];
    //filter search string to only include letters and numbers
    $searchString = preg_replace("#[^0-9a-z]#i","",$searchString);
    //if searchString is empty, return empty to function call
    if ($searchString == '')
        return 'emptyString';
    //continue if searchString is not empty and prepare sql statement
    //if searchFilter option is set to all, search all sql image columns
    //else search for searchString in searchFilter columns, i.e. country, year, description
    if ($searchFilter == 'all')
        $sql = "SELECT * FROM `images` WHERE `country` LIKE '%$searchString%'
                OR `description` LIKE '%$searchString%'";
    else
        $sql = "SELECT * FROM `images` WHERE $searchFilter LIKE '%$searchString%'";
    //get query and set as result
    $result = getAllRecords($sql);
    //if result is greater than 0, return the result else return emptyResult to function call
    if (count($result) > 0)
        return $result;
    else
        return 'emptyResult';
}

// Function to get user data for pages that only use a view (rather than also using a function like uploadPhoto)
function getUserData($_SESSION_ID){
    $sql = "SELECT * from `users`
            WHERE id='$_SESSION_ID'";
    //define values for parameter
    $result = getOneRecord($sql);
    return $result;
}
function deleteMessage($pms){
    header('Location: index.php?mode=inbox');
    $user = $_SESSION['username'];
    $userId = $_SESSION['id'];
    //We do not have a user check on this page, because it seems silly to, you just send data to this page then it directs you right back to inbox
    //We need to get the total number of private messages the user has
    $sql = "SELECT id, pm_count FROM users WHERE username='$user'";
    foreach(getOneRecord($sql) as $row){
    	$pm_count = $row['pm_count'];
    }

    //A foreach loop for each pm in the array, get the values and set it as $pm_id because they were the ones selected for deletion foreach($pms as $num => $pm_id)
        {
echo $pm_id; echo $userId;
        //Delete the PM from the database
       	callQuery("DELETE FROM messages WHERE messageId='$pm_id' AND receiverId='$userId'");

        //Subtract a private message from the counter! YAY!
        $pm_count = $pm_count - '1';

        //Now update the users message count with the new value
        callQuery("UPDATE users SET pm_count='$pm_count' WHERE username='$user'");
        }
}
// Upload Photos
function uploadPhoto($SESSION_ID) {
    $country = $_POST['country'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $dataTime = date("Y-m-d H:i:s");
        //Insert image content into database
        //prepare sql statement
        $sql = "INSERT INTO `images` (`image`, `created`, `country`, `year`, `user_id`, `description`, `tags`)
                VALUES ('$imgContent', '$dataTime', '$country', '$year','$SESSION_ID', '$description', '$tags')";
        //define values for parameter
        $values = array('image'=>$imgContent, 'created'=>$dataTime,
                        'country'=>$country, 'year'=>$year, 'user_id'=>$SESSION_ID);
        //Execute statement and set the result to $result
        $result = getOneRecord($sql, $values);
        return $result;
    } else
        return "noPhoto";
}

//Get follower data for any user based on their id
function getUserFollowers($uid){
    $sql = "SELECT * FROM `following` WHERE followed_id = '$uid'";
    $result = getAllRecords($sql);
    return $result;
}

//Get following data for any user based on their id
function getUserFollowing($uid){
    $sql = "SELECT * FROM `following` WHERE follower_id = '$uid'";
    $result = getAllRecords($sql);
    return $result;
}

//View photos from session user
function deletePhotos(){
	echo 'HELLO';
}
function getUserPhotos(){
    $user = $_SESSION['id'];
    $sql = "SELECT * FROM `images` WHERE user_id = $user";
    $result = getAllRecords($sql);
    return $result;    
}
function getFollowerPhotos(){
    $user = $_SESSION['id'];
    $sql = "SELECT `image`
	    FROM `images`, `following` 
	    WHERE `user_id` = `followed_id` AND `follower_id` = $user
            ORDER BY `created` DESC";
    $result = getAllRecords($sql);
    return $result;
}

//Return all photos from the database
function getAllPhotos() {
    $sql = "SELECT * FROM `images`";
    $result = getAllRecords($sql);
    return $result;
}

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
    //check to see if username or email is already in use
    //check email first
    $sql = "SELECT email FROM `users` WHERE email='$email'";
    $values = array('email'=>$email);
    $emailStatus = getAllRecords($sql, $values);
    //check username next
    $sql = "SELECT username FROM `users` WHERE username='$username'";
    $values = array('username'=>$username);
    $usernameStatus = getAllRecords($sql, $values);
    if (count($emailStatus) == 0 && count($usernameStatus) == 0) {
        //If credentials aren't in use, prepare sql statement
        $sql = "INSERT INTO `users`(`id`, `lastName`, `firstName`, `email`, `username`, `password`, `pm_count`)
                VALUES ('0','$lastName','$firstName','$email','$username','$password','0')";
        //define values for parameter
        $values = array('lastName'=>$lastName, 'firstName'=>$firstName,
                        'email'=>$email, 'username'=>$username, 'password'=>$password);
        getOneRecord($sql, $values);
        //Run another sql query so that items from the db are able to be setup for the session
        $sql = "SELECT id, lastName, firstName, email, username, password from `users`
                WHERE email='$email' AND password='$password'";
        //define values for parameter
        $values = array('email'=>$email, 'password'=>$password);
        $result = getOneRecord($sql, $values);
        return $result;
    } else {
        if (count($emailStatus) > 0 && count($usernameStatus) == 0)
            return 'Email is already in use';
        if (count($emailStatus) == 0 && count($usernameStatus) > 0)
            return 'Username is already in use';
        if (count($emailStatus) > 0 && count($usernameStatus) > 0)
            return 'Email and username is already in use';
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
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Use this if you want to call a query that doesn't have a return (i.e. DELETE)
function callQuery($sql) {
    global $db;
    $statement = $db->prepare($sql);
    $statement->execute();
}
?>
