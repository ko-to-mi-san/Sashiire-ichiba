<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>さしいれ市場ユーザー管理ページ</title>
  <style>

table {
width: 660px;
border-collapse: collapse;
}

table, tr, th, td {
border: solid 1px;
padding: 10px;
text-align: center;
}
        
.name_width {
width: 100px;
}
    
  </style>
</head>
<body>

    <h1>さしいれ市場ユーザー管理ページ</h1>
    <a href="kanripage.php">商品管理ページ</a>
    
    <h2>ユーザー情報一覧</h2>
    <table>
<tr>
<th>ユーザー名</th>
<th>メールアドレス</th>
<th>登録日時</th>
</tr>
    <?php 
    foreach($rows as $row){
        print '<tr>'; 
        print '<td class="name_width">'.$row[1].'</td>';
        print '<td class="name_width">'.$row[3].'</td>';
        print '<td class="name_width">'.$row[4].'</td>';
     } ?>
        </tr>
 </table>
</body>
</html>