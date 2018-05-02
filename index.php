<?php
    session_start();
    //include database connection info
    include('databaseConnection/pdo_connect.php');
    //include functions
    include('models/model.php');
    //read the main task using the primary key 'mode'
    $mode = '';
    if (isset($_REQUEST['mode']))
        $mode = $_REQUEST['mode'];
    switch ($mode) {
//Function views are here
        case 'uploadPhoto':
            $data = uploadPhoto($_SESSION['id']);
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            if($data !== "noPhoto") {
                if ($data !== '')
                    echo "File uploaded successfully.";
                else
                    echo "File upload failed, please try again.";
            } else
                echo "Please select an image file to upload.";
            include('views/viewUploadPhoto.php');
            include('pageFiles/pagefooter.php');
            break;
        case 'gallery':
            $data = getAllPhotos();
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            echo '<div class="container">';
            echo '<div class="row">';
            for ($i=0; $i<count($data); $i++) {
                $row = $data[$i];
                echo '<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
                        '" class="img-responsive" height="512px" width="512px"/>';
                echo'</div>';
            }
            echo'</div></div>';
            echo'
                <style>
                .row{}
                img{padding-bottom: 15px;padding-top: 15px;}
                </style>';
            include('pageFiles/pagefooter.php');
            break;
        case 'registerUser':
            $data = registerUser();
            if (isset($data) && isset($data['id'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/defaultview.php');
            include('pageFiles/pagefooter.php');
            break;
        case 'checkLogin':
            $data = checkValidUser();
            if (isset($data) && isset($data['id'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/defaultview.php');
            include('pageFiles/pagefooter.php');
            break;
        //if mode is set to logout, destroy session and cookies
        case 'logout':
            //destroy session variables and display login form
            session_destroy();
            setcookie(session_name(), '', time()-1000, '/');
            $_SESSION = array();
            include('pageFiles/pageheader.php');
            include('views/defaultview.php');
            include('pageFiles/pagefooter.php');
            break;
//View pages are here
        case 'viewUploadPhoto':
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/viewUploadPhoto.php');
            include('pageFiles/pagefooter.php');
            break;
        case 'viewRegistration':
            include('pageFiles/pageheader.php');
            include('views/viewRegistration.php');
            include('pageFiles/pagefooter.php');
            break;
//Default view if no mode is set, which defaults to the login page
        default:
            include('pageFiles/pageheader.php');
            if (isset($_SESSION['id']))
                include('pageFiles/pagenav.php');
            include('views/defaultview.php');
            include('pageFiles/pagefooter.php');
            break;
    }
?>
