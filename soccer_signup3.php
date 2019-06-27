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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サッカー選手登録</title>
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
<li><a href="soccer_player3.php">選手一覧</a></li>
<li><a href="soccer_select3.php">全データ一覧</a></li>
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
<form class="form-horizontal" method="post" action="soccer_insert2.php" enctype="multipart/form-data">

    <!-- 選手ID -->
    <div class="form-group">
        <label for="inputplayerId"class="col-sm-2 control-label">選手ID</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputplayerId" name="pid">
        </div>
    </div>

    <!-- 選手名 -->
    <div class="form-group">
        <label for="inputPlayerName" class="col-sm-2 control-label">選手名</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerName" name="pname" placeholder="氏名">
        </div>
    </div>

    <!-- 背番号 -->
    <div class="form-group">
        <label for="inputPlayerNumber" class="col-sm-2 control-label">背番号</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerNumber" name="pnumber">
        </div>
    </div>

    <!-- ポジション -->
    <div class="form-group">
        <label for="inputPlayerPosition" class="col-sm-2 control-label">ポジション</label>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="pposition" id="inlineRadio1" value="FW">FW</label>
            <label class="radio-inline"><input type="radio" name="pposition" id="inlineRadio2" value="MF">MF</label>
            <label class="radio-inline"><input type="radio" name="pposition" id="inlineRadio3" value="DF">DF</label>
            <label class="radio-inline"><input type="radio" name="pposition" id="inlineRadio4" value="GK">GK</label>
        </div>
    </div>

    <!-- 選手身長 -->
    <div class="form-group">
        <label for="inputPlayerHeight" class="col-sm-2 control-label">身長</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerHeight" name="pheight" min="100" max="250">
        </div>
    </div>

    <!-- 選手体重 -->
    <div class="form-group">
        <label for="inputPlayerWeight" class="col-sm-2 control-label">体重</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerWeight" name="pweight" min="40" max="120">
        </div>
    </div>

    <!-- 選手生年月日 -->
    <div class="form-group">
        <label for="inputPlayerBirthday" class="col-sm-2 control-label">生年月日</label>
        <div class="col-sm-2">
        <input type="date" class="form-control" id="inputPlayerBirthday" name="pbirthday">
        </div>
    </div>

    <!-- 前所属チーム名 -->
    <div class="form-group">
        <label for="inputPlayerPreviousTeam" class="col-sm-2 control-label">前所属</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputPlayerPreviousTeam" name="previousteam">
        </div>
    </div>

    <!-- ファイルアップ -->
    <div class="form-group">
        <label for="inputPlayerPhoto" class="col-sm-2 control-label">顔写真</label>
        <div class="col-sm-2">
        <input type="file" name="upfile">
        </div>
    </div>

    <!-- 送信 -->
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">選手登録</button>
        </div>
    </div>
</form>

</main>
<!-- Main[End] -->

</body>
</html>