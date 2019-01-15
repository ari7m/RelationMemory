<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <h2 class = "title">
        ユーザ情報の登録
    </h2>
    <?php
        // mysqlと接続
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        //データをとってsそれぞれ配列$nameX[]へ
        $sql = "Select question_1_name from secret_question_1";
        $zenbu = $link -> query($sql);
        $name1 = [0, 0, 0, 0, 0];
        $i = 0;
        foreach ($zenbu as $row) {
            $name1[$i] =  $row['question_1_name'];
            $i = $i + 1;
        }
        $sql = "Select question_2_name from secret_question_2";
        $zenbu = $link -> query($sql);
        $name2 = [0, 0, 0, 0, 0];
        $i = 0;
        foreach ($zenbu as $row) {
            $name2[$i] =  $row['question_2_name'];
            $i = $i + 1;
        }
        $sql = "Select question_3_name from secret_question_3";
        $zenbu = $link -> query($sql);
        $name3 = [0, 0, 0, 0, 0];
        $i = 0;
        foreach ($zenbu as $row) {
            $name3[$i] =  $row['question_3_name'];
            $i = $i + 1;
        }
        //型の確認
        //var_dump($name1);
    ?>
</head>

<body>
    <form action = "Create_check.php" method = "GET">
    <div align = "center">
        <div style="float:left;width:45%;" align = "right">
            ユーザID(半角英数字と記号) <br /><br />
            ユーザ名(全角)<br /><br />
            パスワード(半角英数字と記号) <br /><br />
            パスワードの再入力
        </div>

        <div style="float:left;width:10%;">
            &nbsp;<!--ここ全角スペース-->
        </div>

        <div align = "left" style="float:left;width:45%;">
            <input type = "text" name = "name" /> <br /><br />
            <input type = "text" name = "ID" /> <br /><br />
            <input type = "password" name = "pwd" /> <br /><br />
            <input type = "password" name = "repwd" />
        </div>

        <div style="clear:both;"></div>
    </div>

    <h2 class = "title">
        秘密の質問
    </h2>
    <div align = "center">
        <div style="float:left;width:45%;" align = "right">
            質問項目 <br /><br />
            <select name = "q1" width = "40px">
                <option value=""></option>
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<option value = "', $name1[$i], '">', $name1[$i], '</option>';
                    }
                ?>
            </select> <br /><br />

            <select name = "q2" width = "40px">
                <option value=""></option>
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<option value = "', $name2[$i], '">', $name2[$i], '</option>';
                    }
                ?>
            </select> <br /><br />

            <select name = "q3">
                <option value=""></option>
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<option value = "', $name3[$i], '">', $name3[$i], '</option>';
                    }
                ?>
            </select> <br /><br />

        </div>

        <div style="float:left;width:10%;">
            &nbsp;<!--ここ全角スペース-->
        </div>

        <div align = "left" style="float:left;width:45%;">
            回答 <br /><br />
            <input type = "text" name = "answer1" /> <br /><br />
            <input type = "text" name = "answer2" /> <br /><br />
            <input type = "text" name = "answer3" />
        </div>

        <div style="clear:both;"></div>
    </div>

    <div align = "center">
        <div>
            <!--<form action = "Create_check.php">-->
                <input  id = "green" type = "submit" value = "登録確認へ">
        <!--</form>-->
        </div>
    </div>
    </form>
</body>

</html>
