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
require_once './model/result_model.php';
 
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
$amoutn = 0;
$sold = 0;

$img_dir    = './img/';    // アップロードした画像ファイルの保存ディレクトリ
$rows       = array();
$err_msg    = array();     // エラーメッセージ
$new_img_filename = '';
 
try{
      // DB接続
    $dbh = get_db_connect();
      
    // トランザクション開始================================================
    
    if (isset($_POST['buy'])){
                
        $user_id = $_POST['userid'];
        $rows = get_cart2($dbh,$user_id);
                
            
        foreach($rows as $key){
            $dbh->beginTransaction();
            
            $item_id = $key['item_id'];
            $nedan = $key['price'];
            $kosuu = $key['stock'];
            $amount = $key['amount'];
            $koukai = $key['status'];
            $gazou = $key['img'];
            $sold = $key['sold'];
            $syohin_name = $key['name'];
                
            try {
                    if($kosuu !== '0' && $koukai === '1' && $kosuu >= $amount){
                    //在庫数を減らす
                    cart_kosuu_change($dbh,$user_id,$item_id,$amount,$kosuu);
                    items_soldplus($dbh,$user_id,$item_id,$sold);
                    // カートから削除
                    cart_delete($dbh,$user_id);
                    }else{
                    $err_msg = get_err_buy2($kosuu,$koukai,$amount);
                    }
                
                // コミット処理
                $dbh->commit();
                
               
            } catch (PDOException $e) {
            // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
            } 
             
        }
    }    
 }catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
}
    
    // ===================================================================
    $rows = array_reverse($rows);
    //合計値を求める
    foreach($rows as $value){
        $sum = $sum + $value['price']*$value['amount'];
    }
    
// 商品一覧テンプレートファイル読み込み
    include_once './view/result_view.php';

