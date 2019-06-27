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
$stmt = $pdo->prepare("SELECT DISTINCT pid,pname FROM gs_player_table");

$status = $stmt->execute();

//3. データ表示

if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
        $view .=
        "<option value ="
        .$result["pid"].
        ">"
        .$result["pname"].
        "</option>";
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
<a class="navbar-brand" href="#">シン・ギ・タイ(仮)</a>
<!--こちらにサイト名を入れます。-->
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="soccer_index3.php">選手コンディション登録</a></li>
<li><a href="soccer_select3.php">全データ一覧</a></li>
<li><a href="soccer_player3.php">選手一覧</a></li>
<!-- <li><a href="tachometer.php">コンディションメーター</a></li> -->
<li><a href="soccer_signup3.php">選手登録</a></li>
<li><a href="user_index.php">管理者登録</a></li>
<li><a href="soccer_logout3.php">ログアウト</a></li>
</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<main>
<form class="form-horizontal" method="post" action="soccer_insert3.php" enctype="multipart/form-data">

    <!-- 練習日時 -->
    <div class="form-group">
        <label for="inputDate"class="col-sm-2 control-label">練習日時</label>
        <div class="col-sm-2">
        <input type="date" class="form-control" id="inputDate" name="sdate" value="<?=date('Y-m-j')?>">
        </div>
    </div>

    <!-- 選手名プルダウン -->
    <div class="form-group">
        <label for="selectPlayer" class="col-sm-2 control-label">選手名</label>
        <div class="col-sm-2">
                <select class="form-control" id="selectPlayer" name="pid">
                <?=$view?>
            </select>
        </div>
    </div>

    <!-- コンディション -->
    <div class="form-group">
        <label for="inputPlayerCondition" class="col-sm-2 control-label">コンディション</label>
        <div class="col-sm-2">
            <select class="form-control" id="inputPlayerCondition" name="pcondition">
                <option value="99">10段階評価（10:最高/1:最低）</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
                </select>
        </div>
    </div>

    <!-- 気になる部位 -->
    <div class="form-group">
        <label for="inputPlayerCare" class="col-sm-2 control-label">部位チェック</label>
        <div class="col-sm-2">
            <select class="form-control" id="inputPlayerCare" name="pcare">
                <option value="99">疲れ・張りのある部位</option>
                <option value="1">右前腿（みぎまえもも）</option>
                <option value="2">左前腿（ひだりまえもも）</option>
                <option value="3">右後腿（みぎうしろもも）</option>
                <option value="4">左後腿（ひだりうしろもも）</option>
                <option value="5">右脹脛（みぎふくらはぎ）</option>
                <option value="6">左脹脛（ひだりふくらはぎ）</option>
                <option value="0">特になし</option>
                </select>
        </div>
    </div>

    <!-- 送信 -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">登録</button>
        </div>
    </div>
</form>
</main>
<!-- Main[End] -->

</body>
</html>