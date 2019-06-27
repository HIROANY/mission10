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

//2. pid受け取り
$pid = $_GET["pid"];

//3. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//4．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_soccer_table2 WHERE pid=:pid");//$numberではなく、バインド変数:numberを使う
$stmt->bindValue(":pid", $pid, PDO::PARAM_INT);//DBにとって危ない文字をbindValueで排除
$status = $stmt->execute();

//5．データ表示
$view1 = '<table class="table table-striped">'.
"<tr>
<th>id</th>
<th>選手id</th>
<th>練習日付</th>
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
        <td>".$result["pid"]."</td>
        <td>".$result["sdate"]."</td>
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

<!-- グラフ作成開始 -->
<?php

$dateGraph = [];//日付グラフ
$trainingGraph = [];//練習強度（選手）

$php_json ="";//jsonエンコード

?>

<?php

//0. id受け取り
$number = $_GET["number"];

//1. DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db_soccer;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('データベースに接続できませんでした！'.$e->getMessage());
}

//２．データ表示SQL作成
$stmt = $pdo->prepare("SELECT sdate,training FROM gs_soccer_table");

$status = $stmt->execute();

//３．データ表示
if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt2->errorInfo();
    exit("ErrorQuery".$error[2]);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $dateGraph[] = $result["sdate"];
        $trainingGraph[] = $result["training"];
    }
        //PHPからJavascriptにデータを渡すためにjsonエンコード
        $php_json1 = json_encode($dateGraph);
        $php_json2 = json_encode($trainingGraph);
}
?>

<script>
let chart_array = [];

//jsonにエンコードした配列をjsの配列に代入
let js_array1 = <?php echo $php_json1; ?>;
let js_array2 = <?php echo $php_json2; ?>;

//上記2つの配列を1つにまとめる
for(i=0;i<=js_array1.length-1;i++){

chart_array[i] = [js_array1[i], js_array2[i]];

}

//日付ごとの練習強度（選手）を棒グラフ化する
anychart.onDocumentLoad(function() {
  // create a chart and set the data
  let chart = anychart.column(chart_array);
  // set chart title
  chart.title("登録日付・練習強度（選手）グラフ");
  // set chart container and draw
  chart.container("container").draw();
});
</script>
<!-- グラフ作成終了 -->


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サッカー選手個人データ一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.anychart.com/js/latest/anychart-bundle.min.js"></script>
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
    <h2>サッカー選手個人データ一覧</h2>
</div>
    <div class="container jumbotron"><?=$view1?><?=$view2?><?=$view3?></div>
    <div id="container"></div>
<!-- Main[End] -->

</body>
</html>