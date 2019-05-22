<?php
// セッション開始
session_start();

// セッション変数を全て削除
$_SESSION = array();

// セッションIDを無効化
session_destroy();
// ログアウトの処理が完了したらログインページへリダイレクト
header('Location: login.php');
exit;

