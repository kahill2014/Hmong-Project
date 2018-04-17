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
        //Query the database to see how many messages the logged in user has, then do a little math
        //Find the percentage that your inbox is full (message count divided by 50)
        //50 messages maximum, you can change that
        $sql = mysql_query ("SELECT id, pm_count FROM users WHERE username='$user'");
        $row = mysql_fetch_array ($sql);
        $pm_count = $row['pm_count'];
		$userId = $row['id'];
        
        //This is the math to figure out the percentage.
        //The message could divided by 50 then multiplied by 100 so we dont have a number less than 1
        $percent = $pm_count/'50';
        $percent = $percent * '100';
        
        //Next we come out of PHP and show some HTML, the inbox fullness, links to the other message system pages, the messages, etc.
        ?>
        <br>
        <center>
        <b><p><a href="inbox.php">Inbox</a> | <a href="send_message.php">Compose</a></b>
        <b><p><?php echo "$pm_count"." of 50 Total  |  "."$percent"."% full"; ?></p></b>
        </center>
        <br>
        <?php
        //This stuff and the while loop will query the database, see if you have messages or not, and display them if you do
        $query = "SELECT messageId, senderId, title, message FROM messages WHERE receiverId='$userId'";
        $sqlinbox = mysql_query($query);
        
        //We have a mysql error, we should probably let somone know about the error, so we should print the error
        if(!$sqlinbox)
            {
            ?>
            <p><?php print '$query: '.$query.mysql_error();?></p>
            <?php
            }
        
        //There are no rows found for the user that is logged in, so that either means they have no messages or something broke, lets assume them they have no messages
        elseif (!mysql_num_rows($sqlinbox) )
            {
            ?>
            <center><p><b>You have no messages to display</b></p></center>
            <?php
            }
        
        //There are no errors, and they do have messages, lets query the database and get the information after we make a table to put the information into
        else
            {
            //Ok, Lets center this whole table Im going to make just because I like it like that
            //Then we create a table 80% the total width, with 3 columns, The subject is 75% of the whole table, the sender is 120 pixels (should be plenty) and the select checkboxes only get 25 pixels
            ?>
            <center>
            <form name="send" method="post" action="delete_message.php">
            <table width="80%">
            <tr>
              <td width="75%" valign="top"><p><b><u>Subject</u></b></p></td>
              <td width="120px" valign="top"><p><b><u>Sender</u></b></p></td>  
              <td width="25px" valign="top"><p><b><u>Select</u></b></p></td>
            </tr>
            <?php
            //Since everything is good so far and we earlier did a query to get all the message information we need to display the information. 
            //This while loop goes through the array outputting all of the message information
            while($inbox = mysql_fetch_array($sqlinbox))
                {
				
                //These are the variables we get from the array as it is going through the messages, we have the id of the private message, we have the person who sent the message, we have the subject of the message, and yeah thats it
                $pm_id = $inbox['messageId'];
                $senderId = $inbox['senderId'];
                $subject = $inbox['title'];
				$sql = mysql_query ("SELECT username FROM users WHERE id='$senderId'");
				$row = mysql_fetch_array ($sql);
				$sender = $row['username'];
                
                //So lets show the subject and make that a link to the view message page, we will send the message id through the URL to the view message page so the message can be displayed
                //And also let the person see who sent it to them, if you want you can make that some sort of a link to view more stuff about the user, but Im not doing that here, I did it for my game though, similar to the viewmsg.php page but a different page, and with the senders id
                //And finally the checkboxes that are all stuck into an array and if they are selected we stick the private message id into the array
                //I will only let my users have a maximum of 50 messages, remeber that ok? Because that's the value I will later in another page
                //Here is finally the html output for the message data, the while loop keeps going untill it runs out of messages
                ?>
                <tr>
                  <td width="75%" valign="top"><p><a href="view_message.php?msg_id=<?php echo $pm_id; ?>"><?php echo $subject; ?></a></p></td>
                  <td width="120px" valign="top"><p><?php echo $sender; ?></p></td>
                  <td width="25px" valign="top"><input name="pms[]" type="checkbox" value="<?php echo $pm_id; ?>"></td>
                </tr>
                <?php
                //This ends the while loop
                }
            //Here is a submit button for the form that sends the delete page the message ids in an array
            ?>
            <tr>  
            <td colspan="3"><input type="submit" name="Submit" value="Delete Selected"></td>
            <td></td>
            <td></td>
            </tr>
            </table>
            </center>
            <?php
            //So this ends the else to see if it is all ok and having messages or not
            }
        
        //This ends that first thing that checks if you are logged in or not
        }
    ?> 