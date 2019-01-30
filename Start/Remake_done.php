<!DOCTYPE HTML>
<html>
<head>
    <title>
        アカウント！
    </title>
    <meta charset="utf-8" />
    <?php
        // SESSIONからデータの受け取り
        session_start();
        $name = $_SESSION['name'];
        $ID = $_SESSION['ID'];
        $pwd = $_SESSION['pwd'];

        // DBにデータの設定
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        // アップデート
        $sql = 'update user set user_name = "'. $name. '", user_password = "'. $pwd. '" where user_id = "'. $ID. '"';
        $do = $link -> query($sql);
        // 自動遷移
        http_response_code(301);
        header('Location: ../Template.html');
    ?>
</head>
<body>
</body>
</html>
