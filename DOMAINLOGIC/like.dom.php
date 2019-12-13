<?php
    include_once __DIR__ . "/../CLASSES/LIKE/like.php";

    session_start();

    $action = $_POST['action'];

    $objectID = $_POST['objectID'];
    $objectType = $_POST['objectType'];
    $userID = $_SESSION['userID'];
 
    $like = new Like();

    if($action == 'add'){
        $like->add_like($objectID,$objectType,$userID);
    }
    else{
        $like->remove_like($objectID,$objectType,$userID);
    }
    

    echo $like->get_likes($objectID,$objectType) . ' Likes';
?>