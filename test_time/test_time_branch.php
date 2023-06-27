<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['disp']) == true){
    if(isset($_POST['testid']) == false){
      header('Location:test_time_ng.php');
      exit();
    }

    $test_id = $_POST['testid'];
    header('Location:test_time_disp.php?testid='.$test_id);
    exit();
}

if(isset($_POST['add']) == true){
  header('Location:test_time_add.php');
  exit();
}

if(isset($_POST['edit']) == true){

    if(isset($_POST['testid']) == false){
      header('Location:test_time_ng.php');
      exit();
    }
  $test_id = $_POST['testid'];
  header('Location:test_time_edit.php?testid='.$test_id);
  exit();
}

if(isset($_POST['delete']) == true){

    if(isset($_POST['testid']) == false){
      header('Location:test_time_ng.php');
      exit();
    }
  $test_id = $_POST['testid'];
  header('Location:test_time_delete.php?testid='.$test_id);
  exit();
}

 ?>
