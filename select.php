<?php
//1.  DB接続します ログイン確認
session_start();
include('functions.php');
$unlogin = chk_ssid();
$loginname = $_SESSION['name'];
$menu = menu();
$pdo = db_conn();
$userid = $_SESSION['userid'];


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM '.$bm_table.' WHERE user=:userid');
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view='';
if($status==false){
  errorMsg($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p><a href="detail.php?id='.$result['id'].'">';  //更新ページへのaタグを作成
    $view .= $result['book'].'('.$result['date'].')';
    $view .= '</a>';
    if($unlogin == 0){
      $view .= '　';
      $view .= '<a href="delete.php?id='.$result['id'].'">［削除］</a></p>';  //削除用aタグを作成
    } 
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <?=$menu?><p><?=$loginname?></p>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
