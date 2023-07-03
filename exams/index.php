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

    $sql = 'SELECT ts.id, ts.student_code, ts.koku, ts.suu, ts.sya, ts.ri, ts.ei, s.name, t.test_date, t.test_type
            FROM test_score ts
            LEFT JOIN students s ON ts.student_code = s.student_code
            LEFT JOIN test_time t ON ts.test_id = t.id';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print 'テスト結果一覧<br><br>';

}
catch(Exception $e){
      print 'ただいま障害による大変ご迷惑をおかけします';
      exit();
}
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
  while(true){
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false){
      break;
    }

    $total = $rec['ei']+$rec['suu']+$rec['koku']+$rec['sya']+$rec['ri'];

    print '<tr>';
    print '<td>'.$rec['student_code']. '</td>';
    print '<td>'.$rec['name']. '</td>';
    print '<td>'.$rec['ei']. '</td>';
    print '<td>'.$rec['suu']. '</td>';
    print '<td>'.$rec['koku']. '</td>';
    print '<td>'.$rec['sya']. '</td>';
    print '<td>'.$rec['ri']. '</td>';
    print '<td>'.$total. '</td>';
    print '</tr>';

  }

   ?>

</table>

<br>
<a href="../login_member/teacher_top.php">トップメニューへ</a><br>

</body>
</html>
