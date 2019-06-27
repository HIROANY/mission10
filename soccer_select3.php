<?php

//0. ログイン認証
session_start();

if(!isset($_SESSION["chk_ssid"]) || 
$_SESSION["chk_ssid"] != session_id()){
    echo "LOGIN Error!";
    exit();
}else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
}

//1. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//２．データ表示SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_soccer_table2");

$status = $stmt->execute();

//３．データ表示
$view1 = '<table class="table table-striped">'.
"<tr>
<th>id</th>
<th>練習日付</th>
<th>選手id</th>
<th>コンディション</th>
<th>要ケア部位</th>
<th>練習強度（選手）</th>
<th>練習強度（監督）</th>
</tr>";

$view2 = "";
$view3 = '</tr></table>';

if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
        $view2 .= 
        "<tr>
        <td>".$result["id"]."</td>
        <td>".$result["sdate"]."</td>
        <td>".$result["pid"]."</td>
        <td>".$result["pcondition"]."</td>
        <td>".$result["pcare"]."</td>
        <td>".$result["training"]."</td>
        <td>".$result["training2"]."</td>";

        if($_SESSION["kanri_flg"]=="0"){
        $view2 .=
        "<td><a href='soccer_detail3.php?id=".$result["id"]."'>更新</a></td>
        <td><a href='soccer_delete3.php?id=".$result["id"]."'>削除</a></td>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サッカー選手データ</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>main{padding-top: 100px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<!-- navbar-inverse で黒系ナビゲーションの指定をしています。-->
<!-- navbar-fixed-top でヘッダー固定の指定をしています。-->
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
<span class="icon-bar"></span> </button>
<!--button~はウインドウのサイズが780px以下になった時に表示されます。-->
<a class="navbar-brand" href="soccer_index3.php">シン・ギ・タイ(仮)</a>
<!--こちらにサイト名を入れます。-->
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="soccer_index3.php">選手コンディション登録</a></li>
<li class="active"><a href="soccer_select3.php">全データ一覧</a></li>
<li><a href="soccer_player3.php">選手一覧</a></li>
<li><a href="soccer_logout3.php">ログアウト</a></li>
</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div align="center">
    <h2>データ一覧（全データ表示）</h2>
</div>
    <div class="container jumbotron"><?=$view1?><?=$view2?><?=$view3?></div>
<!-- Main[End] -->


</body>
</html>