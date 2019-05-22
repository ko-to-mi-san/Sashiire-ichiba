<?php

function get_err_touroku($username,$password,$mail){
    $err_msg    = array();  
     //エラー条件一覧 =====================================
        if (mb_strlen($username) === 0){
            $err_msg[] = 'ユーザーIDを入力してください';
        }elseif(mb_strlen($username) !== 0 && preg_match("/^[a-zA-Z0-9]+$/", $username) === 0){
            $err_msg[] = 'ユーザーIDは半角で入力してください';
        }
        
        if(mb_strlen($username) !== 0 && mb_strlen($username) < 6){
            $err_msg[] = 'ユーザーIDは6文字以上で入力してください';
        }
        
        if (mb_strlen($password) === 0){
            $err_msg[] = 'パスワードを入力してください';
        }elseif(mb_strlen($password) !== 0 && preg_match("/^[a-zA-Z0-9]+$/", $password) === 0){
            $err_msg[] = 'パスワードは半角で入力してください';
        }
        
        if(mb_strlen($password) !== 0 && mb_strlen($password) < 6){
            $err_msg[] = 'パスワードは6文字以上で入力してください';
        }
        
        if (mb_strlen($mail) === 0){
            $err_msg[] = 'メールアドレスを入力してください';
        }elseif(mb_strlen($mail) !== 0 && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/", $mail) === 0){
            $err_msg[] = 'メールアドレスを正しく入力してください';
        }
        return $err_msg;
}
 
function get_username($dbh,$username) {
    $sql = 
        'SELECT 
            COUNT(username) AS username FROM users WHERE username = "' . $username . '"';

    return get_as_array_fetch($dbh, $sql);
}

function get_mail($dbh,$mail) {
    $sql = 
        'SELECT 
            COUNT(mail) AS mail FROM users WHERE mail = "' . $mail . '"';

    return get_as_array_fetch($dbh, $sql);
}

function get_err_touroku2($mailcheck,$namecheck){
    $err_msg = array();  
    if ($mailcheck === '1'){
        $err_msg[] = 'そのメールアドレスはすでに登録されています';
    }
    if($namecheck === '1'){
        $err_msg[] = 'そのユーザーIDはすでに登録されています';
    }
    return $err_msg;
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
