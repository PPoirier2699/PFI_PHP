<?php
    if(isset($_GET['ErrorMSG'])){
        $error = $_GET['ErrorMSG'];  
        echo "<script>alert('$error');</script>";
    }
?>
<div class='form-group shadow-textarea p-4' style='margin: 90px 490px 0px -80px'>
<h3>Create a new Album</h3><br>
<form action='DOMAINLOGIC/newAlbum.dom.php' method='post'>
    <input class='form-control mb-2' placeholder='Title' name='title'>
    <textarea class='form-control z-depth-1' rows='4' placeholder='Description' name='description'></textarea><br>
    <button class='btn btn-secondary btn-sm btn-block' type='submit'>New Album</button> 
</form>
</div>