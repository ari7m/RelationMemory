<!DOCTYPE HTML>
<html>
<head>
    <title>
        アカウント！！！(半ギレ)
    </title>
    <meta charset="utf-8" />
    <?php
        // SESSIONからデータの受け取り
        session_start();
        $name = $_SESSION['name'];
        $ID = $_SESSION['ID'];
        $pwd = $_SESSION['pwd'];

        // DBにデータの登録
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        //$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'update rmdb.user set (user_name = "'. $name. '", user_password = "'. $pwd. '") where user_id = "'. $ID.'"';
        var_dump($sql);
        /*$do = $link -> prepare($sql);
        $params = array(':name' => $name, ':pwd' => $pwd, ':id' => $ID);
        $do -> execute($params);*/
        $do = $link -> query($sql);
        http_response_code(301);
        header('Location: ../Template.html');
    ?>
</head>
<body>
</body>
</html>
