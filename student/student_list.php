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
  try{

    $dsn = 'mysql:dbname=test;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT id, student_code, name FROM students WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print '生徒一覧<br><br>';

    print '<form method="post" action="student_branch.php">';

    while(true){
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      if($rec == false){
        break;
      }
    print '<input type="radio" name="student_id" value="'.$rec['id'].'">';
    print $rec['student_code'].'：';
    print $rec['name'];
    print '<br>';
    }
    print '<br>';
    print '<input type="submit" name="disp" value="参照">';
    print '<input type="submit" name="add" value="追加">';
    print '<input type="submit" name="edit" value="修正">';
    print '<input type="submit" name="delete" value="削除">';
    print '</form>';


}
catch(Exception $e){
      print 'ただいま障害による大変ご迷惑をおかけします';
      exit();
}
 ?>
<br>
<a href="../login_member/teacher_top.php">トップメニューへ</a><br>

</body>
</html>
