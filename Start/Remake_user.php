<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <h2 class = "title">
        新しいユーザ情報の登録
    </h2>
    <?php
        // mysqlと接続
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        // とってきたデータがあるかどうか
        /*$a1 = $_POST['a1'];
        $a2 = $_POST['a2'];
        $a3 = $_POST['a3'];*/
        $sql = 'select user_id from user
                where question_1_id = 1 and question_1_ans = "緑茶"
                and question_2_id = 1 and question_2_ans = "syamu_game"
                and question_3_id = 1 and question_3_ans = "コンソメ"';
        $stmt = $link -> query($sql);
        $tf = $stmt -> fetchColumn();
        var_dump($tf);
    ?>
    <script>
        function CheckPassword(repwd){
            // 入力値取得
            var input1 = pwd.value;
            var input2 = repwd.value;
            // パスワード比較
            if(input1 != input2){
                repwd.setCustomValidity("入力値が一致しません。");
            }else{
                repwd.setCustomValidity('');
            }
        }
    </script>
</head>

<body>
    <form action = "Create_check.php" method = "post">
    <div align = "center">
        <div style="float:left;width:45%;" align = "right">
            ユーザ名(全角)<br /><br />
            パスワード(半角英数字と記号) <br /><br />
            パスワードの再入力
        </div>

        <div style="float:left;width:10%;">
            &nbsp;<!--ここ全角スペース-->
        </div>

        <div align = "left" style="float:left;width:45%;">
            <input type = "text" name = "name" maxlength = "256" pattern = "[^\x20-\x7E\xA1-\xDF]*" required/> <br /><br />
            <input type = "password" name = "pwd" id = "pwd" maxlength = "256" pattern = "^[!-~]+$" required/> <br /><br />
            <input type = "password" name = "repwd" id = "repwd" oninput="CheckPassword(this)" required/>
        </div>

        <div style="clear:both;"></div>
    </div>
    <div align = "center">
        <div>
            <input  id = "green" type = "submit" value = "登録確認へ">
        </div>
    </div>
    </form>
</body>

</html>
