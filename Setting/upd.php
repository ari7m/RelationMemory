<?php
session_start();
$ID = $_SESSION['ID'];
include "access_db.php"; // データベース取得
$sql = "select * from user where user_id = '". $ID. "'";
$stmt = $dbh -> query($sql);

foreach ($stmt as $row){
    $user_id = $row["user_id"]; // user_idの確保
}

?>
<html>
<?php
$sql =" DELETE FROM tag WHERE user_id ='$user_id'";
$delete_tag = $dbh -> query($sql);
$i = 1;
$tag_id = 1;
while ($i < 30){
    if(!empty($_POST['tag'.$i])){ //post != null
        echo $_POST['tag'.$i];
        $sql = "insert into tag(user_id, tag_id, tag_name) values('{$user_id}', {$tag_id}, '{$_POST['tag'.$i]}')";
        $upd =  $dbh -> query($sql);
        $tag_id++;
    }
    $i++;
}
?>
<script>
location.href = 'Setting_tag.php';
</script>
</html>
