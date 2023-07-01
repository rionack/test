<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
} else{
  print $_SESSION['staff_name'];
  print 'さんがログイン中<br>';
}
 ?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
商品を追加<br>
<br>
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入れてください<br>
<input name="name" type="text" style="width:200px"><br>
価格を入力してください<br>
<input name="price" type="text" style="width:100px"><br>
画像を選んでください<br>
<input type="file" name="gazou" style="width:400px"><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
