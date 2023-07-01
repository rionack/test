<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['disp']) == true){
    if(isset($_POST['test_score_id']) == false){
      header('Location:test_score_ng.php');
      exit();
    }

    $test_score_id = $_POST['test_score_id'];
    header('Location:test_score_disp.php?test_score_id='.$test_score_id);
    exit();
}

if(isset($_POST['add']) == true){
  header('Location:test_score_add.php');
  exit();
}

if(isset($_POST['edit']) == true){

    if(isset($_POST['test_score_id']) == false){
      header('Location:test_score_ng.php');
      exit();
    }
  $test_score_id = $_POST['test_score_id'];
  header('Location:test_score_edit.php?test_score_id='.$test_score_id);
  exit();
}

if(isset($_POST['delete']) == true){

    if(isset($_POST['test_score_id']) == false){
      header('Location:test_score_ng.php');
      exit();
    }
  $test_score_id = $_POST['test_score_id'];
  header('Location:test_score_delete.php?test_score_id='.$test_score_id);
  exit();
}

 ?>
