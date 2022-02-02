<?php
//XSS対応（ echoする場所で使用！）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
function db_conn(){
    try {
        $db_name = "kayo5884_bookmark";    //データベース名
        $db_id   = "kayo5884";      //アカウント名
        $db_pw   = "*********";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "mysql57.kayo5884.sakura.ne.jp"; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; //ここを追記！！
      } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

// function sql_error($stmt}{
//     $error = $stmt->errorInfo();
//     exit("SQLError:" . print_r($error, true));
// }

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}
// 変数にしたい場合は.の後に入れてあげて()に入れることで代入が生じる！！