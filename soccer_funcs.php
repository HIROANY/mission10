<?php

function db_con(){
    try{
        $pdo = new PDO('mysql:dbname=gs_db_soccer;charset=utf8;host=localhost','root','');
        return $pdo;
    } catch (PDOException $e) {
        exit('データベースに接続できませんでした！'.$e->getMessage());
    }
}

?>