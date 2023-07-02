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

  $test_score_id = $_GET['test_score_id'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT student_code, test_id, koku, suu, sya, ri, ei FROM test_score WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_score_id;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  $dbh = null;

  $student_code = $rec['student_code'];
  $test_id = $rec['test_id'];
  $koku = $rec['koku'];
  $suu = $rec['suu'];
  $sya = $rec['sya'];
  $ri = $rec['ri'];
  $ei = $rec['ei'];

}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

テスト点数修正<br>
<br>
学生番号：
<?php print $student_code; ?>
<br>
<br>
生徒名：
<?php
$dsn ='mysql:dbname=test;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name FROM students WHERE student_code=?';
$stmt = $dbh->prepare($sql);
$data2[] = $student_code;
$stmt->execute($data2);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$student_name = $rec['name'];

print $student_name. '<br>';
 ?>
<br>
<?php
$dsn ='mysql:dbname=test;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT test_date, test_type
        FROM test_time
        WHERE id =?';
$stmt = $dbh->prepare($sql);
$data3[] = $test_id;
$stmt->execute($data3);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$test_date = $rec['test_date'];
$test_type = $rec['test_type'];

print 'テスト実施日：'.$test_date. '<br>';
print 'テスト種別：'.$test_type.'<br>';
 ?>
<br>

<form method="post" action="test_score_edit_check.php">
<input type="hidden" name="test_score_id" value="<?php print $test_score_id; ?>">
<input type="hidden" name="test_id" value="<?php print $test_id; ?>">
<input type="hidden" name="student_code" value="<?php print $student_code; ?>">
<input type="hidden" name="student_name" value="<?php print $student_name; ?>">
<input type="hidden" name="test_date" value="<?php print $test_date; ?>">
<input type="hidden" name="test_type" value="<?php print $test_type; ?>">
国語<br>
<input type="text" name="koku" style="width:50px" value="<?php print $koku; ?>">点<br>
数学<br>
<input type="text" name="suu" style="width:50px" value="<?php print $suu; ?>">点<br>
社会<br>
<input type="text" name="sya" style="width:50px" value="<?php print $sya; ?>">点<br>
理科<br>
<input type="text" name="ri" style="width:50px" value="<?php print $ri; ?>">点<br>
英語<br>
<input type="text" name="ei" style="width:50px" value="<?php print $ei; ?>">点<br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>




</body>
</html>
