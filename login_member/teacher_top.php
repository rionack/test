<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="teacher_login.html">ログイン画面へ</a>';
  exit();
} else{
  print $_SESSION['teacher_name'];
  print 'さんがログイン中<br>';
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>成績管理アプリ</title>
</head>
<body>
<br>成績管理トップメニュー<br>
<br>
<a href="teacher_list.php">先生管理</a><br>
<br>
<a href="../product/pro_list.php">商品管理</a><br>
<br>
<a href="../order/order_download.php">注文ダウンロード</a><br>
<br>
<a href="teacher_logout.php">ログアウト</a><br>

</body>
</html>
