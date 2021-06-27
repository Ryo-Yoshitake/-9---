<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM member_an_table WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}


?>

<!-- 以下はsalog_register_form.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/saunalog.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Main[Start] -->
<form method="POST" action="salog_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>無料会員登録</legend>
     <label>アカウント名：<input type="text" name="name"></label><br>
     <label>メールアドレス：<input type="text" name="email"></label><br>
     <label>ホームサウナを選択：<select name="home_sauna">
         <option value="サウナ&カプセルホテル レインボー新小岩店">サウナ&カプセルホテル レインボー新小岩店</option>
         <option value="Spa Resort 蘭々の湯">Spa Resort 蘭々の湯</option>
         <option value="新宿区役所前カプセルホテル">新宿区役所前カプセルホテル</option>
         <option value="ドシー五反田">ドシー五反田</option>
         <option value="サウナ錦糸町">サウナ錦糸町</option>
         <option value="新宿天然温泉 テルマー湯">新宿天然温泉 テルマー湯</option>
         <option value="豊の国健康ランド">豊の国健康ランド</option>
         <option value="サウナセンター">サウナセンター</option>
         <option value="横浜天然温泉 SPA EAS">横浜天然温泉 SPA EAS</option>
         <option value="錦糸町 スパ&カプセル ニューウィング">錦糸町 スパ&カプセル ニューウィング</option>
     </select></label><br>
     <input class="touroku" type="submit" value="登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="./saunalog.html">戻る</a></div>
    </div>
</nav>

<div class="data_check">
  <a class="data_check_link" href="salog_select.php">会員データ一覧</a>
</div>


</body>
</html>