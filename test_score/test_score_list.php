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

    $sql = 'SELECT ts.id, ts.student_code, ts.koku, ts.suu, ts.sya, ts.ri, ts.ei, s.name, t.test_date, t.test_type
            FROM test_score ts
            LEFT JOIN students s ON ts.student_code = s.student_code
            LEFT JOIN test_time t ON ts.test_id = t.id
            ORDER BY ts.student_code ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print 'テスト点数一覧<br><br>';

    print '<form method="post" action="test_score_branch.php">';

    while(true){
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      if($rec == false){
        break;
      }
    print '<input type="radio" name="test_score_id" value="'.$rec['id'].'">';
    print '学生番号：'.$rec['student_code']. '/';
    print '生徒名：'.$rec['name']. '/';
    print 'テスト実施日：'.$rec['test_date']. '/';
    print 'テスト種別：'.$rec['test_type']. '/';
    print '国語：'.$rec['koku'].'点/';
    print '数学：'.$rec['suu'].'点/';
    print '社会：'.$rec['sya'].'点/';
    print '理科：'.$rec['ri'].'点/';
    print '英語：'.$rec['ei'].'点/';
    print '合計：'.($rec['koku']+$rec['suu']+$rec['sya']+$rec['ri']+$rec['ei']). '点';
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
