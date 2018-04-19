<?php
    session_start();
    //include database connection info
    include('databaseConnection/pdo_connect.php');
    //include functions
    include('login/models/model.php');
    //read the main task using the primary key 'mode'
    $mode = '';
    if (isset($_REQUEST['mode']))
        $mode = $_REQUEST['mode'];
    switch ($mode) {
        case 'checkLogin':
            $data = checkValidUser();
            if (isset($data) && isset($data['member_id'])) {
                $_SESSION['user'] = $data['user'];
            }
            //include pageheader
            //include defaultview
            //include pagefooter
            break;
        case 'logout':
            //destroy session variables and display login form
            session_destroy();
            setcookie(session_name(), '', time()-1000, '/');
            $_SESSION = array();
            //display default view
            //include pageheader
            //include defaultview
            //include pagefooter
            break;
    }
?>
