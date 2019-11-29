<?php
if(isset($_SESSION['userID'])){
    $navLinks = array('<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.
                            $_SESSION['userName'] .
                            '</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">              
                                <a class="dropdown-item" href="myProfile.php">My Profile</a>
                                <a class="dropdown-item" href="DOMAINLOGIC/logout.dom.php">Logout</a>
                            </div>
                        </div>',                  
                      '<a style="color:black;" class="nav-link" href="newAlbum.php">New album</a>');
}
else{
    $navLinks = array('<a style="color:black;" class="nav-link" href="login.php">Login</a>',
    '<a style="color:black;" class="nav-link" href="register.php">Register</a>');
}
?>
<div class="jumbotron text-center" style="padding: 7em; margin-bottom:0; background-color: #D24545;">

    <h2 class="display-4">Final Project</h2>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light shadow" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1;">
            <ul class="navbar-nav">
                <?php 
                for($i = 0; $i < count($navLinks); $i++){
                    echo "<li class='nav-item mr-3'>";
                    echo $navLinks[$i];
                    echo "</li>";
                }      
                ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="mainPage.php"><img src="IMG/home.png" height="30px"></a>
                </li>                
            </ul>
        </nav> 
    </div>
</div>