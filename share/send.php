<head>
   <?php
       session_start();
       $ID = $_SESSION['ID'];
   ?>
</head>

<?php
  include "access_db.php"; // データベース取得
  $sql = "select * from info_a where user_id = '". $ID. "' ";
  $stmt = $dbh -> query($sql);

foreach ($stmt as $row){
$user_id = $row["user_id"];// user_idの確保
$cnt = $row["manage_id"];
}
$cnt++;
$check = 0;

?>
<html>

<?php
$receve_id =  $_POST['id'];
$aikotoba =  $_POST['aikotoba'];

if($receve_id == "" || $aikotoba == "" ){
$result = '送信できませんでした。宛先ID、合言葉を正しく設定してください';
 } else {
for($i = 1; $i < $cnt ;$i++ ){
 if(!empty($_POST['chkbox'.$i])){ //post != null
	   $M_id =  $_POST['chkbox'.$i];
	   $sql = "insert ignore into share values('$user_id','$receve_id','$aikotoba','$M_id')";
	   $share =  $dbh -> query($sql);
	   $check++;
	   }
}
if ($check == 0 ) $result = '送信できませんでした。送信する管理情報を選択してください';
else $result = $check.'個の管理情報を'.$receve_id.'に送信しました。';
}

?>
<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Mitame.css">
  <br/>
  <h3 class = "title">
   <?php echo $result;   ?></h3>
   <center>
   <br><br>  <br><br>  <br><br>
 <input type = "button" value = "ホームに戻る"  onclick = " location.href = '../Home/Main.html'" id = "button">
  </center>
</html>
