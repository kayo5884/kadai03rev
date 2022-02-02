<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];


//3．データ取得SQLを作成（SELECT文）
// idはバインド変数のidを入れる、直代入しない
$stmt = $pdo -> prepare('SELECT * FROM gs_bm_table WHERE id=:id');
$stmt->bindValue(':id', $id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if($status == false){
    sql_error($stmt);
}else{
    $result = $stmt ->fetch();
}
?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <!-- テキストエリアだけはちがう！ -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>BOOK MARK</legend>
                <label>名前：<input type="text" name="name" value="<?= $result['name']?>"></label><br>
                <label>URL：<input type="text" name="url" value="<?= $result['url']?>"></label><br>
                <label>コメント：<br>
                <textarea name="comment" rows="4" cols="40"><?= $result['comment']?></textarea></label><br>
                <input type="hidden" name="id" value="<?=$result['id']?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
