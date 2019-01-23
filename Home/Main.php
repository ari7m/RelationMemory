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
$count = 0;
$id = $_SESSION['id'];
$sql = 'SELECT surname, name FROM info_a WHERE user_id = "' .$id.'"';
while($MI_name = $dbh -> query($sql)->fetch(PDO::FETCH_ASSOC)){
    $MI_names[] = $MI_name;
    $count++;
}

var_dump($count);
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>メイン画面</title>
    <link rel="stylesheet" type="text/css" href="Main.css">
  </head>

  <body>
    <?php for($i = 0; $i = $count; $i++):?>
    <span class ="container">
        <image src="image.png", class="image">
        <button class="button" type="submit" onclick="location.href='Reading.html'">
        <!--ここに名前入れると表示される-->
        <?php
        //var_dump($MI_name);
        echo $MI_names;
        ?>
        </button>
    <?php endfor ?>
    </span>
		<!--
    <div class="container"> <!--コンテナ用divで囲む--
      <div class="left_wrap"> 
	<div class="main" id="id_1">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'">有薗 里奈</button>
	</div>
	<div class="main" id="id_2">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'">伊藤 佑樹</button>
	</div>
	<div class="main" id="id_3">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'">河野 雄也</button>
	</div>
	<div class="main" id="id_4">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'"> 高橋 慎也</button>
	</div>
	<div class="main" id="id_5">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'"> 南部 美希奈</button>
	</div>
	<div class="main" id="id_6">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'">引本 匡磨</button>
	</div>
	<div class="main" id="id_7">
	  <image src="image.png" class="image">
	    <button class="button" type="submit" onclick="location.href='Reading.html'">堀　 彩華</button>
	</div>
      </div>
		</div>
		
	-->
    <button class="create" onclick="location.href='/MIPage/Create_mi.html'">
      <img src="plus.png" class="plus">
      
      
    </button>
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
