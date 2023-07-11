<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
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

    $test_id = $_GET['test_id'];
    $order_by = $_GET['order_by'];
    $sort_rule = $_GET['sort_rule'];

    header('Location: index.php?test_id2=' . $test_id . '&order_by=' . $order_by . '&sort_rule=' . $sort_rule);

 ?>

</body>
</html>
