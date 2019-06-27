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

//1. id受け取り
$id = $_GET["id"];

//2. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//3．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_soccer_table2 WHERE id=:id");//$idではなく、バインド変数:idを使う
$stmt->bindValue(":id", $id, PDO::PARAM_INT);//DBにとって危ない文字をbindValueで排除
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
}
$row = $stmt->fetch();//一番上のレコードを取得する

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>選手コンディション更新</title>
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
<li><a href="soccer_select3.php">全データ一覧</a></li>
<li><a href="soccer_player3.php">選手一覧</a></li>
</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
</header>
<!-- Head[End] -->

<main>
<form class="form-horizontal" method="post" action="soccer_update3.php">

    <!-- 練習日時 -->
    <div class="form-group">
        <label for="inputDate"class="col-sm-2 control-label">練習日時</label>
        <div class="col-sm-2">
        <input type="date" class="form-control" id="inputDate" name="sdate" value="<?=$row["sdate"]?>">
        </div>
    </div>

    <!-- 選手id -->
    <div class="form-group">
        <label for="selectPlayer" class="col-sm-2 control-label">選手id</label>
        <div class="col-sm-2">
                <input type="text" class="form-control" id="inputPlayerName" name="pid" value="<?=$row["pid"]?>">
            </select>
        </div>
    </div>

    <!-- コンディション -->
    <div class="form-group">
        <label for="inputPlayerCondition" class="col-sm-2 control-label">コンディション</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerCondition" name="pcondition" value="<?=$row["pcondition"]?>">
        </div>
    </div>

    <!-- 気になる部位 -->
    <div class="form-group">
        <label for="inputPlayerCare" class="col-sm-2 control-label">部位チェック</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerCare" name="pcare" value="<?=$row["pcare"]?>">
        </div>
    </div>

    <!-- 練習強度（選手） -->
    <div class="form-group">
        <label for="inputTraining" class="col-sm-2 control-label">練習強度（選手）</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputTraining" name="training" value="<?=$row["training"]?>">
        </div>
    </div>

    <!-- 練習強度（監督） -->
    <div class="form-group">
        <label for="inputTraining2" class="col-sm-2 control-label">練習強度（監督）</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputTraining2" name="training2" value="<?=$row["training2"]?>">
        </div>
    </div>


    <!-- 送信 -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">更新</button>
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        </div>
    </div>

</form>

</main>
<!-- Main[End] -->

</body>
</html>
