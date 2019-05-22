<?php

function get_err_submit($name,$price,$number,$status,$category){
    $err_msg    = array();  
    $img_dir    = './img/';
    $new_img_filename = '';
    // HTTP POST でファイルがアップロードされたかどうかチェック
    if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
        // 画像の拡張子を取得
        $extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
        $extension =mb_strtolower($extension);
        // 指定の拡張子であるかどうかチェック
        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
            // 保存する新しいファイル名の生成（ユニークな値を設定する）
            $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
            // 同名ファイルが存在するかどうかチェック
            if (is_file($img_dir . $new_img_filename) !== TRUE) {
            // アップロードされたファイルを指定ディレクトリに移動して保存
                if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
                    $err_msg[] = 'ファイルアップロードに失敗しました';
                }
            } else {
                $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
            }
      } else {
        $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEGとPNGのみ利用可能です。';
      }
    } else {
      $err_msg[] = 'ファイルを選択してください';
    }

     //エラー条件一覧 =====================================
        if (mb_strlen($name) === 0){
            $err_msg[] = '名前を入力してください';
        }
        
        if (mb_strlen($price) === 0){
            $err_msg[] = '値段を入力してください';
        }elseif(mb_strlen($price) !== 0 && ctype_digit($price) === FALSE){
            $err_msg[] = '値段は整数で入力してください(半角で入力してください)';
        }
        
        if (mb_strlen($number) === 0){
            $err_msg[] = '個数を入力してください';
        }elseif(mb_strlen($number) !== 0 && ctype_digit($number) === FALSE){
            $err_msg[] = '個数は整数で入力してください(半角で入力してください)';
        }
        
        if(empty($new_img_filename)){
            $err_msg[] = '画像を登録してください';
        }
        
        if($status !== '0' && $status !== '1'){
            $err_msg[] = 'ステータスを選択してください';
        }
        
        if($category !== '100' && $category !== '200' && $category !== '300' && $category !== '400'){
            $err_msg[] = '商品カテゴリーを選択してください';
        }
        return array($err_msg, $new_img_filename);
}

function get_err_change($newnumber){
    $err_msg = array();  
    if (mb_strlen($newnumber) === 0){
        $err_msg[] = '個数を入力してください';
    }elseif(mb_strlen($newnumber) !== 0 && ctype_digit($newnumber) === FALSE){
        $err_msg[] = '個数は整数で入力してください(半角で入力してください)';
    }
    return $err_msg;
}

 
 // テーブルにデータ作成
function table_dataIn($dbh,$name,$price,$new_img_filename,$status,$number,$category,$season,$mens,$senior,$kids,$daininzu,$setumei) {
 // 現在日時を取得
    $now_date = date('Y-m-d H:i:s');
  // SQL生成
    $sql = 'INSERT INTO items(name,price,img,status,stock,category,season,mens,senior,kids,daininzu,comment,createdate) VALUES("' . $name . '","' . $price . '","' . $new_img_filename . '","' . $status . '","' . $number . '","' . $category . '","' . $season . '","' . $mens . '","' . $senior . '","' . $kids . '","' . $daininzu . '","' . $setumei . '","' . $now_date . '")';
    //var_dump($sql);
  // クエリ実行
  return get_as_array($dbh, $sql);
}

 // 公開ステータス変更
 function koukai_status($dbh,$change_status,$change_itemid) {
     if($change_status === '1'){
        $sql = 'UPDATE  items SET  status = "0" WHERE item_id = "' . $change_itemid . '"';
     }else{
         $sql = 'UPDATE  items SET  status = "1" WHERE item_id = "' . $change_itemid . '"';
     }
  return get_as_array($dbh, $sql);
}
 

// 在庫数変更
 function zaikochange($dbh,$newnumber,$change_itemid) {
    $sql = 'UPDATE  items SET  stock = "' . $newnumber . '" WHERE item_id = "' . $change_itemid . '"'; 
  return get_as_array($dbh, $sql);
}

// 商品削除
 function item_delete($dbh,$change_itemid) {
     $sql = 'DELETE  FROM items WHERE item_id = "' . $change_itemid . '"'; 
    return get_as_array($dbh, $sql);
}

// 説明変更
 function change_setumei($dbh,$change_setumei,$change_itemid) {
    $sql = 'UPDATE  items SET  comment = "' . $change_setumei . '" WHERE item_id = "' . $change_itemid . '"'; 
  return get_as_array($dbh, $sql);
}


function result_msg($process_kind){
    $result_msg = array(); 
if ($process_kind === 'insert_item') {
  $result_msg[] = '商品を追加しました';
} else if ($process_kind === 'update_stock') {
  $result_msg[] = '在庫数を更新しました';
} else if ($process_kind === 'change_status') {
  $result_msg[] = 'ステータスを更新しました';
}else if($process_kind === 'delete'){
    $result_msg[] = '商品を削除しました';
}else if($process_kind === 'update_setumei'){
    $result_msg[] = '説明文を更新しました';
}
return $result_msg;
}
