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
<title>成績管理アプリ</title>
</head>
<body>
生徒追加<br>
<br>
<form method="post" action="student_add_check.php">
学生番号を入れてください<br>
<input type="text" name="student_code" style="width:200px">
<br>
生徒名を入れてください<br>
<input name="name" type="text" style="width:200px"><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
