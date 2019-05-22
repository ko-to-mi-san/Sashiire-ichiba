<?php

function get_logincheck($dbh,$username,$password) {
    $sql = 
        'SELECT 
            COUNT(username)  AS username FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"';
        $logincheck = get_as_array_fetch($dbh, $sql);
    if($logincheck[0]['username'] === '1'){
            return TRUE;
        }else{
            return FALSE;
    }

}

function get_userid($dbh,$username,$password) {
    $sql = 
        'SELECT 
            user_id  FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"';
     $user_id = get_as_array_fetch($dbh, $sql);
     return $user_id[0]['user_id'];

}


function user_touroku($dbh,$username,$mail,$password){
 // 現在日時を取得
    $now_date = date('Y-m-d H:i:s');
  // SQL生成
    $sql = 'INSERT INTO users(username,password,mail,createdate) VALUES("' . $username . '","' . $password . '","' . $mail . '","' . $now_date . '")';
    //var_dump($sql);
  // クエリ実行
  return get_as_array($dbh, $sql);
}

