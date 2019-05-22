<?php

function cartcheck($dbh,$user_id,$item_id){
        
        $sql ='SELECT cart_id,amount 
         FROM carts
         WHERE user_id ="' . $user_id . '" AND item_id ="' . $item_id . '"';
            return get_as_array_fetch($dbh, $sql);
      
}

function cart_in($dbh,$user_id,$item_id){
    $i = 0;
    $now_date = date('Y-m-d H:i:s');
    $cart = cartcheck($dbh,$user_id,$item_id);
        if(count($cart,1) === 0){
            $sql ='INSERT INTO carts
                    (user_id, item_id,amount,createdate)
                    VALUES
                    ("' . $user_id . '","' . $item_id . '",1,"' . $now_date . '")';
        }else{
            $sql = 'UPDATE
                    carts
                    SET
                     amount = "' . ++$cart[0]['amount'] . '",
                    updatedate = "' . $now_date . '"
                    WHERE user_id ="' . $user_id . '" AND item_id ="' . $item_id . '"';
        }
      
      return get_as_array($dbh, $sql);
}


function get_err_buy2($kosuu,$koukai){
    $err_msg = array();  
    if($kosuu === '0'){
        $err_msg[] = '在庫がありません';
    }
    if($koukai === '0'){
        $err_msg[] = '非公開の商品です';
    }
    return $err_msg;
}

function get_cart($dbh,$user_id) {
 
  // SQL生成
  $sql = 'SELECT
        carts.cart_id,
 		items.item_id,
 		carts.user_id,
 		items.name,
        items.price,
        items.img,
        carts.amount
        FROM
        items
        INNER JOIN carts
        ON items.item_id = carts.item_id WHERE carts.user_id ="' . $user_id . '"';
 
  return get_as_array_fetch($dbh, $sql);
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


function get_err_change($newamount){
    $err_msg = array();  
    if (mb_strlen($newamount) === 0){
        $err_msg[] = '個数を入力してください';
    }elseif(mb_strlen($newamount) !== 0 && ctype_digit($newamount) === FALSE){
        $err_msg[] = '個数は整数で入力してください(半角で入力してください)';
    }
    return $err_msg;
}

// 在庫数変更
 function zaikochange($dbh,$newamount,$change_cartid) {
    $sql = 'UPDATE  carts SET  amount = "' . $newamount . '" WHERE cart_id = "' . $change_cartid . '"'; 
  return get_as_array($dbh, $sql);
}

// 商品削除
 function item_delete($dbh,$change_cartid) {
     $sql = 'DELETE  FROM carts WHERE cart_id = "' . $change_cartid . '"'; 
    return get_as_array($dbh, $sql);
}

