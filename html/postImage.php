<?php

include('./dbconfig.php');

$pdo=db_conn();
$targetDirectory = 'images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)){
    $arrImageTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType,$arrImageTypes)){
        $postImageForSever = move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath);

        if($postImageForSever){
            $insert = $pdo->query("INSERT INTO gs_bm_table (Image_name) VALUES ('".$fileName."')");
        }
    }
}

header('Location:'.'./index.php',true,303);
exit();