<?php
session_start ();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false){
  print 'ログインされていません';
  print '<a href="teacher_login.html">ログイン画面へ</a>';
  exit();
}

if(isset($_POST['disp']) == true){
    if(isset($_POST['teachercode']) == false){
      header('Location:teacher_ng.php');
      exit();
    }

    $teacher_code = $_POST['teachercode'];
    header('Location:teacher_disp.php?teachercode='.$teacher_code);
    exit();
}

if(isset($_POST['add']) == true){
  header('Location:teacher_add.php');
  exit();
}

if(isset($_POST['edit']) == true){

    if(isset($_POST['teachercode']) == false){
      header('Location:teacher_ng.php');
      exit();
    }
  $teacher_code = $_POST['teachercode'];
  header('Location:teacher_edit.php?teachercode='.$teacher_code);
  exit();
}

if(isset($_POST['delete']) == true){

    if(isset($_POST['teachercode']) == false){
      header('Location:teacher_ng.php');
      exit();
    }
  $teacher_code = $_POST['teachercode'];
  header('Location:teacher_delete.php?teachercode='.$teacher_code);
  exit();
}

 ?>
