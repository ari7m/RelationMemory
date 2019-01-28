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

    $pic_id = 2;

  //画像取得
  $sql = <<<SQL
        SELECT PIC FROM PICTURE
SQL;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC) ){
        $DB_PIC_ARRAY[] = $row['PIC'];
    }
    $stmt = null;

    foreach($DB_PIC_ARRAY as $pic){
        $enc_img = base64_encode($pic);
        $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
        echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" />';
    }




// 接続を閉じる
$sth = null;
$dbh = null;

print("DB接続できました！");

} catch (PDOException $e) { // PDOExceptionをキャッチする
print "エラー!: " . $e->getMessage() . "<br/gt;";
die();
}

?>
