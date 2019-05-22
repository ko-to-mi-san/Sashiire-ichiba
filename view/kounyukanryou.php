<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>購入完了</title>
</head>
<body>
    <h3>ありがとうございます。商品が購入されました。</h3>
    <form method="post" enctype="multipart/form-data">
    <?php 
        if(count($err_msg) === 0){
            print '<img src="'.$img_dir . $gazou.'">';
            print '<p>がしゃん！【'.$syohin_name.'】が買えました！</p>';
    }?>
    <h4>合計：<?php print $money.'円(税込)' ?></h4>
    </form>
</body>
</html>
