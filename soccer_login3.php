<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サッカー選手コンディション管理システムログイン</title>
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
<a class="navbar-brand" href="soccer_login3.php">シン・ギ・タイ(仮)</a>
<!--こちらにサイト名を入れます。-->
</div>

<!--/.nav-collapse -->
</div>
</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<main>

<!-- postでsoccer_login_act.phpに送信 -->
<form class="form-horizontal" method="post" action="soccer_login_act3.php">
    <div class="container">
    <!-- ID -->
        <div class="form-group">
            <label for="inputPlayerId" class="col-sm-2 control-label">ID:</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="inputPlayerid" name="lid" placeholder="IDを入力">
        </div>
        </div>

    <!-- PS -->
        <div class="form-group">
            <label for="inputPlayerPs" class="col-sm-2 control-label">PW:</label>
            <div class="col-sm-2">
            <input type="password" class="form-control" id="inputPlayerPs" name="lpw" placeholder="パスワードを入力">
        </div>
        </div>

            <!-- 送信 -->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">ログイン</button>
        </div>
        </div>
    </div>
</form>


</main>
<!-- Main[End] -->

</body>
</html>