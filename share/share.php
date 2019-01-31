<head>
    <?php
    session_start();
    $ID = $_SESSION['ID'];
    ?>
    <title>共有画面</title>
    <link rel="stylesheet" type="text/css" href="Main.css">
</head>

<?php
include "access_db.php"; // データベース取得
$sql = "select * from user where user_id = '". $ID. "' ";
$stmt = $dbh -> query($sql);

foreach ($stmt as $row){
    $user_id = $row["user_id"]; // user_idの確保
}
$cnt=1;

?>

<html>
<head>
    <title>共有画面</title>
    <link rel="stylesheet" type="text/css" href="Main.css">
</head>
<br>
<body>
    <div align = "center">

        <form action='receive.php' method="post"> <!-- 相手のIDと合言葉を受信画面に飛ばす -->
            <dialog>
                <h3 class = "title">
                    管理情報の受信</h3>

                    <form >
                        相手のID　
                        <input type = "text" name = "send_id">
                        <br>
                        合言葉　
                        <input type = "text" name = "aikotoba"><br />

                    </form>

                    <div class = "button_place">
                        <input type = "submit" value = "受信する">
                        <input type = "button" value = "キャンセル" id = "close">
                    </div>
                </dialog>
            </form>

            <input type= "button" value = "受信する" id = "receive">
        </div>

        <script>
        function receive_check(send_id,aikotoba){ //受信する際のID,合言葉チェック

            <?php
            $sql = "select * from share where receive_user_id = '$user_id' AND send_user_id = 'send_id' AND aikotoba = aikotoba";
            $stmt = $dbh -> query($sql);
            ?>
            location.href = "receive.php";
        }
        </script>

        <form action='send.php' method="post"> <!-- checkした項目を送信画面に飛ばす -->
            <div class="chkbox" id="id_1">
                <center>
                    <?php
                    //管理情報の表示
                    if(!empty($_POST['Tag'])) { //POST[tag]の値がnullまたは0でないなら
                        $tag_id = $_POST['Tag'];
                        $sql = "select * from info_a where user_id = '$user_id' AND tag_id = '$tag_id' ";
                    }
                    else{ //POSTの値が0またはnull
                        $sql = "select * from info_a where user_id = '$user_id' ";
                    }
                    $stmt = $dbh -> query($sql);

                    foreach ($stmt as $row){
                        $surname = $row["surname"];
                        $name = $row["name"];
                        $M_id = $row["manage_id"];
                        echo ' <input type="checkbox" id="chkbox'.$cnt.'" name="chkbox'.$cnt.'" value = "'.$M_id.'">';
                        echo '<label for="chkbox'.$cnt.'">';
                        echo '<image src="image.png" class="image">';
                        echo ' <button class="button" type="button" >';echo $surname."　".$name; echo'</button>';
                        echo'</label>';

                        $cnt++;
                        if ($cnt%2 != 0)  echo '<br/>';
                        else echo "　　　 ";

                    }
                    ?>
                </center>

            </div>

            <div align = "center">
                <input type= "button" value = "送信する" id = "open2">
                <br/><br/>
            </div>

            <dialog id ="dialog2">
                <h3 class = "title">
                    管理情報の送信</h3>
                    宛先ID　
                    <input type = "text" name = "id">
                    <br>
                    合言葉　
                    <input type = "text" name = "aikotoba"><br />


                    <!--onclick = " location.href = 'Setting_changed.html' "-->
                    <div class = "button_place">
                        <input type = "submit" value = "送信する" !--onclick = " location.href = 'Main.html' "--id = 'login'>
                        <input type = "button" value = "キャンセル" id = "close2">
                    </div>
                </dialog>
            </form>
        </div>
        <form action='share.php' method="post"> <!--タグのIDを返す -->
            <ul class="tag">
                <!--タグ部分の表示 -->
                <!--すべて -->
                <li id="alltag"><label><input type="submit" name="Tag" style="display:none" value = "0" /><span>全て</span></label></li>
                <?php
                //DBからタグ情報を取得し表示
                $sql = "select * from tag where user_id = '$user_id' ";
                $stmt = $dbh -> query($sql);
                foreach ($stmt as $row){
                    $tag_name = $row["tag_name"];
                    $cnt = $row["tag_id"];
                    echo '<li id="tag'.$cnt.'">'; echo '<label>';
                    echo '<input type="submit" name="Tag" style="display:none" value = "'.$cnt.'"/>';
                    echo '<span>';
                    echo $tag_name;
                    echo '</span>'; echo '</label>'; echo '</li>';
                }
                ?>
            </ul>
        </form>



        <script>
        var dialog = document.querySelector('dialog');
        var btn_show = document.getElementById('receive');
        var btn_close = document.getElementById('close');
        btn_show.addEventListener('click', function() {
            dialog.showModal();
        }, false);
        btn_close.addEventListener('click', function() {
            dialog.close();
        }, false);

        function toggleInputType(chk) {
            if (chk.checked) {
                document.forms[0].inputPassword.type = "password";
            } else {
                document.forms[0].inputPassword.type = "text";
            }
        }

    </script>


    <script>
    window.addEventListener('load', function() {
        var dialog2 = document.getElementById('dialog2');
        var open2 = document.getElementById('open2');
        var text2 = document.getElementById('text2');
        var close2 = document.getElementById('close2');
        open2.addEventListener('click', function() {
            dialog2.showModal();
        });
        close2.addEventListener('click', function() {
            dialog2.close();
        });
    });
</script>
</body>
</html>
