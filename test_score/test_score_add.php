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
テストの点数を追加<br>
<br>
<form method="post" action="test_score_add_check.php">
  学生番号を選んでください<br>
  <select name="student_code" style="width:200px">
  <?php
    $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT student_code, name FROM students ORDER BY student_code ASC;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rec as $row) {
      print '<option value="' . $row['student_code'] . '">' . $row['student_code'] .' / '.$row['name']. '</option>';
    }

    $dbh = null;
  ?>
  </select>
<br>
テスト実施日を選んでください<br>
<select name="test_select" style="width:200px">
<?php
  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT id, test_date, test_type FROM test_time;';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;

  foreach($rec as $row) {
    print '<option value="' .$row['id']. '">' .$row['test_date'] . ' / ' . $row['test_type']. '</option>';
} ?>
</select>

<br>
<br>
各教科の点数を入力してください<br>
［国語］<br>
<input name="koku" type="text" style="width:100px">点<br>
［数学］<br>
<input type="text" name="suu" style="width:100px">点<br>
［社会］<br>
<input type="text" name="sya" style="width:100px">点<br>
［理科］<br>
<input type="text" name="ri" style="width:100px">点<br>
［英語］<br>
<input type="text" name="ei" style="width:100px">点<br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
