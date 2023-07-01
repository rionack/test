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
スタッフ追加<br>
<br>
<form method="post" action="staff_add_check.php">
スタッフ名を入れてください<br>
<input name="name" type="text" style="width:200px"><br>
パスワードを入力してください<br>
<input name="pass" type="password" style="width:100px"><br>
パスワードをもう一度入れてください<br>
<input name="pass2" type="password" style="width:100px"><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
