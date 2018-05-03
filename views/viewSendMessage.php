<?php
    session_start();
    foreach($_SESSION as $key => $value){
	if ($key == "username"){
             $user = $value;
        }
    }

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
        $sql = "SELECT id, pm_count FROM users WHERE username='$user'";
        foreach($db->query($sql) as $row){
        	$pm_count = $row['pm_count'];
                $userId = $row['id'];
	}

        //This is the math to figure out the percentage.
        //The message could divided by 50 then multiplied by 100 so we dont have a number less than 1
        $percent = $pm_count/'50';
        $percent = $percent * '100';
        ?>
        <br>
        <center>
        <b><p><a href="index.php?mode=inbox">Inbox</a> | <a href="index.php?mode=send_message">Compose</a></b>
        <b><p><?php echo "$pm_count"." of 50 Total  |  "."$percent"."% full"; ?></p></b>
        </center>
        <br>
        <?php
        //So here we get the variable submitted through the form to this page

                if (isset($_POST['username']) && isset($_POST['subject']) && isset($_POST['message'])){
                        $receiver = htmlspecialchars($_POST['username'], ENT_QUOTES); // Strip out special html characters including single and double quotes
                        $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES);
                        $message = htmlspecialchars($_POST['message'], ENT_QUOTES);
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
	    <br />
            <p class="text-center"><b>Please compose a message.</b></p>
            <br />
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

            else if ($subject == '')
                {
                echo "You must enter a subject!";
                                $error = 1;
                }

            else if ($message == '')
                {
                echo "You must enter a message!";
                                $error = 1;
                }

            //There are no errors so far which means the form is completely filled out
            else
                {
                //Are the trying to send a message to a real user or to something they just made up?
                $user_sql = "SELECT username FROM users WHERE username='$receiver'";
               	foreach($db->query($user_sql) as $row){
			if ($row['username'] == $receiver){
				$user_check = true;
			}
			else{
				$user_check = false;
			}
		}

                //The user is real and not made up if this is true
                if($user_check == false)
                    {
                        echo "That username does not exist, please try again. Remember to check your spelling, and don't make stuff up at random.";
                                                $error = 1;
                    }
                //If they mis spelled or, made up a username, then give an error message telling them its wrong.
                else
                    {
                                                //Get their private message count
                        $sql = "SELECT id, pm_count FROM users WHERE username='$receiver'";
                        foreach($db->query($sql) as $row){
                        	$pm_count = $row['pm_count'];
                        	$receiverId = $row['id'];
			}

                        //You cant have more than 50 private messages, if they try sending a message to a user with a full inbox return an error message
                        if($pm_count == '50')
                            {
                                echo 'The user you are trying to send a message to has 50 private messages, sorry but we cant send your message untill that user deletes some of their messages.';
                                $error = 1;
                            }

                        else if ($error == 0)
                            {
                                //And not we stick the message in the database with all the correct information
                                $db->query("INSERT INTO messages (receiverId, senderId, title, message) VALUES('$receiverId', '$userId', '$subject', '$message')") or die ($db->error());
                                //Add 1 to the pm count, update the receiver with the new pm count
                                $pm_count++;
                                $db->query("UPDATE users SET pm_count='$pm_count' WHERE username='$receiver'");

                                //Let the user know everything went ok.
                                echo "<p><b>You have successfully sent a private message!</b></p><br>";
                            }
                    }
                }
            }

            //Here's the form for the input
            ?>
            <form name="send" method="post" action="index.php?mode=send_message">
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

