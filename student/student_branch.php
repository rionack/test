<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="../login_member/teacher_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['disp']) == true){
    if(isset($_POST['student_id']) == false){
      header('Location:student_ng.php');
      exit();
    }

    $student_id = $_POST['student_id'];
    header('Location:student_disp.php?student_id='.$student_id);
    exit();
}

if(isset($_POST['add']) == true){
  header('Location:student_add.php');
  exit();
}

if(isset($_POST['edit']) == true){

    if(isset($_POST['student_id']) == false){
      header('Location:student_ng.php');
      exit();
    }
  $student_id = $_POST['student_id'];
  header('Location:student_edit.php?student_id='.$student_id);
  exit();
}

if(isset($_POST['delete']) == true){

    if(isset($_POST['student_id']) == false){
      header('Location:student_ng.php');
      exit();
    }
  $student_id = $_POST['student_id'];
  header('Location:student_delete.php?student_id='.$student_id);
  exit();
}

 ?>
