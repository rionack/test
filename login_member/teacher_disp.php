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

登録されている先生の情報<br>
<br>
先生ID<br>
<?php print $teacher_code; ?>
<br>
<br>
先生名<br>
<?php print $teacher_name; ?>
<br>
<br>
登録済みメールアドレス<br>
<?php print $teacher_email; ?>
<br>
<br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>
