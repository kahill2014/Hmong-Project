 <?php
	include 'db_connect.php';
    session_start();
    header("Location:inbox.php");
    
	$user = 'hillka28';
    //$user = $_SESSION['username'];
    
    //We do not have a user check on this page, because it seems silly to, you just send data to this page then it directs you right back to inbox
    
    //We need to get the total number of private messages the user has
    $sql = mysql_query ("SELECT id, pm_count FROM users WHERE username='$user'");
    $row = mysql_fetch_array ($sql);
    $pm_count = $row['pm_count'];
	$userId = $row['id'];
                
    //A foreach loop for each pm in the array, get the values and set it as $pm_id because they were the ones selected for deletion
    foreach($_POST['pms'] as $num => $pm_id)
        {
        //Delete the PM from the database
        mysql_query("DELETE FROM messages WHERE messageId='$pm_id' AND receiverId='$userId'");
        
        //Subtract a private message from the counter! YAY!
        $pm_count = $pm_count - '1';
        
        //Now update the users message count with the new value
        mysql_query("UPDATE users SET pm_count='$pm_count' WHERE username='$user'");
        }
?> 