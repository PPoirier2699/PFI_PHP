<?php
    include_once __DIR__ . "/../CLASSES/USER/user.php";

    $userNewCount = $_POST['userNewCount'];
    $searchdWord = $_POST['searchWord'];

    $user = new User;
    $usersRes = $user->search_user($searchdWord,$userNewCount);
    $user->display_user_search($usersRes);
    $user->no_more_users_to_display($userNewCount,$usersRes); 
?>