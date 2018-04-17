<?php
	include 'db_connect.php';
	session_start();
	$user = 'hillka28';
    //$user = $_SESSION['username'];
    
    
    
    //This checks to see if a user is logged in or not by seeing if the sessioned username varialble exists.
    //You could change this check to however you want to validate your members, this is just how I did it.
    if(!$user)
        {
        echo "<br><p>Blah blah you arent logged in and stuff, you should do that or something</p><br>";
        }
        
    else
        {
        //We need to grab the msg_id variable from the URL.
        $msg_id = $_REQUEST['msg_id'];
        
        //Get all of the information about the message with the id number sent through the URL
        $view_msg = mysql_query("SELECT * FROM messages WHERE messageId = '$msg_id'");
        $msg = mysql_fetch_array($view_msg);
		
		$sql = mysql_query ("SELECT id FROM users WHERE username='$user'");
        $row = mysql_fetch_array ($sql);
		$userId = $row['id'];
        
        $receiver = $msg['receiverId'];
        $sender = $msg['senderId'];
        $subject = $msg['title'];
        $message = $msg['message'];
		
		$sql = mysql_query ("SELECT username FROM users WHERE id='$sender'");
        $row = mysql_fetch_array ($sql);
		$senderName = $row['username'];
        
        //If the person who is supposed to recieve the message is the currently logged in user everything is good
        if($receiver == $userId)
            {
            //The message was recieved, so lets update the message in the database so it wont show up in the sent page any more
            mysql_query("UPDATE messages SET receiverRead='1' WHERE messageId = '$msg_id'");
            
            //Query the database to see how many messages the logged in user has, then do a little math
            //Find the percentage that your inbox is full (message count divided by 50)
            //50 messages maximum, you can change that
            $sql = mysql_query ("SELECT pm_count FROM users WHERE username='$user'");
            $row = mysql_fetch_array ($sql);
            $pm_count = $row['pm_count'];
            
            //This is the math to figure out the percentage.
            //The message could divided by 50 then multiplied by 100 so we dont have a number less than 1
            $percent = $pm_count/'50';
            $percent = $percent * '100';
            
            //Now we will display the little navigation thing, the fullness of the inbox, then display message information stuff, like who its from, the subject, and the body
            ?>
            <br>
            <center>
            <b><p><a href="inbox.php">Inbox</a> | <a href="senc_message.php">Compose</a></b>
            <b><p><?php echo "$pm_count"." of 50 Total  |  "."$percent"."% full"; ?></p></b>
            </center>
            <br>
            
            <table width="80%">
              <tr>
                <td width="120px"><p>From:</p></td>
                <td width=""><p><a href = "<?php echo "../user/profile.php?user_name=$senderName"; ?>"><?php echo $senderName; ?></a></p></td>
              </tr>
              
              <tr>
                <td width="120px"><p>Subject:</p></td>
                <td width=""><p><?php echo $subject; ?></p></td>
              </tr>
              
              <tr>    
                <td width="120px"><p>Message Body:</p></td>
                <td width=""><p><?php echo $message; ?></p></td>
              </tr>
            </table>
            </center>
            <?php
            }
        //Everything is not good, someone tried to look at somone else's private message
        else
            {
            ?>
            <p>It appears you are trying to view someone else's private message. Please view your own private messages, or go away.</p>
            <?php
            }
        }
    ?>