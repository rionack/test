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
<br>
<a href="../login_member/teacher_top.php">トップメニューへ</a><br>

</table>

<?php
  if(isset($_GET['test_id2']) == false){
    exit();
  } else{

  $test_id2 = $_GET['test_id2'];

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT ts.id, ts.student_code, ts.koku, ts.suu, ts.sya, ts.ri, ts.ei, s.name, t.test_date, t.test_type
          FROM test_score ts
          LEFT JOIN students s ON ts.student_code = s.student_code
          LEFT JOIN test_time t ON ts.test_id = t.id
          WHERE t.id=?';
  $stmt = $dbh->prepare($sql);
  $data2[] = $test_id2;
  $stmt->execute($data2);
  $tests = $stmt->fetchALL(PDO::FETCH_ASSOC);

  $dbh = null;

  ?>
<table  border="1" style="border-collapse:collapse">
  <tr>
    <td>学生番号</td>
    <td>名前</td>
    <td>英語</td>
    <td>数学</td>
    <td>国語</td>
    <td>社会</td>
    <td>理科</td>
    <td>合計</td>
  </tr>

  <?php
  foreach($tests as $test){

    $total = $test['ei']+$test['suu']+$test['koku']+$test['sya']+$test['ri'];

    print '<tr>';
    print '<td>'.$test['student_code']. '</td>';
    print '<td>'.$test['name']. '</td>';
    print '<td>'.$test['ei']. '</td>';
    print '<td>'.$test['suu']. '</td>';
    print '<td>'.$test['koku']. '</td>';
    print '<td>'.$test['sya']. '</td>';
    print '<td>'.$test['ri']. '</td>';
    print '<td>'.$total. '</td>';
    print '</tr>';

  }
}
   ?>
</table>

<br>
<br>


</body>
</html>
