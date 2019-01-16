<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <h2 class = "title">
        ユーザ情報の確認
    </h2>
    <?php
        /*$dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');*/
    ?>
</head>
<body>
    <form method = "post">
        <div align = "center">
            <div style="float:left;width:45%;" align = "right">
                ユーザID(半角英数字と記号)  <br /><br />
                ユーザ名(全角)   <br /><br />
                パスワード(半角英数字と記号) <br /><br />
                パスワードの再入力
            </div>

            <div style="float:left;width:10%;">
                &nbsp;<!--これ半角スペース-->
            </div>

            <div align = "left" style="float:left;width:45%;">
                <?php
                echo $_POST['name'], '<br /><br />';
                echo $_POST['ID'], '<br /><br />';
                $str = $_POST['pwd'];
                $len = strlen($str);
                for ($i = 0, $hid = ''; $i < $len; $i++) {
                    $hid .= '*';
                }
                echo $hid, '<br /><br />';
                echo $hid, '<br /><br />';
                ?>
            </div>

            <div style="clear:both;"></div>
        </div>


        <h2 class = "title">
            秘密の質問
        </h2>
        <div align = "center">
            <div style="float:left;width:45%;" align = "right">
                質問項目 <br /><br />
                <?php
                    /*for ($i = 1; $i < 4; $i++){
                        $que = 'q', $i;
                        var_dump($que);
                        /*$sql = 'select question_', $i, '_name from secret_question_', $i, ' where question_1_id = ', $_POST[$que];
                        $res = $link -> query($sql);
                        foreach ($res as $row) {
                            $str =  $row['question_', $i, '_name'];
                        }
                        echo $str, '<br /><br />';
                    }
                    /*$sql = 'select question_1_name from secret_question_1 where question_1_id';
                    echo $_POST['q1'], '<br /><br />';
                    echo $_POST['q2'], '<br /><br />';
                    echo $_POST['q3'], '<br /><br />';*/
                 */?>
                <!--初めてのペットの名前 <br /><br />
                小学校の頃の親友の名前<br /><br />
                母の旧姓-->
            </div>

        </div>

        <div style="float:left;width:10%;">
            &nbsp;<!--これ半角スペース-->
        </div>

        <div align = "left" style="float:left;width:45%;">
            回答 <br /><br / />
            <?php
                echo $_POST['answer1'], '<br /><br />';
                echo $_POST['answer2'], '<br /><br />';
                echo $_POST['answer3'], '<br /><br />';
             ?>
            <!--ポチ　<br /><br />
            たけし <br /><br />
            佐藤-->
        </div>

        <div style="clear:both;"></div>
    </div>

    <div align = "center">
        <div>
            <br />
            <div style="display:inline-flex">
                <input id = "green" type = "submit" value = "修正" formaction = "Create_done.php">
                &nbsp;&nbsp;&nbsp;
                <input id = "orange" type = "submit" value = "登録" formaction = "../Template.html" >
            </div>
        </div>
    </div>
</form>
</body>
</html>
