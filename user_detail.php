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
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");//$idではなく、バインド変数:idを使う
$stmt->bindValue(":id", $id, PDO::PARAM_INT);//DBにとって危ない文字をbindValueで排除
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
}else{
  $row = $stmt->fetch();//一番上のレコードを取得する

  //管理者以外更新不可
  if($_SESSION["kanri_flg"]=="0"){
    $readonly = "";
  }else{
    $readonly = " readonly";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>管理者更新</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>main{padding-top: 100px;font-size:16px;}</style>
</head>
<body>

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
<main>
<form class="form-horizontal" method="post" action="user_update.php">

    <!-- 名前 -->
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">名前</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputName" name="name" value="<?=$row["name"]?>"<?=$readonly?>>
        </div>
    </div>

    <!-- ID -->
    <div class="form-group">
        <label for="inputId" class="col-sm-2 control-label">ID</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputId" name="lid" value="<?=$row["id"]?>"<?=$readonly?>>
        </div>
    </div>

    <!-- PS -->
    <div class="form-group">
        <label for="inputPw" class="col-sm-2 control-label">PS</label>
        <div class="col-sm-2">
        <input type="password" class="form-control" id="inputPw" name="lpw" value="<?=$row["lpw"]?>"<?=$readonly?>>
        </div>
    </div>

    <!-- 管理権限フラグ -->
    <div class="form-group">
        <label for="inputKf" class="col-sm-2 control-label">管理権限フラグ</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputKf" name="kanri_flg" value="<?=$row["kanri_flg"]?>"<?=$readonly?>>
        ※0:admin 1:player 2:viewer
        </div>
    </div>

    <!-- アクティブフラグ -->
    <div class="form-group">
        <label for="inputLf" class="col-sm-2 control-label">アクティブフラグ</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="inputLf" name="life_flg" value="<?=$row["life_flg"]?>"<?=$readonly?>>
        ※0:inactive 1:active
        </div>

    </div>

    <!-- 送信 -->
    <?php if($_SESSION["kanri_flg"]=="0"){ ?>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">更新</button>
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        </div>
      <?php } ?>
    </div>
</form>
<!-- Main[End] -->

</body>
</html>
