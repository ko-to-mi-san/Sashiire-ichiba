<?php
// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/userkanri_model.php';
 
//変数の宣言

$rows       = array();

 try{
      // DB接続
  $dbh = get_db_connect();
 }catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
 }
    // ===================================================================
     // 既存のアップロードされた画像ファイル名の取得
    $rows = get_user_name($dbh);
    $rows = array_reverse($rows);

// 商品一覧テンプレートファイル読み込み
    include_once './view/userkanri_view.php';
