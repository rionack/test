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

require_once('../common/common.php');

try{
  $post = sanitize($_POST);
  $test_id = $post['test_id'];
  $test_date = $post['test_date'];
  $test_type = $post['test_type'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'UPDATE test_time SET test_date=?, test_type=? WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $test_date;
  $data[] = $test_type;
  $data[] = $test_id;
  $stmt->execute($data);

  $dbh = null;

}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>

テスト情報を修正しました<br>
<br>
<a href="test_time_list.php">戻る</a>

</body>
</html>
