<?php
ini_set( 'display_errors', 1 );
//ヒキモト更新↓↓↓
$dsn = 'mysql:host=localhost;dbname=rmdb;charset=utf8';
$user = 'root';
//↑↑↑
try {
	//$dbh = new PDO('mysql:host=localhost:8889;dbname=test;charset=utf8','4649','root00');
	$dbh = new PDO($dsn,$user);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
        print 'データベース接続エラー';
        print('Error:'.$e->getMessage());
        die();
        exit();
}

?>
