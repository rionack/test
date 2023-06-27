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
$teacher_name = $post['name'];
$teacher_email = $post['email'];
$teacher_pass = $post['pass'];
$teacher_pass2 = $post['pass2'];

if($teacher_name == ''){
  print '先生名が入力されていません<br>';
} ELSE{
  print '先生名：' . $teacher_name .'<br>';
}

if($teacher_email ==''){
  print 'メールアドレスが入力されていません<br>';
} else{
  print 'メールアドレス：'. $teacher_email. '<br>';
}

if($teacher_pass == ''){
  print 'パスワードを入力してください<br>';
}

if($teacher_pass2 == ''){
  print '確認のためパスワードを入力してください<br>';
}

if($teacher_name == '' || $teacher_email == '' || $teacher_pass == '' || $teacher_pass2 == ''){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  $teacher_pass = md5($teacher_pass);
  print '<form method="post" action="teacher_add_done.php">';
  print '<input type="hidden" name="name" value="'.$teacher_name.'">';
  print '<input type="hidden" name="email" value="'.$teacher_email.'">';
  print '<input type="hidden" name="pass" value="'.$teacher_pass.'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
