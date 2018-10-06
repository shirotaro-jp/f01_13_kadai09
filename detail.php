<?php
// ログイン確認
session_start();
include('functions.php');
$unlogin = chk_ssid();
$loginname = $_SESSION['name'];
$submit = '';
if($unlogin == 0){
  $submit = '<input type="submit" value="更新">';
} 
$menu = menu();

// getで送信されたidを取得
$id = $_GET['id'];


//1.  DB接続します
$pdo = db_conn();


//２．データ登録SQL作成，指定したidのみ表示する
$stmt = $pdo->prepare('SELECT * FROM '.$bm_table.' WHERE id=:id');
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false){
  // エラーのとき
  errorMsg($stmt);
}else{
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["name"]などで値をとれる
  // var_dump()で見てみよう
}
?>

<!-- htmlは「index.php」とほぼ同じです -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新ページ</title>
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
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>詳細表示</legend>
     <label>書籍名：<input type="text" name="book" value="<?=$rs['book']?>"></label><br>
     <label>書籍URL：<input type="text" name="url" value="<?=$rs['url']?>"></label><br>
     <label>書籍コメント：<textArea name="detail" rows="4" cols="40"><?=$rs['detail']?></textArea></label><br>
     <?=$submit?>
     <!-- idは変えたくない = ユーザーから見えないようにする type="hidden"-->
     <input type="hidden" name="id" value="<?=$rs['id']?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
