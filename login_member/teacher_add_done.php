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
  $teacher_name = $post['name'];
  $teacher_email = $post['email'];
  $teacher_pass = $post['pass'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO login_member(name, email, password, created_at) VALUES(?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $teacher_name;
  $data[] = $teacher_email;
  $data[] = $teacher_pass;
  $data[] = date('Y-m-d');
  $stmt->execute($data);

  $dbh = null;

  print $teacher_name. 'さんを追加しました<br>';
}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>

<a href="teacher_list.php">戻る</a>

</body>
</html>
