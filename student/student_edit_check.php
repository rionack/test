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
$student_id = $post['student_id'];
$student_code = $post['student_code'];
$student_name = $post['student_name'];

if($student_code == ''){
  print '学生番号が入力されていません';
} else{
  print '学生番号：'.$student_code. '<br>';
}

if($student_name == ''){
  print '生徒名が入力されていません<br>';
} ELSE{
  print '生徒名：' . $student_name .'<br>';
}

if($student_code == '' || $student_name == ''){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  print '<form method="post" action="student_edit_done.php">';
  print '<input type="hidden" name="student_id" value="'.$student_id.'">';
  print '<input type="hidden" name="student_code" value="'.$student_code.'">';
  print '<input type="hidden" name="student_name" value="'.$student_name.'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
