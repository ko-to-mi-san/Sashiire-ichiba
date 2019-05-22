<?php

function cart_delete($dbh,$user_id){
            $sql ='DELETE
                    FROM
                    carts
                    WHERE carts.user_id ="' . $user_id . '"';
      return get_as_array($dbh, $sql);
}

function cart_kosuu_change($dbh,$user_id,$item_id,$amount,$kosuu){
    $newstock = $kosuu - $amount;
    $now_date = date('Y-m-d H:i:s');
            $sql = 'UPDATE
                    items
                    SET
                     stock = "' . $newstock . '",
                    updatedate = "' . $now_date . '"
                    WHERE item_id ="' . $item_id . '"';
      return get_as_array($dbh, $sql);
}

function items_soldplus($dbh,$user_id,$item_id,$sold){
        $now_date = date('Y-m-d H:i:s');
            $sql = 'UPDATE
                    items
                    SET
                    sold = "' . ++$sold . '",
                    updatedate = "' . $now_date . '"
                    WHERE item_id ="' . $item_id . '"';
      return get_as_array($dbh, $sql);
}


function get_err_buy2($kosuu,$koukai,$amount){
    $err_msg = array();  
    if($kosuu === '0'){
        $err_msg[] = '在庫がありません';
    }
    if($koukai === '0'){
        $err_msg[] = '非公開の商品です';
    }
    if($kosuu < $amount){
        $err_msg[] = '在庫が足りないため、購入できませんでした';
    }
    return $err_msg;
}

function get_cart2($dbh,$user_id) {
 
  // SQL生成
  $sql = 'SELECT
        carts.cart_id,
 		items.item_id,
 		carts.user_id,
 		items.name,
        items.price,
        items.img,
        items.status,
        items.stock,
        items.sold,
        carts.amount
        FROM
        items
        INNER JOIN carts
        ON items.item_id = carts.item_id WHERE carts.user_id ="' . $user_id . '"';
 
  return get_as_array_fetch($dbh, $sql);
}
