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
<br>トップメニュー<br>
<br>
<a href="teacher_list.php">先生管理</a><br>
<br>
<a href="../test_time/test_time_list.php">テスト実施日管理</a><br>
<br>
<a href="../student/student_list.php">生徒管理</a><br>
<br>
<a href="../test_score/test_score_list.php">テスト点数管理</a><br>
<br>
<a href="../exams/index.php">テスト結果一覧</a><br>
<br>
<a href="../order/order_download.php">注文ダウンロード</a><br>
<br>
<a href="teacher_logout.php">ログアウト</a><br>

</body>
</html>
