<head>
   <?php
       session_start();
       $ID = $_SESSION['ID'];
   ?>
</head>

<?php

 include "access_db.php";
  $sql = "select * from user where user_id = 'abc123' ";
     $stmt = $dbh -> query($sql);	   
    
        foreach ($stmt as $row){
        $user_id = $row["user_id"]; // user_idの確保
	}
	
  if($_POST['user'] == ""){
    $changed_name = '変更なし';
  } else {
    $changed_name = $_POST['user'];
   $sql =" update user set user_name =' $changed_name' WHERE user_id = '$user_id' ";
   $upd =  $dbh -> query($sql);
  }
   if($_POST['pwd'] == ""){
    $changed_pwd = '変更なし';
  } else {
    $changed_pwd = $_POST['pwd'];
    $sql =" update user set user_pwd =' $changed_pwd' WHERE user_id = '$user_id' ";
   $upd =  $dbh -> query($sql);
  }
  
  ?>
<html>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Mitame.css">
  <br/>
  <h3 class = "title">
    ユーザ情報の変更をしました</h3>

  <br />
  <div align = "center">
    <div style="float:left;width:45%;" align = "right">
      ユーザ名:<br /><br /><br />
       パスワード:
    </div>

    <div style="float:left;width:10%;">
      　<!--ここ全角スペース-->
    </div>

    <div align = "left" style="float:left;width:45%;">
      <?php echo $changed_name; ?> <br /><br /><br />
      <?php echo $changed_pwd;?>
    </div>
    <div style="clear:both;"></div>
    
    <br /><br />
    <input type= "button" value = "ホームへ戻る" onclick = " location.href = 'Main.html' " id = "button">
    　　　
</html>
