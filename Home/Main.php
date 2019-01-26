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
$sql = 'SELECT surname FROM info_a WHERE user_id = "' .$id.'"';

//PDO::FETCH_ASSOC でとってきた値の連想配列を変数に格納
//foreach($MI_name_for_db as $MI_name_surname => $MI_name);
$MI_name_for_db = $dbh -> query($sql) -> fetchall(PDO::FETCH_ASSOC);
foreach($MI_name_for_db as $row){
    $surname[] = $row['surname'];
}

$surname_count = count($surname);
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>メイン画面</title>
    <link rel="stylesheet" type="text/css" href="Main.css">
  </head>

  <body>
	<?php for($i = 0; $i < $surname_count ; $i++):?>
        <span class ="container">
            <div class="main">
            <image src="image.png", class="image">
            <button class="button" type="submit" onclick="location.href='Reading.html'">
            <!--ここに名前入れると表示される-->
            <?php
            //var_dump($MI_name);
            echo $surname[$i];
            ?>
            </button>
            </div>
        </span>    
    <?php endfor?>
		
		<!-- 管理情報追加ボタン -->
    <button class="create" onclick="location.href='/MIPage/Create_mi.html'">
      <img src="plus.png" class="plus">
		</button>
		
		<!-- タグの表示部分 -->
    <ul class="tag">
      
			<li id="alltag"><label><input type="radio" name="Tag" style="display:none" onclick="location.href='Main.html'"/>
				<span>全て</span></label></li>
			<li id="tag1"><label><input type="radio" name="Tag" style="display:none" onclick="location.href='Main.html'"/>
				<span>ソフ工</span></label></li>
			<li id="tag2"><label><input type="radio" name="Tag" style="display:none" onclick="location.href='Main.html'"/>
				<span>上司</span></label></li>
    </ul>
  </body>
</html>
