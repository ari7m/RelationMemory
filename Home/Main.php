<?php
    ini_set('display_errors', 0);

    session_start();
    // DBと接続
    include "../Setting/access_db.php";
    //仮のセッションID
    //$_SESSION['ID'] ='1';
    $id = $_SESSION['ID'];

    /* タグが押されたかどうかの判断。押された場合そのタグのidが格納される */
    if(!empty($_POST['Tag'])){
        $tag = $_POST['Tag'];
        $sql = 'SELECT manage_id,surname, name, tag_id, image FROM info_a WHERE user_id = "' .$id.'" AND tag_id = "' .$tag. '"';
    }else{
        $sql = 'SELECT manage_id,surname, name, tag_id, image FROM info_a WHERE user_id = "' .$id.'" ';
    }

    $MI_for_db = $dbh -> query($sql) -> fetchall(PDO::FETCH_ASSOC);
    foreach($MI_for_db as $MI){
        $MI_manage_id[] = $MI['manage_id'];
        $MI_surname[] = $MI['surname'];
        $MI_name[] = $MI['name'];
        $MI_tag[] = $MI['tag_id'];
        $MI_image[] = $MI['image'];

        //$MI_array = count($MI_for_db); // ユーザがもつ管理情報の数を格納
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン画面</title>
        <link rel="stylesheet" type="text/css" href="Main.css">
    </head>

    <body>
        <form action ='Main.php' method='post'>
        <!-- 管理情報を表示 -->
        <?php echo 'hogeeeeeeee!!!!!!!!!!!!!!!!!';?>
    	<?php for($i = 0; $i < count($MI_for_db); $i++):?>
            <span class ="container">
                <div class="main">
                  <?php
                  if(isset($MI_manage_id[$i])){
                  $sqll = "SELECT image FROM info_a where manage_id = $i+1";
                  $stmtl = $dbh->prepare($sqll);
                  $stmtl->execute();
                  $row3 = $stmtl->fetch(PDO::FETCH_ASSOC);
                  $stmtl->execute();
                  while($row3 = $stmtl->fetch(PDO::FETCH_ASSOC) ){
                    $DB_PIC_ARRAY[] = $row3['image'];
                  }
                  $cnt = 0;
                  ?>
                  <div class = "image">
                  <?php
                  foreach($DB_PIC_ARRAY as $pic){
                    $enc_img = base64_encode($pic);
                    $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
                    if($cnt == $i){
                    echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . ' "width=56px" height="56px"  />';
                  }
                  $cnt = $cnt + 1;
                  }
                }
                  ?>
                  </div>
                    <button type = "button" class="button" type="submit" onclick="location.href='../MIPage/Reading.php?mid=<?php echo $i + 1 ?>'">
                    <?php
                        //名前の表示
                        echo $MI_surname[$i] . $MI_name[$i];
                    ?>
                    </button>
                </div>
            </span>
        <?php endfor?>

		<!-- 管理情報追加ボタン -->
        <button  type ="button" class="create" onclick="location.href='../MIPage/Create_mi.php'">
              <img src="plus.png" class="plus">
    	</button>

		<!-- タグの表示部分 -->
		<?php

		/* タグのID(tag_id)と, タグの名前(tag_name)をとってくる */
		$sql = 'SELECT tag_name, tag_id FROM tag WHERE user_id = "' .$id. '"';
		$MI_tag_from_tag = $dbh -> query($sql) -> fetchall(PDO::FETCH_ASSOC);

	    foreach($MI_tag_from_tag as $row){
			$MI_tag_id[] = $row['tag_id'];
			$MI_tag_name[] = $row['tag_name'];
		}

		?>
        <ul class="tag">
            <li id="tag1">
                <label>
                <input type="radio" name="Tag" style="display:none" onclick="location.href='Main.php'">
        			<span>
        			    すべて
        			</span>
        		</label>
        	</li>

        	<!-- 全て以外のタグ -->
          <?php for($i = 0; $i < count($MI_tag_name); $i++): ?>
        	<li id="alltag">
        	    <label>
        	    <input type="submit" style="display:none" name="Tag" value=<?php echo $MI_tag_id[$i]?>>
            	    <span>
            		    <?php echo $MI_tag_name[$i];?>
            		</span>
        		</label>
        	</li>
        	<?php endfor ?>
        </ul>
        </form>
    </body>
</html>
