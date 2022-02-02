<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$name =$_POST['name'];
$url =$_POST['url'];
$comment =$_POST['comment'];
$id =$_POST['id'];


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
// insert.phpから以下をおp
// whereの後が大事！！
$stmt = $pdo->prepare(
    "UPDATE gs_bm_table SET 
    name =:name, url =:url, comment =:comment, indate=sysdate() 
    WHERE id =:id"
    );

// 4.バインド変数を用意 コピペ
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5.実行
$status = $stmt->execute();

//6．データ登録処理後
// select.phpに戻らせてあげる
if($status==false){
    sql_error($stmt);
  }else{
    redirect('select.php');
  }

