<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <style>
.loginbox{
    margin: 0 auto;
    width: 960px;
    text-align: center;
}
.login_btn{
    border: 0px;
    width: 132px;
    height: 35px;
    background: url(view/sozai/login.png) no-repeat;
    margin-top: 20px;
          
}
      
.login_btn:hover{
    cursor: pointer;
}

.touroku_btn{
    border: 0px;
    width: 132px;
    height: 35px;
    background-size: 50%;
    background: url(view/sozai/sinki.png) no-repeat;
    margin-top: 20px;
}
      
.touroku_btn:hover{
	cursor: pointer;
}

  </style>
</head>
<body>
<div class="loginbox">
    <h1>ログイン</h1>
    
    <?php foreach ($err_msg as $raw) { ?>
      <p><?php print $raw ;
        } ?>
    <form action="login.php" method="post">
        ユーザーID：<input type="text" name="userid"><br>
        パスワード：<input type="password" name="password"><br>
        <input type="submit" value="" class="login_btn" name="login">
        </form>
    <h1>会員登録がお済みでない方</h1>
        <p>初めてご利用の方はこちらから会員登録を行ってください。</p>
        <input type="submit" value="" class="touroku_btn" onClick="location.href='kaiinTouroku.php'">
 </div>
</body>
</html>