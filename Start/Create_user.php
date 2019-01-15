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
            ユーザID(半角英数字と記号) <br /><br />
            パスワード(半角英数字と記号) <br /><br />
            パスワードの再入力
        </div>

        <div style="float:left;width:10%;">
            &nbsp;<!--ここ全角スペース-->
        </div>

        <div align = "left" style="float:left;width:45%;">
            <input type = "text" name = "name" required/> <br /><br />
            <input type = "text" name = "ID" required/> <br /><br />
            <input type = "password" name = "pwd" id = "pwd" required/> <br /><br />
            <input type = "password" name = "repwd" id = "repwd" oninput="CheckPassword(this)" required/>
        </div>

        <div style="clear:both;"></div>
    </div>

    <h2 class = "title">
        秘密の質問
    </h2>
    <div align = "center">
        <div style="float:left;width:45%;" align = "right">
            質問項目 <br /><br />
            <select name = "q1" width = "40px" required>
                <option value=""></option>
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<option value = "', $name1[$i], '">', $name1[$i], '</option>';
                    }
                ?>
            </select> <br /><br />

            <select name = "q2" width = "40px" required>
                <option value=""></option>
                <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo '<option value = "', $name2[$i], '">', $name2[$i], '</option>';
                    }
                ?>
            </select> <br /><br />

            <select name = "q3" width = "40px" required>
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
            <input type = "text" name = "answer1" required/> <br /><br />
            <input type = "text" name = "answer2" required/> <br /><br />
            <input type = "text" name = "answer3" required/>
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
