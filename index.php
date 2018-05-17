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
    // Logic for displaying unread message count
    $messageCount = getUnreadMessageCount($_SESSION['id']);
    switch ($mode) {
//Function views are here
        case 'searchResults':
            $data = searchFor();
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            if ($data == 'emptyResult') {
                echo 'Search returned nothing';
                break;
            }
            if ($data == 'emptyString') {
                echo 'Enter something to search';
                break;
            }
            //display search results here
            for ($i=0; $i<count($data); $i++){
                $row = $data[$i];
                echo '<div class="gallery_product col-lg-3 col-md-4 col-sm-12 filter hdpe">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
                        '" class="img-responsive" height="512px" width="512px"/>';
                echo '</div>';
            }
            break;

        case 'dashboard':
            $data = getFollowerPhotos();
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/viewCarousel.php');
            include('views/viewTab1.php');
            echo '<h2>Photos of People You follow</h2>';
            for ($i=0; $i<count($data); $i++){
                $row = $data[$i];
                echo '<div class="gallery_product col-lg-3 col-md-4 col-sm-12 col-xs-12 filter hdpe">';
                echo  '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
                                '" class="img-responsive" height="512px" width="512px"/>';
                echo '</div></div></div>';
            }
            include('pageFiles/pagefooter.php');
            break;

        case 'profile':
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            $user_data = getUserData($_SESSION['id']);
            $user_name = $user_data['username'];
            include('views/viewProfile.php');
            include('views/viewTab1.php');
            //If a user id isn't passed in for a specific profile to view, assume it's the session user
            if(!$_REQUEST['user_id']){
                $followingData = getUserFollowing($_SESSION['id']);
                $followerData = getUserFollowers($_SESSION['id']);
            } else {
                $followingData = getUserFollowing($_REQUEST['user_id']);
                $followerData = getUserFollowers($_REQUEST['user_id']);
            }
            $newFollowingData = array();
            $newFollowerData = array();
            foreach($followingData as $following){
                array_push($newFollowingData, getUserData($following['followed_id']));
            }
            foreach($followerData as $follower){
                array_push($newFollowerData, getUserData($follower['follower_id']));
            }
            $data = getUserPhotos();
            for ($i=0; $i<count($data); $i++){
                $row = $data[$i];
                $id = $row['id'];
                echo '<div class="gallery_product col-lg-4 col-md-3 col-sm-12 filter hdpe">';
                ?>
                <form name="delete_image" method="post" action="index.php?mode=delete_image">
                <?php
                echo '<input type="hidden" value='.$id.' name="image_id">';
                echo '<button class="btn btn-danger" type="submit" name="Submit" value="Delete"><span class="glyphicon glyphicon-trash"</span></button>';
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).
                                '" class="img-responsive" height="512px" width="512px"/>';
                echo '</form>';
                echo '</div>';
            }
            include('views/viewTab2.php');
            include('views/viewTab3.php');	    
            include('views/viewTab4.php');
            include('pageFiles/pagefooter.php');
            break;

        case 'delete_image':
            delete_image($_POST['image_id']);

        case 'inbox':
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/viewMessages.php');
            include('pageFiles/pagefooter.php');
            break;
        
        case 'send_message':
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/viewSendMessage.php');
            include('pageFiles/pagefooter.php');
            break;

        case 'view_message':
            include('pageFiles/pageheader.php');
            include('pageFiles/pagenav.php');
            include('views/viewMessage.php');
            include('pageFiles/pagefooter.php');
            break;

        case 'delete_message':
            deleteMessage($_POST['pms']);
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
                $user_data = getUserData($row['user_id']);
                $user_name = $user_data['username'];
                echo 'User: '.$user_name;
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
            if (stripos($data, 'already in use')) {
                echo $data;
                include('pageFiles/pageheader.php');
                include('views/viewRegistration.php');
                include('pageFiles/pagefooter.php');
                break;
            } else { 
                if (isset($data) && isset($data['id'])) {
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['username'] = $data['username'];
                }
                include('pageFiles/pageheader.php');
                if (isset($_SESSION['id']))
                    include('pageFiles/pagenav.php');
                include('views/defaultview.php');
                include('pageFiles/pagefooter.php');
                break;
            }
        case 'checkLogin':
            $data = checkValidUser();
            if (isset($data) && isset($data['id'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['user'] = $data['lastName'].', '.$data['firstName'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['username'] = $data['username'];
            }
            header("Location: index.php?mode=dashboard");
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
            if (!isset($_SESSION['id'])) {
                include('pageFiles/pageheader.php');
                if (isset($_SESSION['id']))
                    include('pageFiles/pagenav.php');
                include('views/defaultview.php');
                include('pageFiles/pagefooter.php');
            } else {
                header("Location: index.php?mode=dashboard");
            }
            break;
    }
?>
