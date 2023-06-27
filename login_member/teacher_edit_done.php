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
require_once('../common/common.php');

try{
  $post = sanitize($_POST);
  $teacher_id = $post['id'];
  $teacher_name = $post['name'];
  $teacher_email = $post['email'];
  $teacher_pass = $post['pass'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'UPDATE login_member SET name=?, email=?, password=? WHERE id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $teacher_name;
  $data[] = $teacher_email;
  $data[] = $teacher_pass;
  $data[] = $teacher_id;
  $stmt->execute($data);

  $dbh = null;
}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>
先生情報を修正しました<br>
<br>
<a href="teacher_list.php">戻る</a>

</body>
</html>
