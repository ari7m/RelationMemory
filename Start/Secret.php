<!DOCTYPE HtML>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="Secret.css">　
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
    <font size="7"><p>　　　　秘密の質問を選択</p></font>
    <!--　1/2分割テーブルの作成 -->
    <ul>

        <table border="0.1">
            <tr>

                <td width="50%">
                    <center>
                        <font size="6"><b>質問項目</b></font>
                        <br>
                        <select name = "q1" width = "40px" style="font-size:24pt" required>
                            <option value=""></option>
                            <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<option value = "', $i + 1, '">', $name1[$i], '</option>';
                                }
                            ?>
                        </select> <br /><br />

                        <select name = "q2" width = "40px" style="font-size:24pt" required>
                            <option value=""></option>
                            <?php
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<option value = "', $i + 1, '">', $name2[$i], '</option>';
                                }
                            ?>
                        </select> <br /><br />

                        <select name = "q3" width = "40px" style="font-size:24pt" required>
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
                        <input type="text" name="ID" size="26pt" style="font-size:24pt;" >
                        <br>
                        <br>
                        <input type="text" name="ID" size="26pt" style="font-size:24pt;" >
                        <br>
                        <br>
                        <input type="text" name="ID" size="26pt" style="font-size:24pt;" >
                        <br>
                        <br>
                    </center>
                </td>

            </tr>
        </table>
    </ul>
    <center>
        <button class="button3" type="submit" onclick="location.href = 'Remake_user.html'">パスワードの再入力</button>
    </center>
</body>
