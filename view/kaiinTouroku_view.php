<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規会員登録</title>
  <style>
.box{
    margin: 0 auto;
    width: 960px;
    text-align: center;
}

.touroku_btn{
    border: 0px;
    width: 132px;
    height: 35px;
    background-size: 50%;
    background: url(view/sozai/touroku.png) no-repeat;
    margin-top: 20px;
}
      
.touroku_btn:hover{
	cursor: pointer;
}

  </style>
</head>
<body>
    <div class="box">
    <h1>ユーザー会員登録</h1>
    <p>*マークの箇所は必須項目です。必ず入力してください。</p>
    <form action="tourokukanryou.php" method="post">
        *ユーザーID：<input type="text" name="userid"><br>
        *メールアドレス：<input type="text" name="mail"><br>
        *パスワード：<input type="password" name="password"><br>
        <input type="submit" value="" class="touroku_btn" name="touroku">
        </form>
        </div>
 
</body>
</html>