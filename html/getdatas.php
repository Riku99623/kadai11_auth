<?php
$pdo= db_conn();

$uri = $_SERVER['REQUEST_URI'];

if(strpos($uri, 'imageDetail.php') !== false){
   $imageId = $_GET['id'];
   $sql = "SELECT * FROM gs_bm_table WHERE id =" . $imageId;

   $sth = $pdo->prepare($sql);
   $sth->execute();
   $data['image'] = $sth->fetch();

   $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY indate DESC";

   $sth = $pdo->prepare($sql2);
   $sth->execute();
   $data['comments'] = $sth->fetchAll(); 
   $countComment = count($data['comments']);

}else{
$sql = "SELECT * FROM gs_bm_table ORDER BY indate DESC";

$sth = $pdo->prepare($sql);
$sth->execute();
$data = $sth->fetchAll();
}

return $data;