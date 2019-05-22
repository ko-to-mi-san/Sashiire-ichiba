<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録完了</title>
   <style>
  .box{
            margin: 0 auto;
            width: 960px;
            text-align: center;
      }

  </style>
</head>
<body>
    <div class ="box">
 <?php foreach ($err_msg as $raw) { ?>
      <p><?php print $raw ;
        }
        ?></p>
      
      <?php
      if(count($err_msg) === 0){
            print '<h1>ユーザー登録が完了しました</h1>';
            print '<a href="login.php"><img src="view/sozai/login.png" alt=""></a>';
    }else{
        print '<a href="login.php"><img src="view/sozai/modoru.png" alt=""></a>';
    }
      ?>
 </div>
</body>
</html>