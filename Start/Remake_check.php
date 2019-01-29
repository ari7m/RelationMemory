<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Mitame.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <h2 class = "title">
        ユーザ情報の確認
    </h2>
    <?php
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        // 次のページにデータ渡すんだよぉ！！！！！
        session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['pwd'] = $_POST['pwd'];
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
    </div>

    <div align = "center">
        <div>
            <br />
            <div style="display:inline-flex">
                <input id = "green" type = "submit" value = "修正" formaction = "Remake_user.php">
                &nbsp;&nbsp;&nbsp;
                <input id = "orange" type = "submit" value = "登録" formaction = "Remake_done.php" >
            </div>
        </div>
    </div>
</form>
</body>
</html>
