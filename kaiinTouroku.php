<?php
// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/cmn_model.php';
 
//変数の宣言

$rows       = array();

 try{
      // DB接続
  $dbh = get_db_connect();
 }catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
 }
    // ===================================================================


// 商品一覧テンプレートファイル読み込み
    include_once './view/kaiinTouroku_view.php';

