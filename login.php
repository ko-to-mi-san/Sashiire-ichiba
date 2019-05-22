<?php
// 設定ファイル読み込み
require_once './conf/const.php';
// 関数ファイル読み込み
require_once './model/cmn_model.php';
require_once './model/login_model.php';
 
//変数の宣言
$username = '';
$password = '';
$err_msg =array();


// セッション開始
session_start();
// セッション変数からログイン済みか確認
if (isset($_SESSION['user_id'])) {
  // ログイン済みの場合、ホームページへリダイレクト
  header('Location: top.php');
  exit;
}elseif(isset($_SESSION['err_msg'])){
    $err_msg[] = $_SESSION['err_msg'];
}

 try{
      // DB接続
  $dbh = get_db_connect();
 }catch (PDOException $e) {
    $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
 }
 
  if (isset($_POST['login'])){
                
    $username = $_POST['userid'];
    $password = $_POST['password'];
    
 
        if (get_logincheck($dbh,$username,$password)) {
            $user_id = get_userid($dbh,$username,$password);
            // セッション変数にuser_idを保存
            $_SESSION['user_id'] = $user_id;
            // ログイン済みユーザのホームページへリダイレクト
            header('Location: top.php');
            exit;
        } else {
            $_SESSION['err_msg'] = 'ユーザーIDとパスワードを確認してください';
            // ログインページへリダイレクト
            header('Location: login.php');
            exit;
        }
  }
 
    // ===================================================================


// 商品一覧テンプレートファイル読み込み
    include_once './view/login_view.php';

