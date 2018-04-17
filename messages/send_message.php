<?php
session_start();
$user = $_SESSION['username'];
    
    include 'db_connect.php';
    
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
        <b><p><a href="inbox.php">Inbox</a> | <a href="compose.php">Compose</a> | <a href="sent.php">Sentbox</a></b>
        <b><p><?php echo "$pm_count"." of 50 Total  |  "."$percent"."% full"; ?></p></b>
        </center>
        <br>
        <?php
        //So here we get the variable submitted through the form to this page
        $reciever = htmlspecialchars($_POST['username'], ENT_QUOTES); // Strip out special html characters including single and double quote
        $reciever = mysql_real_escape_string($reciever); //Escape any characters that could be used in an sql injection attack
        
        $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES);
        $subject = mysql_real_escape_string($subject);
        
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES);
        $message = mysql_real_escape_string($message);
        $error = '0';
        
        //If they are all blank we jsut say to compose a message
        if(!$reciever AND !$subject AND !$message)
            {
            ?>
            <p><b>Please compose a message.</b></p>
            <br>
            <?php
            }
        
        //Since this form was partially filled out we need to return an error message
        else
            {
            if (!$reciever)
                {
                $error = 'You must enter a reciever to your message';
                }
            
            if (!$subject)
                {
                $error = 'You must enter a subject';
                }
            
            if (!$message)
                {
                $error = 'You must enter a message';
                }
            
            //If the variable error is not set to zero, we have a problem and should show the error message
            if($error != '0')
                {
                echo "<p>$error</p><br>";
                }
            
            //There are no errors so far which means the form is completely filled out    
            else
                {
                //Are the trying to send a message to a real user or to something they just made up?
                $user_check = mysql_query("SELECT username FROM users WHERE username='$reciever'");
                $user_check = mysql_num_rows($user_check);
                
                //The user is real and not made up if this is true
                if($user_check > '0')
                    {
                        //Get their private message count
                        $sql = mysql_query ("SELECT id, pm_count FROM users WHERE username='$reciever'");
                        $row = mysql_fetch_array ($sql);
                        $pm_count = $row['pm_count'];
						$receiverId = $row['id'];
                        
                        //You cant have more than 50 private messages, if they try sending a message to a user with a full inbox return an error message
                        if(pm_count == '50')
                            {
                            $error = 'The user you are trying to send a message to has 50 private messages, sorry but we cant send your message untill that user deletes some of their messages.';
                            }
                            
                        else
                            {    
                            //And not we stick the message in the database with all the correct information
                            mysql_query("INSERT INTO messages (recieverId, senderId, title, message) VALUES('$recieverId', '$userId', '$subject', '$message')") or die (mysql_error());
                            //Add 1 to the pm count, update the reciever with the new pm count
                            $pm_count++;
                            mysql_query("UPDATE users SET pm_count='$pm_count' WHERE username='$reciever'");
                            }
                            
                        //Let the user know everything went ok.
                        echo "<p><b>You have successfully sent a private message!</b></p><br>";
                    }
                //If they mis spelled or, made up a username, then give an error message telling them its wrong.
                else
                    {
                    $error = "That username does not exist, please try again. Remember to check your spelling, and don't make stuff up at random.";
                    }
                }
            }
        //Since we may have set the error variable to something while trying to send the messae, we need another error check
        if($error != '0')
            {
            echo "<p>$error</p><br>";
            }
            
        else
            {
            //Here's the form for the input
            ?>
            <form name="send" method="post" action="compose.php">
            <table width="80%">
              <tr>
                <td width="150px" align="left" valign="top"><p>Username</p></td>
                <td width="" align="left" valign="top"><input name="username" type="text" id="username" value="<?php echo "$reciever"; ?>"></td>
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
        }    
    ?>