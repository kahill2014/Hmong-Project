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
        ?>
        <br>
        <center>
        <b><p><a href="inbox.php">Inbox</a> | <a href="send_message.php">Compose</a></b>
        <b><p><?php echo "$pm_count"." of 50 Total  |  "."$percent"."% full"; ?></p></b>
        </center>
        <br>
        <?php
        //So here we get the variable submitted through the form to this page

		if (isset($_POST['username']) && isset($_POST['subject']) && isset($_POST['message'])){
			$receiver = htmlspecialchars($_POST['username'], ENT_QUOTES); // Strip out special html characters including single and double quote
			$receiver = mysql_real_escape_string($receiver); //Escape any characters that could be used in an sql injection attack
			
			$subject = htmlspecialchars($_POST['subject'], ENT_QUOTES);
			$subject = mysql_real_escape_string($subject);
			
			$message = htmlspecialchars($_POST['message'], ENT_QUOTES);
			$message = mysql_real_escape_string($message);
		}
		
		else {
			$receiver = '';
			$subject = '';
			$message = '';
		}
		
		$error = 0;
        
        //If they are all blank we jsut say to compose a message
        if($receiver == '' && $subject == '' && $message == '')
            {
            ?>
            <p><b>Please compose a message.</b></p>
            <br>
            <?php
            }
        
        //Since this form was partially filled out we need to return an error message
        else
            {
            if ($receiver == '')
                {
                echo "You must enter a user!";
				$error = 1;
                }
            
            if ($subject == '')
                {
                echo "You must enter a subject!";
				$error = 1;
                }
            
            if ($message == '')
                {
                echo "You must enter a message!";
				$error = 1;
                }
            
            //There are no errors so far which means the form is completely filled out    
            else
                {
                //Are the trying to send a message to a real user or to something they just made up?
                $user_check = mysql_query("SELECT username FROM users WHERE username='$receiver'");
                $user_check = mysql_num_rows($user_check);
                
                //The user is real and not made up if this is true
                if($user_check <= '0')
                    {
                        echo "That username does not exist, please try again. Remember to check your spelling, and don't make stuff up at random.";
						$error = 1;
                    }
                //If they mis spelled or, made up a username, then give an error message telling them its wrong.
                else
                    {
						//Get their private message count
                        $sql = mysql_query ("SELECT id, pm_count FROM users WHERE username='$receiver'");
                        $row = mysql_fetch_array ($sql);
                        $pm_count = $row['pm_count'];
						$receiverId = $row['id'];
                        
                        //You cant have more than 50 private messages, if they try sending a message to a user with a full inbox return an error message
                        if($pm_count == '50')
                            {
								echo 'The user you are trying to send a message to has 50 private messages, sorry but we cant send your message untill that user deletes some of their messages.';
								$error = 1;
                            }
                            
                        else if ($error == 0)
                            {    
								//And not we stick the message in the database with all the correct information
								mysql_query("INSERT INTO messages (receiverId, senderId, title, message) VALUES('$receiverId', '$userId', '$subject', '$message')") or die (mysql_error());
								//Add 1 to the pm count, update the receiver with the new pm count
								$pm_count++;
								mysql_query("UPDATE users SET pm_count='$pm_count' WHERE username='$receiver'");
								
								//Let the user know everything went ok.
								echo "<p><b>You have successfully sent a private message!</b></p><br>";
                            }
                    }
                }
            }
           
            //Here's the form for the input
            ?>
            <form name="send" method="post" action="send_message.php">
            <table width="80%">
              <tr>
                <td width="150px" align="left" valign="top"><p>Username</p></td>
                <td width="" align="left" valign="top"><input name="username" type="text" id="username" value="<?php echo "$receiver"; ?>"></td>
              </tr>
              
              <tr>
                <td width="150px" align="left" valign="top"><p>Subject</p></td>
                <td width="" align="left" valign="top"><input name="subject" type="text" id="subject" value="<?php echo "$subject"; ?>"></td>
              </tr>
              
              <tr>
                <td width="150px" align="left" valign="top"><p>Message Body</p></td>
                <td width="" align="left" valign="top"><textarea name="message" type="text" id="message" value="" cols="50" rows="10"></textarea></td>
              </tr>
                  
              <tr>  
                <td></td>
                <td><input type="submit" name="Submit" value="Send Message"></td>
              </tr>
            </table>
            </center>
            </form>
            <?php
        }    
    ?>