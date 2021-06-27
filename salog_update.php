<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$name =$_POST['name'];
$email =$_POST['email'];
$home_sauna =$_POST['home_sauna'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare( "UPDATE member_an_table SET name = :name, email = :email, home_sauna = :home_sauna, indate = sysdate() 
WHERE id = :id;" );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':email', $email, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':home_sauna', $home_sauna, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('salog_select.php');
}