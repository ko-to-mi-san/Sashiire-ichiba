<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>購入</title>
     <meta charset="utf-8">
    <link rel="stylesheet" href="view/html5reset-1.6.1.css">
      <link rel="stylesheet" href="view/top_view.css">
    <style>
        
        img {
            width:auto;
            height:auto;
            max-width:100%;
            max-height:100%;
        }
        .imgbox{
           width:250px;
        }
        .center{
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
        .sum{
            width: 100%;
            text-align: right;
            margin-bottom: 40px;
            border-top: solid 3px #555;
        }
          .top_btn{
        border: 0px;
        width: 132px;
        height: 35px;
        background: url(view/sozai/tophemodoru.png) no-repeat;
          
        }
      
      .top_btn:hover{
	    cursor: pointer;
        }
h2{
    font-family: 'Avenir','Helvetica Neue','Helvetica','Arial','Hiragino Sans','ヒラギノ角ゴシック',YuGothic,'Yu Gothic','メイリオ', Meiryo,'ＭＳ Ｐゴシック','MS PGothic';
    font-weight: bold;
    font-size: 22px;
    padding: 10px 0;
    margin-bottom: 10px;
    color: #000000;
}
.resultitem{
    margin-bottom: 20px;
}
    </style>
</head>
<body>
     <header>
          <div class="headerBox">
            <div class="logo">
                <a href ="top.php"><img src="view/sozai/logo.png"></a>
            </div>

            <div class="searchBox">
                <form action="#" name="search2" method="post">
	                <dl class="search2">
	            	<dt><input type="text" name="search" value="" placeholder="キーワードで検索"></dt>
		            <dd><button><span></span></button></dd>
	                </dl>
                </form>
            </div>
            
            <div class="cart_login">
                <a class="loginimg" href ="logout.php"><p class = "pLogo">ログアウト</p></a>
                <a class="cartimg" href ="cart.php"><p class = "pLogo">カート</p></a>
            </div>
            <ul class="headfoot">
                <li class="headfoot"><a href="okashi.php" class="head">お菓子</a></li>
                <li class="headfoot"><a href="tabemono.php" class="head">食べ物</a></li>
                <li class="headfoot"><a href="bodycare.php" class="head">ボディケア</a></li>
                <li class="headfoot"><a href="mens.php" class="head">メンズ向け</a></li>
                <li class="headfoot"><a href="kids.php" class="head">キッズ向け</a></li>
                <li class="headfoot"><a href="daininzu.php" class="head">大人数向け</a></li>
            </ul>
          </div>
      </header>
      <main>
          <div class="center">
    <?php 
   if(count($err_msg) === 0){
        print'<h2>ありがとうございます。商品が購入されました。</h2>';
    }else{
        foreach ($err_msg as $raw) { ?>
        <p><?php print $raw; ?></p>
    <?php } 
        
    }
    ?>
    
   <?php 
    foreach($rows as $row){
        print '<div class="resultitem">'; 
        print '<tr>'; 
        print '<td><img class="imgbox" src="'.$img_dir . $row['img'].'"></td><br>';
        print '<td class="drink_name_width">'.$row['name'].'</td><br>';
        print '<td class="text_align_right">'.$row['price'].'円</td><br>';
        print '<td>'.$row['amount'].'個</td></tr><br></div>'?>
        <?php } ?>
        
    <div class="sum"> 
    <h2>合計：<?php print $sum.'円' ?></h2>
    <input type="submit" value="" class="top_btn" onClick="location.href='top.php'">
    </div>
    </div>
    </main>
</body>
</html>
