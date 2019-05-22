<?php

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

function get_ranking($dbh){
    $sql = 'SELECT 
            items.item_id,
            items.name,
            items.price,
            items.img,
            items.sold,
            items.stock,
            items.status
            FROM items
            WHERE items.stock > 0 AND items.status = 1
            ORDER BY sold DESC
            LIMIT 5';
            
            return get_as_array_fetch($dbh, $sql);
}

