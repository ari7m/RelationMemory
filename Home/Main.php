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

// 苗字(surname)と名前(name), 写真(image)をDBより取得
$sql = 'SELECT surname, name, image FROM info_a WHERE user_id = "' .$id.'"';
$MI_for_db = $dbh -> query($sql) -> fetchall(PDO::FETCH_ASSOC);
//var_dump(count($MI_name_for_db));
// 変数へ代入
foreach($MI_for_db as $MI){
    $MI_surname[] = $MI['surname'];
		$MI_name[] = $MI['name'];
		$MI_image[] = $MI['image'];
}
//var_dump($MI_surname);
//echo $MI_surname[0] . $MI_name[0];

$MI_array = count($MI_for_db); // ユーザがもつ管理情報の数を格納

?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>メイン画面</title>
    <link rel="stylesheet" type="text/css" href="Main.css">
  </head>

  <body>
	<?php for($i = 0; $i < $MI_array ; $i++):?>
        <span class ="container">
            <div class="main">
            <image src=<?php $MI_image[$i];?>, class="image">
            <button class="button" type="submit" onclick="location.href='Reading.html'">
            <!--ここに名前入れると表示される-->
            <?php
            //var_dump($MI_name);
            echo $MI_surname[$i] . $MI_name[$i];
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
