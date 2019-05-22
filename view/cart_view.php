<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="view/html5reset-1.6.1.css">
      <link rel="stylesheet" href="view/top_view.css">
      </head>
      <body>
    <title>ショッピングカート</title>
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
   .buy_btn{
    border: 0px;
    width: 132px;
    height: 35px;
    background: url(view/sozai/kounyu.png) no-repeat;
      
    }
      
    .buy_btn:hover{
	cursor: pointer;
    }
    .change_btn{
    border: 0px;
    width: 74px;
    height: 30px;
    background: url(view/sozai/henkou.png) no-repeat;
    margin: 10px 10px 0 10px;
          
    }
      
    .change_btn:hover{
	cursor: pointer;
    }
    
    .delete_btn{
    border: 0px;
    width: 74px;
    height: 30px;
    background: url(view/sozai/delete.png) no-repeat;
    margin: 10px;
    }
      
    .delete_btn:hover{
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
    </style>
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
     
    <?php foreach ($err_msg as $raw) { ?>
      <p><?php print $raw; ?></p>
    <?php } ?>
    
    
   
   <?php 
    foreach($rows as $row){
        print '<div class="center">';
        print '<tr>'; 
        print '<td><img class="imgbox" src="'.$img_dir . $row['img'].'"></td><br>';
        print '<td class="drink_name_width">'.$row['name'].'</td><br>';
        print '<td class="text_align_right">'.$row['price'].'円</td>' ?>
    <td>
        <form method="post" enctype="multipart/form-data">
        <p><input type="text" class="input_text_width" name="amount_change" size="10" value="<?php print $row['amount']; ?>">個</p>
        <input type="hidden" name="change_cartid" value= "<?php print $row['cart_id']; ?>">
        <input type="submit" value="" class="change_btn" name="change">
    </td>
    </form>
    <td>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="change_cartid" value= "<?php print $row['cart_id']; ?>">
          <input type="submit" value="" class="delete_btn" name="delete">
        </form>  
    </td></div>
        <?php } ?>
    <div class="sum"> 
    <h2>合計：<?php print $sum.'円' ?></h2>
    <form action="result.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userid" value= "<?php print $row['user_id']; ?>">
    <input type="submit" value="" class="buy_btn" name="buy">
    </form>
    </div>   
</main>
</body>
</html>
