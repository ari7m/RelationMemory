<head>
   <?php
       session_start();
       $ID = $_SESSION['ID'];
   ?>
</head>

<?php
  include "access_db.php"; // データベース取得
  $sql = "select * from info_a where user_id = 'abc123' "; 
  $stmt = $dbh -> query($sql);
  $cnt = 0;

foreach ($stmt as $row){
$user_id = $row["user_id"]; // user_idの確保
$cnt = $row["manage_id"];
}
$check = $cnt;
?>

<html>

<?php
// 受信ダイアログで取得した情報でshareテーブルを調べる
$sql = "select * from share where
       receive_user_id = '$user_id' 
      AND send_user_id = '$_POST[send_id]'
      AND aikotoba = '$_POST[aikotoba]'";
       $stmt = $dbh -> query($sql);
       
       foreach ($stmt as $row){     
       $manage_id =  $row["manage_id"];
       $cnt++;
       //shareテーブルから得たmanege_idの情報のコピー
       //info_a
       $sql = "select * from info_a where user_id = '$_POST[send_id]' AND manage_id = '$manage_id' ";
       $copy_a  = $dbh -> query($sql);
       
       foreach ($copy_a as $row){
       $surname = $row["surname"];
       $name = $row["name"];
$surname_ruby = $row["surname_ruby"];
$name_ruby = $row["name_ruby"];
if ($row["met_year"]=="") $met_year = 0;
 else $met_year = $row["met_year"];
 
 if($row["met_month"]=="") $met_month = 0;
 else $met_month = $row["met_month"];

if($row["met_day"]=="") $met_day = 0;
else $met_day = $row["met_day"];

if($row["birth_year"]=="")$birth_year = 0;
else $birth_year = $row["birth_year"];

if($row["birth_month"]=="")$birth_month = 0;
else $birth_month = $row["birth_month"];

if($row["birth_day"]=="")$birth_day = 0;
else $birth_day = $row["birth_day"];

$gender = $row["gender"];

$sql = "INSERT INTO info_a(user_id,manage_id,surname,name,surname_ruby,name_ruby,gender,tag_id,met_year,met_month,met_day,birth_year,birth_month,birth_day) VALUES('$user_id','$cnt','$surname','$name','$surname_ruby','$name_ruby','$gender','0','$met_year','$met_month','$met_day','$birth_year','$birth_month','$birth_day')";

$insert =  $dbh -> query($sql);
       }
       //info_b
       $sql = "select * from info_b where user_id = '$_POST[send_id]' AND manage_id = '$manage_id' ";
       $copy_b  = $dbh -> query($sql);
       
       foreach ($copy_b as $row){
$blood_type =  $row["blood_type"];
$feature = $row["feature"];
$hobby = $row["hobby"];
$met_space = $row["met_space"];
$free_space = $row["free_space"];
       
       $sql = "INSERT INTO info_b(user_id,manage_id,blood_type,feature,hobby,met_space,free_space) VALUES('$user_id','$cnt','$blood_type','$feature','$hobby','$met_space','$free_space')";
        $insert =  $dbh -> query($sql);
      }
      }
       
 if ($check == $cnt){
 $result = '受信できませんでした';
} else {
$num = $cnt - $check;
$result = $num.'個の管理情報受信しました';
 }
?>
<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Mitame.css">
  <br/>
  <h3 class = "title">
    <?php echo $result;   ?></h3>
  <center>
   <br><br>  <br><br>  <br><br>
 <input type = "button" value = "ホームに戻る" id = "button">
  </center>

</html>
