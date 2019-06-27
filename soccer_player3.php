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
$stmt = $pdo->prepare("SELECT DISTINCT pid,pname,pposition,pnumber,pheight,pweight,pbirthday,previousteam,img FROM gs_player_table");

$status = $stmt->execute();

//３．データ表示
$view1 = '<table class="table table-striped table-responsive">'.
"<tr>
<th>ビジュアル</th>
<th>選手名</th>
<th>ポジション</th>
<th>背番号</th>
<th>身長</th>
<th>体重</th>
<th>生年月日</th>
<th>前所属</th>

</tr>";

$view2 = "";
$view3 = "</tr></table>";

if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する

        $view2 .= '<tr><td><img src ="upload/'.$result["img"].'" width="150"></td>';
        $view2 .= '<td>'.$result["pname"].'</td>';
        $view2 .= '<td>'.$result["pposition"].'</td>';
        $view2 .= '<td>'.$result["pnumber"].'</td>';
        $view2 .= '<td>'.$result["pheight"]."cm".'</td>';
        $view2 .= '<td>'.$result["pweight"]."kg".'</td>';
        $view2 .= '<td>'.$result["pbirthday"].'</td>';
        $view2 .= '<td>'.$result["previousteam"].'</td>';

        if($_SESSION["kanri_flg"]=="0"){
        $view2 .=
        "<td><a href='soccer_player_detail3.php?pid=".$result["pid"]."'>詳細</a></td>";
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
<li ><a href="soccer_select3.php">全データ一覧</a></li>
<li class="active"><a href="soccer_player3.php">選手一覧</a></li>
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
    <h2>選手名一覧</h2>
</div>
    <div class="container jumbotron"><?=$view1?><?=$view2?><?=$view3?></div>
<!-- Main[End] -->


</body>
</html>