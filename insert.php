<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$url  = $_POST["url"];
$comment = $_POST["comment"];


//2. DB接続します
//以下を関数化！
// エンジニアは3回以上同じコードを書かない
require_once('funcs.php');
$pdo = db_conn();

//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table( id, name, url, comment, indate )
  VALUES( NULL, :name, :url, :comment, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    sql_error($stmt);
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    // $error = $stmt->errorInfo();
    // exit("SQLError:" . print_r($error, true));
  }else{
    redirect('index.php');
    //５．index.phpへリダイレクト
    //以下を関数化
    // header("Location: index.php");
    // exit();
  }
  // ↑コメントアウトすればものの数行で完成してる！！！