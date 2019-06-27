<?php

//1. id受け取り
$id = $_GET["id"];

//2. DB接続
include "soccer_funcs.php";
$pdo = db_con();

//3．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");//$idではなく、バインド変数:idを使う
$stmt->bindValue(":id", $id, PDO::PARAM_INT);//DBにとって危ない文字をbindValueで排除
$status = $stmt->execute();

//4．データ削除
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: user_select.php");
}

?>