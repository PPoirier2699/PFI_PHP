<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";

    $imageNewCount = $_POST['imageNewCount'];
    $searchdWord = $_POST['searchWord'];

    $image = new Image;
    $imagesRes = $image->search_image($searchdWord,$imageNewCount);
    $image->display_image_search($imagesRes);
    $image->no_more_images_to_display($imageNewCount,$imagesRes); 
?>