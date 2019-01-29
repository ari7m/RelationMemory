<head>
   <?php
       session_start();
       $ID = $_SESSION['ID'];
   ?>
</head>
<?php
  include "access_db.php"; // データベース取得
  $sql = "select * from user where user_id = '". $ID. "' "; 
  $stmt = $dbh -> query($sql);

foreach ($stmt as $row){
$user_id = $row["user_id"]; // user_idの確保
$user_name = $row["user_name"];
$user_pwd = $row["user_pwd"];
}
?>
<html>
  <meta charset="utf-8">
  <body>

   アカウントの削除を行なった

      <?php

      $sql =" DELETE FROM info_b WHERE user_id = '$user_id'";
      $delete_info_b = $dbh -> query($sql);

       $sql =" DELETE FROM info_a WHERE user_id = '$user_id'";
      $delete_info_a = $dbh -> query($sql);

      $sql =" DELETE FROM tag WHERE user_id ='$user_id'";
        $delete_tag = $dbh -> query($sql);


      $sql =" DELETE FROM user WHERE user_id = '$user_id'";
      $delete_user = $dbh -> query($sql);

      ?>
        <script>
	 location.href = location.href = '../Start/Start.html';

	  </script


  </body>
</html>
