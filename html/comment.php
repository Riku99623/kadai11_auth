<?php

include("./dbconfig.php");

$pdo=db_conn();

$imageId = $_GET['image_id'];
$comment = $_POST['comment'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($comment)){
    $insert = $pdo->query("INSERT INTO comments (image_id, comment) VALUES (" . $imageId . ",'" . $comment . "')");

    if($insert) {
        $uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $uri, true, 303);
        exit();
    }
} else{
    $uri = $_SERVER['HTTP_REFERER'];
    header('Location: ' . $uri, true, 303);
    exit();
}