<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="login_member/teacher_login.html">ログイン画面へ</a>';
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
  try{

    $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM test_time';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetchALL(PDO::FETCH_ASSOC);

    $dbh = null;

}
catch(Exception $e){
      print 'ただいま障害による大変ご迷惑をおかけします';
      exit();
}
  print 'テスト結果一覧<br><br>';

  foreach($rec as $test){
    $test_id = $test['id'];
    $test_type = $test['test_type'];
    $test_date = $test['test_date'];
    $link = 'result.php?test_id='.$test_id;
    print '<a href='. $link.'">'. $test_type. '　(テスト実施日：'.$test_date.')</a><br>';
  }

 ?>

</table>

<br>
<a href="../login_member/teacher_top.php">トップメニューへ</a><br>

</body>
</html>
