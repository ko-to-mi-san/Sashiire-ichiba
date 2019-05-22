<?php
/**
* DBハンドルを取得
* @return obj $dbh DBハンドル
*/
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

function get_as_array($dbh, $sql) {
 
  try {
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
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

function get_img_name($dbh) {
 
  // SQL生成
  $sql = 'SELECT
            items.item_id,
            items.name,
            items.price,
            items.img,
            items.status,
            items.stock,
            items.sold,
            items.category,
            items.season,
            items.mens,
            items.senior,
            items.kids,
            items.daininzu,
            items.comment
            FROM items';
  return get_as_array_fetch($dbh, $sql);
}

