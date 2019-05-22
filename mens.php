<?php

    // セッション開始
session_start();
// セッション変数からログイン済みか確認
if (isset($_SESSION['user_id'])) {
  // ログイン済みの場合、ホームページへリダイレクト
 $user_id = $_SESSION['user_id'];
}else{
    header('Location: login.php');
    exit;
}


// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/cmn_model.php';
 
//変数の宣言
$rows = 0;
$money = 0;
$drink_id = 0;

$img_dir    = './img/';    // アップロードした画像ファイルの保存ディレクトリ
$rows       = array();
$err_msg    = array();     // エラーメッセージ
$new_img_filename = '';
$process_kind = "";
$result_msg = "";
 
 try{
      // DB接続
  $dbh = get_db_connect();
      
 }catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
 }
    // ===================================================================
     // 既存のアップロードされた画像ファイル名の取得
    $rows = get_img_name($dbh);
    $rows = array_reverse($rows);

// 商品一覧テンプレートファイル読み込み
   include_once './view/mens_view.php';

