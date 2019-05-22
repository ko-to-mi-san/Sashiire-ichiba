<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>差し入れ市場商品管理ページ</title>
  <style>

        table {
            width: 950px;
            border-collapse: collapse;
        }

        table, tr, th, td {
            border: solid 1px;
            padding: 10px;
            text-align: center;
        }
        .text_align_right {
            text-align: right;
        }

        .drink_name_width {
            width: 100px;
        }

        .input_text_width {
            width: 60px;
        }

        .status_false {
            background-color: #A9A9A9;
        }
        .img_size {
            height: 125px;
        }
  </style>
</head>
<body>
    <?php foreach ($result_msg as $raw) { ?>
      <p><?php print $raw; ?></p>
    <?php } ?>
    <?php foreach ($err_msg as $raw) { ?>
      <p><?php print $raw; ?></p>
    <?php } ?>
    <h1>さしいれ市場商品管理ページ</h1>
    <a href="user_kanri.php">ユーザー管理ページ</a>
    
    <h2>新規商品追加</h2>
    
    <form method="post" enctype="multipart/form-data">
        <p>名前：<input type="text" name="name"><br>
        値段：<input type="text" name="price"><br>
        個数：<input type="text" name="number"><br>
        <div><input type="file" name="new_img"></div>
            <input type="radio" name="status" value="1"> 公開
            <input type="radio" name="status" value="0" checked>非公開
        <br>
            <input type="radio" name="category" value="100" checked> お菓子
            <input type="radio" name="category" value="200">食べ物
            <input type="radio" name="category" value="300">ボディケア
            <input type="radio" name="category" value="400">その他消耗品<br>
            <br>
            <p>↓以下は必須ではありません。該当する項目があったら登録してください。</p>
            シーズン：
            <select name="season">
                        <option value="0">シーズンを選択してください</option>
                        <option value="100">春</option>
                        <option value="200">夏</option>
                        <option value="300">秋</option>
                        <option value="400">冬</option>
                        <option value="500">バレンタイン</option>
                        <option value="600">ハロウィン</option>
                        <option value="700">クリスマス</option>
                        <option value="800">お祝い</option>
                        </select><br>
            <input type="checkbox" name="mens" value="1">メンズ向け<br>
            <input type="checkbox" name="senior" value="1">シニア向け<br>
            <input type="checkbox" name="kids" value="1">キッズ向け<br>
            <input type="checkbox" name="daininzu" value="100">大人数向け<br>
            <input type="hidden" name="process_kind" value="insert_item">
            商品説明：<br>
            <textarea name="setumei" rows="10" cols="80"></textarea><br>
            <input type="submit" name="submit" value="商品を追加">
        </p>
    </form>
    
    <h2>商品情報一覧・変更</h2>
    <p>商品一覧</p>
    <table>
<tr>
<th>商品画像</th>
<th>商品名</th>
<th>価格</th>
<th>在庫数</th>
<th>ステータス</th>
<th>カテゴリー</th>
<th>商品の特徴</th>
<th>商品説明</th>
<th>操作</th>
</tr>
    <?php 
    foreach($rows as $row){
        if($row[4] === '1'){
            print '<tr>'; 
        }else{
           print '<tr class="status_false">';
        }
        print '<td><img class="img_size" src="'.$img_dir . $row[3].'"></td>';
        print '<td class="drink_name_width">'.$row[1].'</td>';
        print '<td class="text_align_right">'.$row[2].'円</td>' ?>
    <td>
        <form method="post" enctype="multipart/form-data">
        <p><input type="text" class="input_text_width" name="number_change" size="10" value="<?php print $row[5]; ?>">個</p>
        <input type="hidden" name="change_itemid" value= "<?php print $row[0]; ?>">
        <input type="hidden" name="process_kind" value="update_stock">
        <input type="submit" name="change" value="変更">
    </td>
    </form>
    <td>
        <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="change_itemid" value= "<?php print $row[0]; ?>">
        <input type="hidden" name="change_status" value= "<?php print $row[4]; ?>">
        <input type="hidden" name="process_kind" value="change_status">
    <?php 
        if($row[4] === '1'){
            print '<input type="submit" name="koukai" value="公開→非公開">'; 
        }else{
           print '<input type="submit" name="koukai" value="非公開→公開">';
        } ?>
        </form>
    </td>
    <td>
        <?php if($row[7] === '100'){
             print 'お菓子';
        }elseif($row[7] === '200'){
           print '食べ物';
        }elseif($row[7] === '300'){
           print 'ボディケア';
        }elseif($row[7] === '400'){
           print 'その他消耗品';
        } ?>
    </td>
     <td>
        <?php if($row[8] === '100'){
             print '春用';
        }elseif($row[8] === '200'){
           print '夏用';
        }elseif($row[8] === '300'){
           print '秋用';
        }elseif($row[8] === '400'){
           print '冬用';
        }elseif($row[8] === '500'){
           print 'バレンタイン用';
        }elseif($row[8] === '600'){
           print 'ハロウィン用';
        }elseif($row[8] === '700'){
           print 'クリスマス用';
        }elseif($row[8] === '800'){
           print 'お祝い用';
        } ?><br>
        <?php if($row[9] === '1'){
             print 'メンズ向け<br>';}
        if($row[10] === '1'){
           print 'シニア向け<br>';}
        if($row[11] === '1'){
           print 'キッズ向け<br>';}
        if($row[12] === '100'){
           print '大人数向け';
        } ?>
     </td>
     <td class="drink_name_width">
         <form method="post" enctype="multipart/form-data">
         <textarea name="change_setumei" rows="7" cols="10"><?php print $row[13]; ?></textarea><br>
     <input type="hidden" name="change_itemid" value= "<?php print $row[0]; ?>">
        <input type="hidden" name="process_kind" value="update_setumei">
        <input type="submit" name="setumei_change" value="変更">
     </form>
     </td>
    <td>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="process_kind" value="delete">
            <input type="hidden" name="change_itemid" value= "<?php print $row[0]; ?>">
          <input type="submit" name="delete" value="削除">
        </form>  
    </td>
    <?php } ?>
        </tr>
 </table>
</body>
</html>