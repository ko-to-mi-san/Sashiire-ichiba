<?php

function get_db_connect() {
 
  try {
    // データベースに接続
    $dbh = new PDO(DSN, DB_USER, DB_PASSWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => DB_CHARSET));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
    throw $e;
    }
 
  return $dbh;
}

function get_as_array_fetch($dbh, $sql) {
 
  try {
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQLを実行
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
    throw $e;
    }
 
  return $rows;
}

/**
* テーブルデータ取得
*/
function get_user_name($dbh) {
 
  // SQL生成
  $sql = 'SELECT
            users.user_id,
            users.username,
            users.password,
            users.mail,
            users.createdate
            FROM users';
  return get_as_array_fetch($dbh, $sql);
}
