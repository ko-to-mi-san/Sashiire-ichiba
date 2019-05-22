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
require_once './model/top_model.php';

//変数の宣言
$rows = 0;
$item_id = 0;
$kosuu = 0;
$nedan = 0;
$new_kosuu = 0;
$koukai = 0;
$gazou = 0;
$syohin_name = 0;
$goukei = 0;
$newamount = 0;
$change_cartid = 0;
$sum = 0;

$img_dir    = './img/';    // アップロードした画像ファイルの保存ディレクトリ
$rows       = array();
$rankrows       = array();
$err_msg    = array();     // エラーメッセージ
$new_img_filename = '';


try{
      // DB接続
  $dbh = get_db_connect();
      
    // トランザクション開始================================================
      $dbh->beginTransaction();
     
}catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
}
    // ===================================================================
    $rankrows = get_ranking($dbh);
    
         // 既存のアップロードされた画像ファイル名の取得
    $rows = get_img_name($dbh);
    $rows = array_reverse($rows);
    
// 商品一覧テンプレートファイル読み込み
    include_once './view/top_view.php';
    

