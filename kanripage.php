<?php
// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/cmn_model.php';
require_once './model/kanri_model.php';
 
//変数の宣言
$rows = 0;
$name = 0;
$price = 0;
$number = 0;
$status = 0;
$namebox = 0;
$category = 0;
$season = 0;
$mens = 0;
$senior = 0;
$kids = 0;
$daininzu = 0;
$setumei = 0;
$setumeibox = 0;


$img_dir    = './img/';    // アップロードした画像ファイルの保存ディレクトリ
$rows       = array();
$err_msg    = array();     // エラーメッセージ
$new_img_filename = '';
$process_kind = "";
$result_msg = array();
$change_itemid = 0;
$change_setumei = 0;
 

if (isset($_POST['submit'])){
     
    $namebox = $_POST['name'];
    $name = htmlentities($namebox, ENT_QUOTES, 'UTF-8');
    $price = $_POST['price'];
    $number = $_POST['number'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    
        if(isset($_POST['season'])){
        $season = $_POST['season'];
        }
        if(isset($_POST['mens'])){
        $mens = $_POST['mens'];
        }
        if(isset($_POST['senior'])){
        $senior = $_POST['senior'];
        }
        if(isset($_POST['kids'])){
        $kids = $_POST['kids'];
        }
       if(isset($_POST['daininzu'])){
        $daininzu = $_POST['daininzu'];
       }
       if(isset($_POST['setumei'])){
        $setumeibox = $_POST['setumei'];
        $setumei = htmlentities($setumeibox, ENT_QUOTES, 'UTF-8');
       }
       
    $process_kind = $_POST['process_kind'];
    list($err_msg,$new_img_filename) = get_err_submit($name,$price,$number,$status,$category);
}

if (isset($_POST['change'])){
    
    $newnumber = $_POST['number_change'];
    $change_itemid = $_POST['change_itemid'];
    $process_kind = $_POST['process_kind'];
    $err_msg = get_err_change($newnumber);
}
    
 try{
      // DB接続
  $dbh = get_db_connect();
      
    // トランザクション開始================================================
      $dbh->beginTransaction();
     if (count($err_msg) === 0 && isset($_POST['submit'])){
            try {
                // 商品情報テーブルにデータ作成
                table_dataIn($dbh,$name,$price,$new_img_filename,$status,$number,$category,$season,$mens,$senior,$kids,$daininzu,$setumei);

                // コミット処理
                $dbh->commit();
                
                $result_msg = result_msg($process_kind);
               
                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
         }elseif (count($err_msg) === 0 && isset($_POST['change'])){

            try {
                zaikochange($dbh,$newnumber,$change_itemid);
                 // コミット処理
                $dbh->commit();
                $result_msg = result_msg($process_kind);

                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
         }elseif(isset($_POST['koukai'])){
            $change_status = $_POST['change_status'];
            $change_itemid = $_POST['change_itemid'];
            $process_kind = $_POST['process_kind'];
             try {
                koukai_status($dbh,$change_status,$change_itemid);
                 // コミット処理
                $dbh->commit();
                $result_msg = result_msg($process_kind);
                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
             
         }elseif (isset($_POST['delete'])){
            $change_itemid = $_POST['change_itemid'];
            $process_kind = $_POST['process_kind'];
            try {
                item_delete($dbh,$change_itemid);
                 // コミット処理
                $dbh->commit();
                $result_msg = result_msg($process_kind);

                } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
                } 
         }
         elseif (isset($_POST['setumei_change'])){
            $change_setumei_box = $_POST['change_setumei'];
            $change_setumei = htmlentities($change_setumei_box, ENT_QUOTES, 'UTF-8');
            $change_itemid = $_POST['change_itemid'];
            $process_kind = $_POST['process_kind'];
                try {
                    change_setumei($dbh,$change_setumei,$change_itemid);
                     // コミット処理
                    $dbh->commit();
                    $result_msg = result_msg($process_kind);

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
     // 既存のアップロードされた画像ファイル名の取得
    $rows = get_img_name($dbh);
    $rows = array_reverse($rows);

// 商品一覧テンプレートファイル読み込み
    include_once './view/kanri_view.php';
