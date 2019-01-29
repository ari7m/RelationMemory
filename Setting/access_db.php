<?php
ini_set( 'display_errors', 1 );
try {
	$dbh = new PDO('mysql:host=localhost; dbname=rmdb; charset=utf8','root');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
        print 'データベース接続エラー';
        print('Error:'.$e->getMessage());
        die();
        exit();
}

?>
