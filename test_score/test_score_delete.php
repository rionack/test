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

  $sql = 'SELECT ts.id, ts.student_code, ts.koku, ts.suu, ts.sya, ts.ri, ts.ei, tt.test_date, tt.test_type, s.name
            FROM test_score ts
            LEFT JOIN test_time tt ON ts.test_id = tt.id
            LEFT JOIN students s ON ts.student_code = s.student_code
            WHERE ts.id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_score_id;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $student_code = $rec['student_code'];
  $koku = $rec['koku'];
  $suu = $rec['suu'];
  $sya = $rec['sya'];
  $ri = $rec['ri'];
  $ei = $rec['ei'];
  $test_date = $rec['test_date'];
  $test_type = $rec['test_type'];
  $student_name = $rec['name'];

    $dbh = null;

}
catch(Exception $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

テスト点数データ削除<br>
<br>
学生番号<br>
<?php print $student_code; ?>
<br>
生徒名<br>
<?php print $student_name; ?>
<br>
テスト実施日<br>
<?php print $test_date; ?>
テスト種別<br>
<?php print $test_type; ?>
<br>
国語<?php print $koku; ?>点
<br>
数学<?php print $suu; ?>点
<br>
社会<?php print $sya; ?>点
<br>
理科<?php print $ri; ?>点
英語<br>
<?php print $ei; ?>点

<br>
この点数データを削除してよろしいですか？<br><br>
<form method="post" action="test_score_delete_done.php">
<input type="hidden" name="test_score_id" value="<?php print $test_score_id; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>




</body>
</html>
