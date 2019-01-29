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
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'update rmdb.user set (:name, :pwd) where user_id = (:ID)';
        $do = $link -> prepare($sql);
        $param = array(
            ':name' => $name,
            ':pwd' => $pwd,
            ':ID' => $ID,
        );
        $do -> execute($param);
        /*$dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        $sql = 'insert into rmdb.user * values ('. $name. ', '. $ID. ', '. $pwd. ', '. $q1. ', '. $q2. ', '. $q3. ', '. $ans1. ', '. $ans2. ', '. $ans3. ')';
        $do = $link -> query($sql);*/
        http_response_code(301);
        header('Location: ../Template.html');
    ?>
</head>
<body>
</body>
</html>
