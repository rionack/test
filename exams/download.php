<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['login'])) {
  print 'ログインされていません';
  print '<a href="login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
} else {
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
try {

  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $sql = 'SELECT ts.id, t.test_date, t.test_type, ts.student_code, s.name, ts.koku, ts.suu, ts.sya, ts.ri, ts.ei,  (ts.koku + ts.suu + ts.sya + ts.ri + ts.ei)AS total
          FROM test_score ts
          LEFT JOIN students s ON ts.student_code = s.student_code
          LEFT JOIN test_time t ON ts.test_id = t.id';

  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  $csv = 'テストID, テスト実施日, テスト種別, 学生番号, 生徒名, 国語, 数学, 社会, 理科, 英語, 点数合計';
  $csv.= "\n";

  while(true){
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false){
      break;
    }

    $csv.= $rec['id'];
    $csv.= ',';
    $csv.= $rec['test_date'];
    $csv.= ',';
    $csv.= $rec['test_type'];
    $csv.= ',';
    $csv.= $rec['student_code'];
    $csv.= ',';
    $csv.= $rec['name'];
    $csv.= ',';
    $csv.= $rec['koku'];
    $csv.= ',';
    $csv.= $rec['suu'];
    $csv.= ',';
    $csv.= $rec['sya'];
    $csv.= ',';
    $csv.= $rec['ri'];
    $csv.= ',';
    $csv.= $rec['ei'];
    $csv.= ',';
    $csv.= $rec['total'];
    $csv.= "\n";
  }

  $file = fopen('./seiseki.csv', 'w');
  $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
  fputs($file, $csv);
  fclose($file);

} catch (Exception $e) {
  print 'ただいま障害による大変ご迷惑をおかけします';
  exit();
}
?>
<a href="seiseki.csv">成績表一覧のダウンロードはこちらをクリック</a><br>
<br>
<a href="../login_member/teacher_top.php">トップメニューへ</a><br>


<br>
<br>


</body>
</html>
