<?php

include('./dbconfig.php');

$pdo=db_conn();
$targetDirectory = 'images/';
$imageId = $_GET['id'];

if(!empty($imageId)){
    $sql = "SELECT Image_name FROM gs_bm_table WHERE id = ". $imageId;

    $sth = $pdo->prepare($sql);
    $sth ->execute();
    $getImageName = $sth->fetch();

    $deleteImage = unlink($targetDirectory . $getImageName['Image_name']);

    if($deleteImage) {
        $deleteRecord = $pdo->query("DELETE FROM gs_bm_table WHERE id = " . $imageId);

        if($deleteRecord) {
            header('Location:' . './index.php', true, 303 );
            exit();
        }
    }
}