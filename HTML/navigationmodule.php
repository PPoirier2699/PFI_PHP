<?php
if(isset($_SESSION['userID'])){
    $navLinks = array('<a style="color:black;" class="nav-link" href="myProfile.php">' . $_SESSION['userName'] . '</a>',
                      '<a style="color:black;" class="nav-link" href="DOMAINLOGIC/logout.dom.php">Logout</a>');
}
else{
    $navLinks = array('<a style="color:black;" class="nav-link" href="login.php">Login</a>',
    '<a style="color:black;" class="nav-link" href="register.php">Register</a>');
}
array_push($navLinks,'<a style="color:black;" class="nav-link" href="newAlbum.php">New album</a>');
?>
<div class="jumbotron text-center" style="padding: 7em; margin-bottom:0; background-color: #D24545;">

    <h2 class="display-4">Final Project</h2>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light shadow" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1;">
                
            <ul class="navbar-nav">
                <?php 
                for($i = 0; $i < count($navLinks); $i++){
                    echo "<li class='nav-item'>";
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