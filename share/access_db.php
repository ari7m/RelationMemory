<?php
ini_set( 'display_errors', 1 );
try {
	$dbh = new PDO('mysql:host=localhost:8889;dbname=test;charset=utf8','4649','root00');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
        print 'データベース接続エラー';
        print('Error:'.$e->getMessage());
        die();
        exit();
}

?>
