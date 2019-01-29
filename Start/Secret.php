<!DOCTYPE HtML>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="Secret.css">　
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <title>秘密の質問回答画面</title>
    <?php
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
    <form action = "Remake_user.php" method = "post">
        <font size="7"><p>　　　　秘密の質問を選択</p></font>
        <center>
            <?php
            //if (isset($_POST['X']) && $_POST['X']){
                echo '<font color = "red"><b>入力データは存在しません！！！！！(半ギレ)</b></font>';
            //}
             ?>
        </center>
        <!--　1/2分割テーブルの作成 -->
        <ul>

            <table border="0.1">
                <tr>

                    <td width="50%">
                        <center>
                            <font size="6"><b>質問項目</b></font>
                            <br>
                            <select name = "q1" style="font-size:24pt; width: 350pt;" required>
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<option value = "', $i + 1, '">', $name1[$i], '</option>';
                                }
                                ?>
                            </select> <br /><br />

                            <select name = "q2" style="font-size:24pt; width: 350pt;" required>
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<option value = "', $i + 1, '">', $name2[$i], '</option>';
                                }
                                ?>
                            </select> <br /><br />

                            <select name = "q3" style="font-size:24pt; width: 350pt;" required>
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<option value = "', $i + 1, '">', $name3[$i], '</option>';
                                }
                                ?>
                            </select>
                            <br>
                            <br>

                        </center>
                    </td>

                    <td width="50%">
                        <center>
                            <font size="6"><b>回答   </b></font>
                            <br>
                            <input type="text" name="a1" size="26pt" style="font-size:23pt;" required>
                            <br>
                            <br>
                            <input type="text" name="a2" size="26pt" style="font-size:23pt;" required>
                            <br>
                            <br>
                            <input type="text" name="a3" size="26pt" style="font-size:23pt;" required>
                            <br>
                            <br>
                        </center>
                    </td>

                </tr>
            </table>
        </ul>
        <center>
            <input type = "submit" id="green" type="submit" value = "パスワードの再入力" />
        </center>
    </form>
</body>
