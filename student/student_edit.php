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
<?php
try{

  $student_id = $_GET['student_id'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT student_code, name FROM students WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $student_id;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $student_code = $rec['student_code'];
  $student_name = $rec['name'];

  $dbh = null;
}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

生徒情報修正<br>
<br>
学生番号<br>
<?php print $student_code; ?>
<br>
生徒名<br>
<?php print $student_name; ?>
<br>
<form method="post" action="student_edit_check.php">
<br>
以下に修正する情報を入力してください<br>
<br>
<input type="hidden" name="student_id" value="<?php print $student_id; ?>">
学生番号<br>
<input type="text" name="student_code" style="width:200px" value="<?php print $student_code; ?>"><br>
<br>
生徒名<br>
<input type="text" name="student_name" style="width:200px" value="<?php print $student_name; ?>"><br>

<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>




</body>
</html>
