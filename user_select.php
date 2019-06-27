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

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view1 = '<table class="table table-striped">'.
"<tr>
<th>NO</th>
<th>名前</th>
<th>ID</th>
<th>PS</th>
<th>管理権限フラグ</th>
<th>アクティブフラグ</th>
</tr>";

$view2 = "";
$view3 = '</tr></table>';

if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view2 .= 
        "<tr>
        <td>".$result["id"]."</td>
        <td>".$result["name"]."</td>
        <td>".$result["lid"]."</td>
        <td>".$result["lpw"]."</td>
        <td>".$result["kanri_flg"]."</td>
        <td>".$result["life_flg"]."</td>";

        if($_SESSION["kanri_flg"]=="0"){
        $view2 .=
        "<td><a href='user_detail.php?id=".$result["id"]."'>更新</a></td>
        <td><a href='user_delete.php?id=".$result["id"]."'>削除</a></td>";
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
    <title>登録者一覧</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>main{padding-top: 100px;font-size:16px;}</style>
</head>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
<!-- navbar-default でデフォルトナビゲーションの指定をしています。-->
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
<li><a href="user_select.php">管理者一覧</a></li>
<li><a href="user_index.php">管理者登録</a></li>
<li><a href="soccer_logout.php">ログアウト</a></li>
</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<div class="container">
    <h2>ユーザ一覧</h2>
</div>
    <div class="container jumbotron"><?=$view1?><?=$view2?><?=$view3?></div>
</div>
<!-- Main[End] -->

</body>
</html>
