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
require_once('../common/common.php'); //commonファイルを呼び出し

 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>成績管理アプリ</title>
</head>
<body>
テスト実施情報を追加<br>
<br>
<form method="post" action="test_time_add_check.php">
実施日を選んでください<br>
<?php pulldown_year(); ?>年　<?php pulldown_month(); ?>月 　<?php pulldown_day(); ?>日<br>  <!--functionはそのまま記入 -->
<br>
テスト種別を選んでください<br>
<input name="test_type" type="radio" value="前期中間テスト" checked>前期中間テスト<br>
<input type="radio" name="test_type" value="前期期末テスト">前期期末テスト<br>
<input type="radio" name="test_type" value="後期中間テスト">後期中間テスト<br>
<input type="radio" name="test_type" value="後期期末テスト">後期期末テスト<br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
