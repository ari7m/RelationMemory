<!DOCTYPE HTML>
<html>
<head>
    <title>
        アカウント完成！！！
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
        try {
        $dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new mysqli_connect($dsn, 'root');
        mysqli_set_charset( $link, 'utf8');
        if( mysqli_connect_errno($link) ) {
	           echo mysqli_connect_errno($link) . ' : ' . mysqli_connect_error($link);
        }
        $sql = 'insert into rmdb.user values ('. $ID. ', '. $name. ', '. $pwd. ', '. $q1. ', '. $ans1. ', '. $q2. ', '. $ans2. ', '. $q3. ', '. $ans3. ')';
        $do = mysqli_connect($link, $sql);
        var_dump($sql);
        mysqli_close($link);
    } catch (PDOException $e) {
        echo $e -> getMessage();
        die();
    }
        /*$dsn = 'mysql:host=localhost; dbname=rmdb; charset=utf8';
        $link = new PDO($dsn, 'root');
        $sql = 'insert into rmdb.user * values ('. $name. ', '. $ID. ', '. $pwd. ', '. $q1. ', '. $q2. ', '. $q3. ', '. $ans1. ', '. $ans2. ', '. $ans3. ')';
        $do = $link -> query($sql);*/
    ?>
</head>
<body>
    アカウントができました！
</body>
</html>
