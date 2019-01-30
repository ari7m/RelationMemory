<?php
session_start();
// DBと接続
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'rmdb');
    define('DB_USER', 'wolf');
    define('DB_PASSWORD', 'password');
    try {
         $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $options);
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
         echo $e->getMessage();
         exit;
    }
    session_destroy();   
    $_SESSION['id'] = array();
    
    //var_dump($_SESSION['id']);
    
    echo 'ログアウト完了' . '僕のことは忘れないでね';
    
    // 一瞬でページ切り替わる
    http_response_code(301);
    header('Location: Start.php');
?>