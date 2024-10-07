<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("dbconfig.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();


//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM gs_user_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>
<body>
  <?php include('./getdatas.php') ?>
  <?php include('./header.php') ?>
  <div class="imageList">
    <?php foreach ($data as $image) { ?>
     <a href="./imageDetail.php?id=<?php echo $image['id']; ?>"><img src="./images/<?php echo $image['Image_name']; ?>" alt="投稿画像"></a>
    <?php }; ?>

</div>
</body>
</html>