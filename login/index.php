<?php
    session_start();
    //include database connection info
    include('../databaseConnection/pdo_connect.php');
    //include functions
    include('../login/models/model.php');
    //read the main task using the primary key 'mode'
    $mode = '';
    if (isset($_REQUEST['mode']))
        $mode = $_REQUEST['mode'];
    switch ($mode) {
//Function views are here
        case 'registerUser':
            $data = registerUser();
            if (isset($data) && isset($data['id'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            include('../login/pageFiles/pageheader.php');
            include('../login/pageFiles/pagenav.php');
            include('../login/pageFiles/pagefooter.php');
            break;
        case 'checkLogin':
            $data = checkValidUser();
            if (isset($data) && isset($data['id'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            include('../login/pageFiles/pageheader.php');
            include('../login/pageFiles/pagenav.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
        //if mode is set to logout, destroy session and cookies
        case 'logout':
            //destroy session variables and display login form
            session_destroy();
            setcookie(session_name(), '', time()-1000, '/');
            $_SESSION = array();
            include('../login/pageFiles/pageheader.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
//View pages are here
        case 'viewRegistration':
            include('../login/pageFiles/pageheader.php');
            include('../login/views/viewRegistration.php');
            include('../login/pageFiles/pagefooter.php');
            break;
//Default view if no mode is set, which defaults to the login page
        default:
            include('../login/pageFiles/pageheader.php');
            if (isset($_SESSION['id']))
                include('../login/pageFiles/pagenav.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
    }
?>
