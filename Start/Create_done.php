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
        $q1 = $_SESSION['q1'];
        $q2 = $_SESSION['q2'];
        $q3 = $_SESSION['q3'];
        $ans1 = $_SESSION['ans1'];
        $ans2 = $_SESSION['ans2'];
        $ans3 = $_SESSION['ans3'];

        // DBにデータの登録
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'insert into rmdb.user values (:ID, :name, :pwd, :q1, :ans1, :q2, :ans2, :q3, :ans3)';
        $do = $link -> prepare($sql);
        $param = array(
            ':name' => $name,
            ':ID' => $ID,
            ':pwd' => $pwd,
            ':q1' => $q1,
            ':q2' => $q2,
            ':q3' => $q3,
            ':ans1' => $ans1,
            ':ans2' => $ans2,
            ':ans3' => $ans3
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
