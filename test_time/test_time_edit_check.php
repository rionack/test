<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
} else{
  print $_SESSION['teacher_name'];
  print '先生がログイン中<br>';
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>成績管理プリ</title>
</head>
<body>
<?php

require_once('../common/common.php');

$post = sanitize($_POST);
$pro_code = $post['code'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_gazou_name_old =$post['gazou_name_old'];
$pro_gazou = $_FILES['gazou'];

if($pro_name == ''){
  print '商品名が入力されていません<br>';
} ELSE{
  print '商品名：' . $pro_name .'<br>';
}

if($pro_price == ''){
  print '価格を入力してください<br>';
} ELSE{
  print '価格：'. $pro_price. '円';
}

if($pro_gazou['size'] >0){
  if($pro_gazou['size'] > 1000000){
    print '画像サイズが大きすぎます';
  } else {
    move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
    print '<img src="./gazou/'.$pro_gazou['name'].'">';
    print '<br>';
  }
}

if($pro_name == '' || $pro_price == ''|| $pro_gazou['size'] > 1000000){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  print '<form method="post" action="pro_edit_done.php">';
  print '<input type="hidden" name="code" value="'.$pro_code.'">';
  print '<input type="hidden" name="name" value="'.$pro_name.'">';
  print '<input type="hidden" name="price" value="'.$pro_price.'">';
  print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
  print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
