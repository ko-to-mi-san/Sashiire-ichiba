
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>商品一覧</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="view/html5reset-1.6.1.css">
      <link rel="stylesheet" href="view/top_view.css">
<style>

.item {
border: solid 0px;
width: 250px;
height: 250px;
text-align: center;
float: left; 
}

span {
display: block;
margin: 3px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

.ichiran {
height:170px;
width:170px;
object-fit: contain;
}

.red {
color: #FF0000;
}

.lineup{
display:block;
width: 100%;
margin: 0 auto;
text-align:center
}

.cartin_btn{
border: 0px;
width: 94px;
height: 25px;
background: url(view/sozai/cartin.png) no-repeat;
margin-top:10px;
}
      
.cartin_btn:hover{
cursor: pointer;
}

.img_box3{
height: 150px;
width: 320px;
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
                <div class="lineup">
                <?php 
                $i = 0;
                    foreach($rows as $row){
                        if($row['status'] === '1' && $row['category'] === '300') {
                            print '<form action="cart.php" method="post">'."\n";
                            print '<div class="item">'."\n";
                            print '<tr>'."\n";
                            print '<span><img class ="ichiran" src="'.$img_dir . $row[3].'"></span>'."\n";
                            print '<span>'.$row[1].'</span>'."\n";
                            print '<span>'.$row[2].'円</span>'."\n";
                            print '<input type="hidden" value="'.$row[0].'" name="itemid">'."\n";
                            if($row[5] == 0){
                                print '<span class="red">売り切れ</span>'."\n";
                            }else{
                                print '<input type="submit" value="" class="cartin_btn" name="cartin">'."\n";
                            }
                        print '</tr></div></form>'."\n";
                        }
                     } ?>
        </div>
</main>
</body>

</html>