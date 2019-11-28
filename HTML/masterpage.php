<?php
    include_once __DIR__ . "/../UTILS/moduleLoader.php";
       if(isset($_GET['ErrorMSG'])){
    $error = $_GET['ErrorMSG'];  
    echo "<script>alert('$error');</script>";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php include_once "navigationmodule.php";?>
        <div class="container p-5">
            <?php  load_modules($content); ?>
        </div>
        <footer>
        </footer>
    </body>
</html>