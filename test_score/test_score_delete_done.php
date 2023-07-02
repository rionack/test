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
  $test_score_id = $_POST['test_score_id'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'DELETE FROM test_score WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_score_id;
  $stmt->execute($data);

  $dbh = null;

}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>
テストの点数データを削除しました<br>
<br>
<a href="test_score_list.php">戻る</a>

</body>
</html>
