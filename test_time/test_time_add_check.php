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

$post = sanitize($_POST); //textを利用していないため不要かも？
$test_time_year = $post['year'];
$test_time_month = $post['month'];
$test_time_day =  $post['day'];
$test_type = $post['test_type'];
$test_time = $test_time_year. '-'.$test_time_month. '-'.$test_time_day;

if($test_time_year == '' || $test_time_month == '' || $test_time_day == '')
{
	print 'テスト実施日が正しく入力されていません。<br>';
}
else
{
	print 'テスト実施日:';
	print $test_time_year. '年'. $test_time_month. '月'. $test_time_day. '日';
	print '<br />';
}

if($test_type == ''){
  print 'テストの種別を選択してください。<br>';
} else{
  print 'テスト種別：';
  print $test_type;
  print '<br>';
}


if($test_time_year == '' || $test_time_month == '' || $test_time_day == '' || $test_type == '' )
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上に表示されているテスト情報を登録します。<br />';
	print '<form method="post" action="test_time_add_done.php">';
	print '<input type="hidden" name="test_time" value="'.$test_time.'">';
	print '<input type="hidden" name="test_type" value="'.$test_type.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}


?>
</body>
</html>
