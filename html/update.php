<?php

include('./dbconfig.php');

$pdo=db_conn();
$targetDirectory = 'images/';
$fileName = basename($_FILES['file']['name']);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$imageId = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)){
    $arrImageTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType,$arrImageTypes)) {
        $sql = "SELECT Image_name FROM gs_bm_table WHERE id = " . $imageId;

        $sth = $pdo->prepare($sql);
        $sth->execute();
        $getImageName = $sth->fetch();
    
        $deleteImage = unlink($targetDirectory . $getImageName['Image_name']);

    if($deleteImage) {
        $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        
        if($uploadImageForServer) {
            $update = $pdo->query("UPDATE gs_bm_table SET Image_name ='" . $fileName . "' WHERE id = " . $imageId);

            header('Location: ' . './index.php', true , 303);
            exit();
        }
    
    }
  }
}