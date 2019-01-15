<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <h2 class = "title">
        ユーザ情報の登録
    </h2>
    <?php
        // mysqlと接続
        $dsn = "mysql:host=localhost; dbname=rmdb; charset=utf8";
        $link = new PDO($dsn, "wolf", "password");

        $sql = "Select question_1_name from secret_question_1 where id = 1";
        $q1_1 = $link -> query($sql);
        echo $q1_1;
    ?>
</head>

<body>
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
                <option value = "item">
                    地元の特産物
                </option>
                <option value = "sporter">
                    好きなスポーツ選手
                </option>
                <option value = "conv">
                    好きなコンビニ
                </option>
                <option value = "pett">
                    初めてのペットの名前
                </option>
                <option value = "oden">
                    好きなおでんの具
                </option>
            </select> <br /><br />

            <select name = "q2">
                <option value=""></option>
                <option value = "item">
                    好きなユーチューバー
                </option>
                <option value = "sporter">
                    嫌いな食べ物
                </option>
                <option value = "conv">
                    好きな芸能人
                </option>
                <option value = "pett">
                    苦手な科目
                </option>
                <option value = "oden">
                    小学校の頃の親友の名前
                </option>
            </select> <br /><br />

            <select name = "q3">
                <option value=""></option>
                <option value = "item">
                    好きなポテチの味
                </option>
                <option value = "sporter">
                    卒業した母校(小学校)
                </option>
                <option value = "conv">
                    母方の旧姓
                </option>
                <option value = "pett">
                    得意なスポーツ
                </option>
                <option value = "oden">
                    小学校の時に憧れた職業
                </option>
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
            <form action = "Create_check.php">
                <input  id = "green" type = "submit" value = "登録確認へ">
            </form>
        </div>
    </div>
</body>

</html>
