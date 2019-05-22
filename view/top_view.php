<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>さしいれ市場</title>
      <link rel="stylesheet" href="view/html5reset-1.6.1.css">
      <link rel="stylesheet" href="view/top_view.css">
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
            <a href="#"><img src="view/sozai/topimg1.jpg" class="topImage"></a>
       
        <div class="articles">
            <article>
                <h1>RANKING</h1>
                <div class="ranking">
              <dl class="rankingList">

                    <?php   
                    $i = 1;
                    foreach($rankrows as $key){
                    print '<figure>';
                    print '<form action="cart.php" method="post">'."\n";
                    print '<div class="ranking'.$i++.'">';
                    print '<span class="img_box"><dt><a href="#"><img class="img_size" src="'.$img_dir . $key['img'].'"></a></dt></span></div>';
                    print '<figcaption>'.$key['name'].'<br>';
                    print ''.$key['price'].'円<br>';
                    print '<input type="hidden" value="'.$key['item_id'].'" name="itemid">'."\n";
                    print '<input type="submit" value="" class="cartin_btn" name="cartin"></figcaption></form></figure>';
                   
                    } ?>
                    
              </dl>
          </div>
        </article>
         <article>
             <h1>RECOMMEND</h1>
            <div class="recommend">
                <dl class="recommendList">
                <figure>
                    <dt><a href="#"><img src="view/sozai/recommend1.jpg"></a></dt>
                    <figcaption><p class="cap">大好きなお菓子のつめあわせ</p><br>
                    お子様が喜ぶこと間違いなし</figcaption></figure>
                    <figure>
                    <dt><a href="#"><img src="view/sozai/recommend2.jpg"></a></dt>
                    <figcaption><p class="cap">毎日使う使うものだから</P><br>
                    もらって嬉しいボディケアグッズ</figcaption></figure>
                    <figure>
                    <dt><a href="#"><img src="view/sozai/recommend3.jpg"></a></dt>
                    <figcaption><p class="cap">超人気店のマカロンが登場！</p><br>
                    苺をふんだんに使った贅沢な一品！</figcaption></figure>
                    <figure>
                </dl>
        </div>
        </article>
        <article>
            <h1>LINEUP</h1>
            <div class="lineup">
                <?php 
                $i = 0;
                    foreach($rows as $row){
                        if($row[4] === '1') {
                            print '<form action="cart.php" method="post">'."\n";
                            print '<div class="item">'."\n";
                            print '<tr>'."\n";
                            print '<span class="img_box3"><img class="img_size" img src="'.$img_dir . $row[3].'"></span>'."\n";
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
        </article>
        </div>
      </main>
      <footer>
          <div class="footerBox">
              <ul class="headfoot">
                    <li class="headfoot"><a href="#" class="foot">サイトマップ</a></li>
                    <li class="headfoot"><a href="#" class="foot">プライバシーポリシー</a></li>
                    <li class="headfoot"><a href="#" class="foot">お問い合わせ</a></li>
                    <li class="headfoot"><a href="#" class="foot">ご利用ガイド</a></li>
              </ul>
            <p class="copyright"><small>Copyright &copy; KotomiSato All Rights Reserved.</small></p>
        </div>
      </footer>
    </body>
</html>