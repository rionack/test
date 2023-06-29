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

  $test_id = $_GET['testid'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT test_date, test_type, created_at FROM test_time WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_id;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $test_date = $rec['test_date'];
  $test_type = $rec['test_type'];
  $created_at = $rec['created_at'];

  $dbh = null;

}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

登録済みテスト情報参照<br>
<br>
テスト実施日<br>
<?php print $test_date; ?>
<br>
テスト種別<br>
<?php print $test_type; ?>
<br>
登録日<br>
<?php print $created_at; ?>
<br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>




</body>
</html>
