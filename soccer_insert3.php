<?php

//1. soccer_index3.phpから送られてきたデータを変数で受け取る
$sdate = $_POST["sdate"];//練習日付
$pid =  $_POST["pid"];//選手id
$pcondition =  $_POST["pcondition"];//選手コンディション
$pcare = $_POST["pcare"];//要ケア部位

// //3. 登録日の曜日
// $datetime = new DateTime($sdate);
// $week = array("日", "月", "火", "水", "木", "金", "土");
// $w = (int)$datetime->format('w');
// $sweek = $week[$w];

//4. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//5．データ登録SQL作成
$stmt = $pdo->prepare(
    "INSERT INTO gs_soccer_table2(id,sdate,pid,pcondition,pcare)
    VALUE(NULL,:sdate,:pid,:pcondition,:pcare)");
$stmt->bindValue(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindValue(':pid', $pid, PDO::PARAM_STR);
$stmt->bindValue(':pcondition', $pcondition, PDO::PARAM_STR);
$stmt->bindValue(':pcare', $pcare, PDO::PARAM_INT);

$status = $stmt->execute();

//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQLエラーです。".$error[2]);
}else{
    //５．soccer_index3.phpへリダイレクト　この処理がないと画面が切り替わらない
    header("Location: soccer_index3.php");
}
?>