<?php
//1. GETデータ取得
$id = $_GET['id'];
if($id==null){
  header('location: select.php');
  exit;
}

//2. DB接続します(エラー処理追加)
include('functions.php');
$pdo = db_conn();


//3．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM '.$bm_table.' WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //select.phpへリダイレクト
  header('location: select.php');
  exit;
}
?>
