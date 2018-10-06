<?php
// ログイン確認
session_start();
include('functions.php');
chk_ssid();

//1.  DB接続します
$pdo = db_conn();
  
$stmt = $pdo->prepare('SELECT * FROM '.$user_table);
$status = $stmt->execute();
$list="";
if($status==false){
    errorMsg($stmt);
  }else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $list .= '<p><a href="user_detail.php?id='.$result['id'].'">';
    $list .= $result["name"]." -権限:".$result["kanri_flg"];
    $list .= "</a>";
    $list .= ' ';
    $list .= '<a href="user_delete.php?id='.$result['id'].'">'; 
    $list .= '［削除］</a></p>';
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー管理</title>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<div>
<?=$list?>
</div>
</body>
</html>