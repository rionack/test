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
<?php
try{

  $teacher_code = $_GET['teachercode'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT name, email FROM login_member WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $teacher_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $teacher_name = $rec['name'];
  $teacher_email = $rec['email'];

  $dbh = null;
}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

登録されている先生情報の修正<br>
<br>
先生コード<br>
<?php print $teacher_code; ?>
<br>
<br>
<form method="post" action="teacher_edit_check.php">
<input type="hidden" name="code" value="<?php print $teacher_code; ?>">
先生名<br>
<input type="text" name="name" style="width:200px" value="<?php print $teacher_name; ?>"><br>
登録メールアドレス<br>
<input type="text" name="email" style="width:200px;" value="<?php print $teacher_email; ?>"><br>
パスワードを入力してください<br>
<input type="password" name="pass" style="width:100px"><br>
もう一度パスワードを入力していください<br>
<input type="password" name="pass2" style="width:100px"><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>




</body>
</html>
