<?php
session_start();
$ID = $_SESSION['ID'];
include "access_db.php"; // データベース取得
$sql = "select * from tag where user_id = '". $ID. "' "; //abc123の部分にログイン時のuser_id入れてー
$stmt = $dbh -> query($sql);
$tag_cnt = 0;

foreach ($stmt as $row){
    $user_id = $row["user_id"]; // user_idの確保

    $tag_cnt++;


}
var_dump($user_id);
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <title>
        タグ設定
    </title>
    <script type="text/javascript" src="Setting_tag.js"></script>
</head>
<body>
    <h2 class = "title">
        登録情報設定
    </h2>
    <div align = "center">
        <form action='upd.php' method="post" >
            <div style="float:left;width:35%;" align = "right">
                <b>
                    タグ
                </b>
                <br/> <br/>

                <input type = "button" value = "追加" onclick = "CreateForm('tag')" align = "center"/>
                <br/><br/>
                <input type = "submit" value ="更新"align = "center"/ >
            </div>

            <div style="float:left;width:10%;">
                &nbsp;
            </div>

            <div id = "tag"  data-cntTag = <?php echo '"'.$tag_cnt.'"'; ?>  align = "left" style="float:left;width:55%;">

                <!-- <form action='upd.php' method="post" > -->
                <?php
                $sql = "select * from tag where user_id = '$user_id'";
                $stmt = $dbh -> query($sql);
                $tag_cnt = 0;
                foreach ($stmt as $row){
                    $tag_cnt++;
                    echo '<input id = "tag'.$tag_cnt.'" type = "tex" value = "'.$row["tag_name"].'" name = "tag'.$tag_cnt.'" align = "center"/ >';
                    if ($tag_cnt != 1 ){
                        echo '<input id = "button'.$tag_cnt.'" type = "button" value = "削除" onclick = "RemoveForm('.$tag_cnt.',\'tag\')">';
                    }
                    echo '<br/>';
                    echo '<br/>';
                }
                ?>

                <!--  <div   data-cntTag = <?php echo '"'.$tag_cnt.'"'; ?>  > </div> -->
            </div>
            <div style="clear:both;"></div>
        </form>
    </div>

    <br /><br />

</body>
</html>
