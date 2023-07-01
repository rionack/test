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
  $student_code = $post['student_code'];
  $name = $post['name'];
  $created_at = $post['created_at'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO students(student_code, name, created_at) VALUES(?,?,?)'; 
  $stmt = $dbh->prepare($sql);
  $data[] = $student_code;
  $data[] = $name;
  $data[] = $created_at;
  $stmt->execute($data);

  $dbh = null;

  print $name. 'さんを追加しました<br>';
}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>

<a href="student_list.php">戻る</a>

</body>
</html>
