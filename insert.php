<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["book"]) || $_POST["book"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST['detail']) || $_POST['detail']==""
){
  header('location: select.php');
  exit;
}

//1. POSTデータ取得
$book = $_POST["book"];
$url = $_POST["url"];
$detail = $_POST['detail'];
$user = $_POST['userid'];

//2. DB接続します(エラー処理追加)
include('functions.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO '. $bm_table .'(id, book, url, detail, date, user)VALUES(NULL, :a1, :a2, :a3, sysdate(), :a4)');
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);
$stmt->bindValue(':a3', $detail, PDO::PARAM_STR);
$stmt->bindValue(':a4', $user, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');
  exit;
}
?>
