<?php
if(!isset($_SESSION['userID'])){        
        header("Location: login.php?ErrorMSG=Not Logged In");
        die();
}
?>

<main>
    <h2 style="text-align:center;">Welcome To Your Profile</h2>
    <form action="" method="post">
        <div id="infoProfile" class="border p-4" style="border-radius: 15px;">
            <img id="profilepic" class="border" src="<?php echo $_SESSION["profilePicPath"]?>" alt="Your profile pic">   
            <div>Username : <input class="form-control" value='<?php echo $_SESSION["userName"]?>'></div>
            <div>E-Mail : <input class="form-control" value='<?php echo $_SESSION["userEmail"]?>'></div>
            <div>Password : <input class="form-control" ></div>
            <div>Confirm Password : <input class="form-control" ></div>

            <button class="btn btn-success mb-sm-3" type="submit">Submit Changes</button>
        </div>
    </form>
</main>