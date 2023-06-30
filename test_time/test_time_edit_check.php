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
$test_year = $post['year'];
$test_month = $post['month'];
$test_day = $post['day'];
$test_type =$post['test_type'];
$test_date = $test_year . '-'. $test_month. '-'.$test_day;

if($test_year == '' || $test_month == '' || $test_day == ''){
  print '変更後のテスト実施日を正しく入力してください<br>';
} ELSE{
  print 'テスト実施日：'.$test_year. '年'.$test_month. '月'.$test_day.'日<br>';
}

if($test_type == ''){
  print 'テスト種別を選んでください<br>';
} else{
  print 'テスト種別：'.$test_type. '<br>';
}


if($test_year == '' || $test_month == ''|| $test_day == '' || $test_type == ''){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
} ELSE{
  print '<br>';
  print '上の実施日・種別に変更してよろしいですか？';
  print '<form method="post" action="test_time_edit_done.php">';
  print '<input type="hidden" name="test_date" value="'.$test_date.'">';
  print '<input type="hidden" name="test_type" value="'.$test_type.'">';
  print '<br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<input type="submit" value="OK">';
  print '</form>';
}


 ?>

</body>
</html>
