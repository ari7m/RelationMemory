<?php
ini_set('display_errors', 0);

session_start();
$ID = $_SESSION['ID'];
// 接続テスト用ファイル
$dsn = 'mysql:host=localhost;dbname=test_test';
$user = 'Konaien';
$pass = 'HtBM-923';

try {
    // MySQLへの接続
    $dbh = new PDO($dsn, $user, $pass);
    // 接続を使用する

    $pic_id = 1;

       $url = "https://www.google.co.jp/images/srpr/logo11w.png";
       $img = file_get_contents($url);

       $sql = <<<SQL
           REPLACE INTO PICTURE
           (PICID, PIC) VALUES (:pic_id, :PIC);
   SQL;
       $stmt = $dbh->prepare($sql);
       $stmt->bindValue(':pic_id'  ,$pic_id);
       $stmt->bindValue(':PIC'     ,$img);
       $stmt->execute();
       $stmt = null;

       echo '<img src="img.php?pic_id=' . $pic_id . '">';

    // 接続を閉じる
    $sth = null;
    $dbh = null;

    print("DB接続できました！");

} catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
}

?>
