<main>
    <h2 style="text-align:center;">Welcome To Your Profile</h2><br>
    <form action="DOMAINLOGIC/updateinfo.dom.php" method="post" enctype="multipart/form-data">
        <div id="infoProfile" class="border p-4" style="border-radius: 15px;">
            <img id="profilepic" class="border" src="<?php echo $_SESSION["profilePicPath"]?>" alt="Your profile pic">   

            <p style="text-align:center;">** You need to enter your password to change your info **</p>
            <div>Username : <input name="username" class="form-control" value='<?php echo $_SESSION["userName"]?>'></div>
            <div>E-Mail : <input name="email" class="form-control" value='<?php echo $_SESSION["userEmail"]?>'></div>
            <div>Password : <input type="password" name="oldpw" class="form-control" ></div>
            <div>New Password : <input type="password" name="pw" class="form-control" ></div>
            <div>Confirm New Password : <input type="password" name="pwValidation" class="form-control" ></div>

            
            <input class="fileinput" type="file" name="profilePicChange" id="profilePicChange">
            <label class="btn btn-primary" for="profilePicChange">Change your profile pic</label>
            <button class="btn btn-primary" type="submit" style="padding: 1% 5%;">Submit Changes</button>

            
        </div>
    </form>
</main>