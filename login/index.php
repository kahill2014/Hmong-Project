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
        case 'register':
            $data = registerUser();
            if (isset($data) && isset($data['email'])) {
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            include('../login/pageFiles/pageheader.php');
            include('../login/pageFiles/pagenav.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
        case 'checkLogin':
            $data = checkValidUser();
            if (isset($data) && isset($data['email'])) {
                $_SESSION['email'] = $data['email'];
            }
            include('../login/pageFiles/pageheader.php');
            include('../login/pageFiles/pagenav.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
        case 'logout':
            //destroy session variables and display login form
            session_destroy();
            setcookie(session_name(), '', time()-1000, '/');
            $_SESSION = array();
            include('../login/pageFiles/pageheader.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
        default:
            include('../login/pageFiles/pageheader.php');
            include('../login/views/defaultview.php');
            include('../login/pageFiles/pagefooter.php');
            break;
    }
?>
