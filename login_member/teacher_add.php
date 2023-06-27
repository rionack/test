<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="teacher_login.html">ログイン画面へ</a>';
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
<title>成績管理アプリ</title>
</head>
<body>
先生情報を追加<br>
<br>
<form method="post" action="teacher_add_check.php">
先生の名前を入れてください<br>
<input name="name" type="text" style="width:200px"><br>
先生のメールアドレスを入れてください<br>
<input name="email" type="text" style="width:200px"><br>
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
