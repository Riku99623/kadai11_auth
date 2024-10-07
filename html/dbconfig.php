<?php

//エラー表示
ini_set("display_errors", 1);

function db_conn(){
try {
  //Password:MAMP='root',XAMPP=''
  return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  
  } catch (PDOException $e) {
  exit('DB Connection Error:'.$e->getMessage());
}
}

function sql_error($stmt){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//リダイレクト
function redirect($file_name){
  header("Location: ".$file_name);
  exit();
}

//SessionCheck(スケルトン)
function sschk(){
if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
  exit("Login Error");
}else{
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}
}
