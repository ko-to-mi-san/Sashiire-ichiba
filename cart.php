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
require_once './model/cart_model.php';
 
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
$err_msg    = array();     // エラーメッセージ
$new_img_filename = '';

if (isset($_POST['change'])){
    
    $newamount = $_POST['amount_change'];
    $change_cartid = $_POST['change_cartid'];
    $err_msg = get_err_change($newamount);
}

 
try{
      // DB接続
  $dbh = get_db_connect();
      
    // トランザクション開始================================================
      $dbh->beginTransaction();
     if (isset($_POST['cartin']) && isset($_POST['itemid'])){
                
        $item_id = $_POST['itemid'];
        $rows = get_img_name($dbh);
                
            foreach ($rows as $key=>$val){
                if ($val['item_id'] == $item_id) {
                    break;
                }
            }
        $nedan = $rows[$key][2];
        $kosuu = $rows[$key][5];
        $koukai = $rows[$key][4];
        $gazou = $rows[$key][3];
        $syohin_name = $rows[$key][1];
            
        try {
                if($kosuu !== '0' && $koukai === '1'){
                // カートイン
                    cart_in($dbh,$user_id,$item_id);
                }else{
                    $err_msg = get_err_buy2($kosuu,$koukai);
                }
                
                // コミット処理
                $dbh->commit();
                
            } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
            } 
             
        }elseif (count($err_msg) === 0 && isset($_POST['change'])){

            try {
                zaikochange($dbh,$newamount,$change_cartid);
                 // コミット処理
                $dbh->commit();

                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
        }elseif (isset($_POST['delete'])){
            $change_cartid = $_POST['change_cartid'];
            try {
                item_delete($dbh,$change_cartid);
                 // コミット処理
                $dbh->commit();

                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
         }
}catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
}
    // ===================================================================
    $rows = get_cart2($dbh,$user_id);
    $rows = array_reverse($rows);
    //合計値を求める
    foreach($rows as $value){
    $sum = $sum + $value['price']*$value['amount'];
    }
    
// 商品一覧テンプレートファイル読み込み
    include_once './view/cart_view.php';
