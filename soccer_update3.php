<?php

//1. POSTデータ取得
$pid = $_POST["pid"];
$sdate = $_POST["sdate"];
$pcondition = $_POST["pcondition"];
$pcare = $_POST["pcare"];
$training = $_POST["training"];
$training2 = $_POST["training2"];
$id = $_POST["id"];

//2. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//３．データ登録SQL作成
$sql = "UPDATE gs_soccer_table2 SET pid=:pid, sdate=:sdate, pcondition=:pcondition, pcare=:pcare, training=:training, training2=:training2 WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pid', $pid, PDO::PARAM_STR);
$stmt->bindValue(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindValue(':pcondition', $pcondition, PDO::PARAM_STR);
$stmt->bindValue(':pcare', $pcare, PDO::PARAM_INT);
$stmt->bindValue(':training', $training, PDO::PARAM_INT);
$stmt->bindValue(':training2', $training2, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: soccer_select3.php");
}
?>