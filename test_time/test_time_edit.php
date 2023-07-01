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
 require_once('../common/common.php')
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

  $test_id = $_GET['testid'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT test_date, test_type FROM test_time WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_id;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $test_date = $rec['test_date'];
  $test_type = $rec['test_type'];

  $dbh = null;

}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>
<br>
テスト情報修正<br>
<br>
（変更前）<br>
テスト実施日<br>
<?php print $test_date; ?>
<br>
<br>
テスト種別<br>
<?php print $test_type; ?>
<br>
<br>
（変更後）<br>
<form method="post" action="test_time_edit_check.php">
テスト実施日を選んでください<br>
<?php pulldown_year(); ?>年　<?php pulldown_month(); ?>月 　<?php pulldown_day(); ?>日<br>
<br>
テスト種別を選んでください<br>
<input name="test_type" type="radio" value="前期中間テスト" checked>前期中間テスト<br>
<input type="radio" name="test_type" value="前期期末テスト">前期期末テスト<br>
<input type="radio" name="test_type" value="後期中間テスト">後期中間テスト<br>
<input type="radio" name="test_type" value="後期期末テスト">後期期末テスト<br>
<br>
<input type="hidden" name="test_id" value="<?php print $test_id; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
