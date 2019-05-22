<?php
// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/cmn_model.php';
require_once './model/tourokukanryou_model.php';
 
//変数の宣言
$rows = 0;
$username = 0;
$mail = 0;
$password = 0;

$rows = array();
$mailcheck       = array();
$namecheck       = array();
$err_msg    = array();     // エラーメッセージ
 
if (isset($_POST['touroku'])){
     
    $username = $_POST['userid'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $err_msg = get_err_touroku($username,$password,$mail);
}

try{
      // DB接続
        $dbh = get_db_connect();
      
    // トランザクション開始================================================
      $dbh->beginTransaction();
     if (count($err_msg) === 0 && isset($_POST['touroku'])){
                
                $namecheck = get_username($dbh,$username);
                $mailcheck = get_mail($dbh,$mail);
                
            try {
                    if($namecheck[0]['username'] === '0' && $mailcheck[0]['mail'] === '0'){
                        user_touroku($dbh,$username,$mail,$password);
                    }else{
                        $err_msg = get_err_touroku2($mailcheck[0]['mail'],$namecheck[0]['username'] );
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
}catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
}
    // ===================================================================

// 商品一覧テンプレートファイル読み込み
    include_once './view/tourokukanryou.php';
