<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
} else{
  print $_SESSION['staff_name'];
  print 'さんがログイン中<br>';
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php
require_once('../common/common.php');

try{
  $post = sanitize($_POST);
  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_gazou_name = $post['gazou_name'];

  $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'root';
  $password ='root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO mst_product(name, price, gazou) VALUES(?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $pro_gazou_name;
  $stmt->execute($data);

  $dbh = null;

  print $pro_name. 'を追加しました<br>';
}
catch(Exception $e){
  print 'ただいま障害が発生しており、ご迷惑をおかけします';
  exit();
}
 ?>

<a href="pro_list.php">戻る</a>

</body>
</html>
