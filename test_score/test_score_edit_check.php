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
$test_score_id = $post['test_score_id'];
$test_id = $post['test_id'];
$student_code = $post['student_code'];
$student_name = $post['student_name'];
$test_date = $post['test_date'];
$test_type = $post['test_type'];
$koku = $post['koku'];
$suu = $post['suu'];
$sya = $post['sya'];
$ri = $post['ri'];
$ei = $post['ei'];

print '学生番号：'.$student_code.'<br>';
print '生徒名：' .$student_name.'<br>';
print 'テスト実施日：' .$test_date.'<br>';
print 'テスト種別：' .$test_type. '<br>';

if($koku == '' || $koku <0 || $koku >100){
  print '国語の点数正しくが入力されていません<br>';
} ELSE{
  print '国語：' . $koku .'<br>';
}

if($suu == '' || $suu <0 || $suu >100){
  print '数学の点数正しくが入力されていません<br>';
} ELSE{
  print '数学：' . $koku .'<br>';
}

if($sya == '' || $sya <0 || $sya >100){
  print '社会の点数正しくが入力されていません<br>';
} ELSE{
  print '社会：' . $sya .'<br>';
}

if($ri == '' || $ri <0 || $ri >100){
  print '理科の点数正しくが入力されていません<br>';
} ELSE{
  print '理科：' . $ri .'<br>';
}

if($ei == '' || $ei <0 || $ei >100){
  print '英語の点数正しくが入力されていません<br>';
} ELSE{
  print '英語：' . $ei .'<br>';
}

if($koku == '' || $koku <0 || $koku >100 ||
  $suu == '' || $suu <0 || $suu >100 ||
  $sya == '' || $sya <0 || $sya >100 ||
  $ri == '' || $ri <0 || $ri >100 ||
  $ei == '' || $ei <0 || $ei >100)
{
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  print '<form method="post" action="test_score_edit_done.php">';
  print '<input type="hidden" name="test_score_id" value="'.$test_score_id.'">';
  print '<input type="hidden" name="koku" value="'.$koku.'">';
  print '<input type="hidden" name="suu" value="'.$suu.'">';
  print '<input type="hidden" name="sya" value="'.$sya.'">';
  print '<input type="hidden" name="ri" value="'.$ri.'">';
  print '<input type="hidden" name="ei" value="'.$ei.'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
