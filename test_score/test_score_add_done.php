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
  $student_code = $post['student_code'];
  $koku = $post['koku'];
  $suu = $post['suu'];
  $sya = $post['sya'];
  $ri = $post['ri'];
  $ei = $post['ei'];
  $created_at = $post['created_at'];

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO test_score(student_code, test_id, koku, suu, sya, ri, ei, created_at) VALUES(?,?,?,?,?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $student_code;
  $data[] = $test_id;
  $data[] = $koku;
  $data[] = $suu;
  $data[] = $sya;
  $data[] = $ri;
  $data[] = $ei;
  $data[] = $created_at;
  $stmt->execute($data);

  $dbh = null;

  print 'テストの点数を追加しました<br>';
}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>

<a href="test_score_list.php">戻る</a>

</body>
</html>
