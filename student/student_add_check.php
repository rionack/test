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

$post = sanitize($_POST);
$student_code = $post['student_code'];
$name = $post['name'];
$created_at = date('Y-m-d');

$dsn ='mysql:dbname=test;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name FROM students WHERE student_code=?';
$stmt = $dbh->prepare($sql);
$data[] = $student_code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;


if($student_code == ''){
  print '学生番号が入力されていません<br>';
}
 if(isset($rec['name']) == true){
  print '学生番号が重複しているため登録できません<br>';
} else{
  print '学生番号：'. $student_code.'<br>';
}

//同じ学生番号でも入力されてしまうので、if(isset)とSELECTで後で解決

if($name == ''){
  print '生徒名が入力されていません<br>';
} ELSE{
  print '生徒名：' . $name .'<br>';
}

if(isset($rec['name']) == true || $student_code == '' || $name == '' ){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  print '<form method="post" action="student_add_done.php">';
  print '<input type="hidden" name="student_code" value="'.$student_code.'">';
  print '<input type="hidden" name="name" value="'.$name.'">';
  print '<input type="hidden" name="created_at" value="'.$created_at.'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
