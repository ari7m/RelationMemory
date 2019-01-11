<?php
  // 接続テスト用ファイル

  $user = 'root';
  //$pass = 'secret';
  
  try {
      // MySQLへの接続
      $dbh = new PDO('mysql:host=localhost;dbname=rmdb', $user);//, $pass);
  
      // 接続を使用する
      $sth = $dbh->query('SELECT * from foo');
      echo "<pre>";
      foreach($sth as $row) {
          print_r($row);
      }
      echo "</pre>";
  
      // 接続を閉じる
      $sth = null;
      $dbh = null;
  
  } catch (PDOException $e) { // PDOExceptionをキャッチする
      print "エラー!: " . $e->getMessage() . "<br/gt;";
      die();
  }
?>