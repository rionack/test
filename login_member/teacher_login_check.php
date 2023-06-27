<?php
try
{
  require_once('../common/common.php');

  $post = sanitize($_POST);

  $teacher_email = $post['email'];
  $teacher_pass = $post['pass'];

  $teacher_pass = md5($teacher_pass);

  $dsn ='mysql:dbname=test;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT name FROM login_member WHERE email=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $teacher_email;
  $data[] = $teacher_pass;
  $stmt->execute($data);

  $dbh = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if($rec == false){
    print '入力したメールアドレスが登録されていないか、パスワードが間違っています<br>';
    print '<a href="teacher_login.html">戻る</a>';
  } else{
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['teacher_email'] = $teacher_email;
    $_SESSION['teacher_name'] = $rec['name'];
    header('Location: teacher_top.php');
    exit();
  }
}
catch(Exception $e){
  print 'ただいま障害によりご迷惑をおかけします';
  exit();
}

 ?>
