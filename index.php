<?php
// ログイン確認
session_start();
include('functions.php');
$unlogin = chk_ssid();
$loginname = $_SESSION['name'];
if($unlogin == 1){
  header('location: login.php');
  exit;
} 
$menu = menu();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークアプリ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><?=$menu?></div>
    <p><?=$loginname?></p>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録</legend>
      <label>書籍名：<input type="text" name="book"></label><br>
      <label>書籍URL：<input type="text" name="url"></label><br>
      <label>書籍コメント：<textArea name="detail" rows="4" cols="40"></textArea></label><br>
      <input type="hidden" name="userid" value="<?=$_SESSION['userid'] ?>">
      <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
