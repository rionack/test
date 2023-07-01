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
$test_id = $post['test_select'];
$score_koku = $post['koku'];
$score_suu = $post['suu'];
$score_sya = $post['sya'];
$score_ri = $post['ri'];
$score_ei = $post['ei'];
$created_at = date('Y-m-d');

$dsn ='mysql:dbname=test;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT student_code, name FROM students WHERE student_code=?;';
$stmt = $dbh->prepare($sql);
$data[] = $student_code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;

if(preg_match('/\A[0-9]+\z/',$student_code) == 0){
	print '学生番号は半角数字で入力してください。<br>';
}
if($rec === false){
  print '入力された学生番号が存在しません<br>';
}else {
	print '学生番号：'. $student_code. ' / 生徒名：'.$rec['name']. '<br>';
}

if(isset($test_id) == false){
  print '実施テストを選んでください';
}else{
  print 'テスト種別'.$test_id.'<br>';
}

if($score_koku == ''|| $score_koku <0 || $score_koku >100){
  print '点数を正しく入力してください<br>';
} else{
  print '国語：'.$score_koku.'点<br>';
}

if($score_suu == '' || $score_suu <0 || $score_suu >100){
  print '点数を正しく入力してください<br>';
}else{
  print '数学：'.$score_suu.'点<br>';
}

if($score_sya == '' || $score_sya <0 || $score_sya >100){
  print '点数を正しく入力してください<br>';
}else{
  print '社会：'.$score_sya. '点<br>';
}

if($score_ri == '' || $score_ri <0 || $score_ri >100){
  print '点数を正しく入力してください<br>';
}else{
  print '理科：'.$score_ri. '点<br>';
}

if($score_ei == '' || $score_ei <0 || $score_ei >100){
  print '点数を正しく入力してください<br>';
}else{
  print '英語：'.$score_ei. '点<br>';
}

if(preg_match('/\A[0-9]+\z/',$student_code) == 0 ||
isset($test_id) == false ||
$score_koku == ''|| $score_koku <0 || $score_koku >100 ||
$score_suu == '' || $score_suu <0 || $score_suu >100 ||
$score_sya == '' || $score_sya <0 || $score_sya >100 ||
$score_ri == '' || $score_ri <0 || $score_ri >100 ||
$score_ei == '' || $score_ei <0 || $score_ei >100){
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}else{
	print '上のテスト点数を追加します。<br />';
	print '<form method="post" action="test_score_add_done.php">';
	print '<input type="hidden" name="test_id" value="'.$test_id.'">';
  print '<input type="hidden" name="student_code" value="'.$student_code.'">';
  print '<input type="hidden" name="koku" value="'.$score_koku.'">';
  print '<input type="hidden" name="suu" value="'.$score_suu.'">';
  print '<input type="hidden" name="sya" value="'.$score_sya.'">';
  print '<input type="hidden" name="ri" value="'.$score_ri.'">';
  print '<input type="hidden" name="ei" value="'.$score_ei.'">';
  print '<input type="hidden" name="created_at" value="'.$created_at.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}


?>
</body>
</html>
