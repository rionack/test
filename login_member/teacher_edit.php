<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="teacher_login.html">ログイン画面へ</a>';
  exit();
} else{
  print $_SESSION['staff_name'];
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

  $staff_code = $_GET['staffcode'];

  $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT name FROM mst_staff WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name = $rec['name'];

  $dbh = null;
}
catch(Exeption $e){
  print '障害が発生しておりご迷惑をおかけいたします';
  exit();
}
 ?>

スタッフ修正<br>
<br>
スタッフコード<br>
<?php print $staff_code; ?>
<br>
<br>
<form method="post" action="staff_edit_check.php">
<input type="hidden" name="code" value="<?php print $staff_code; ?>">
スタッフ名<br>
<input type="text" name="name" style="width:200px" value="<?php print $staff_name; ?>"><br>
パスワードを入力してください<br>
<input type="password" name="pass" style="width:100px"><br>
もう一度パスワードを入力していください<br>
<input type="password" name="pass2" style="width:100px"><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>




</body>
</html>
