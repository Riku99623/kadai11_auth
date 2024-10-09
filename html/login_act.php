<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

//1.  DB接続します
include("dbconfig.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();  //1レコードだけ取得する方法

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];

  // 管理者かどうかを判定してセッションに保存
  if ($val['kanri_flg'] == 1) {  // 'kanri_flg'が1の場合を管理者とする
      $_SESSION['is_admin'] = true;
  } else {
      $_SESSION['is_admin'] = false;
  }

  //Login成功時（index.phpへリダイレクト）
  redirect("index.php");

}else{
  //Login失敗時(login.phpへリダイレクト)
  redirect("login.php");

}

exit();
