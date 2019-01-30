<?php
ini_set('display_errors', 0);

session_start();
include "../Setting/access_db.php";
$ID = $_SESSION['ID'];
echo $ID;
$MID = $_GET['mid'];
// 接続テスト用ファイル


  /*userDBからuser_idの最大値を取得？？*/
  $stmt0 = $dbh->prepare('SELECT user_id FROM user');
  $stmt0->execute();
  $user_id = $stmt0->fetchAll(PDO::FETCH_ASSOC);
  $j = 0;
  while(true){
    if( empty( $user_id[$j]['user_id'] )){
      break;
    }
    $j = $j + 1;
  }
  /*info_aから管理している人のidを取得*/
  $stmt1 = $dbh->prepare('SELECT manage_id FROM info_a');
  $stmt1->execute();
  $manage_id = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;

  while(true){
    if( empty( $manage_id[$i]['manage_id'] )){
      break;
    }
    $i = $i + 1;
  }

  $i = 1;

  $sql = "SELECT * FROM info_a where manage_id = $MID AND user_id = $ID ";
  $sql2 = "SELECT * FROM info_b where manage_id = $MID AND user_id = $ID";

  // SQLステートメントを実行し、結果を変数に格納
  $stmt = $dbh->query($sql);
  $stmt2 = $dbh->query($sql2);

  // foreach文で配列の中身を一行ずつ出力
  foreach ($stmt as $row) {
    // データベースのフィールド名で出力
    //echo $row['surname']. '　　　　' .$row['name'];
    // 改行を入れる
    echo '<br>';
  }

  //年齢計算
  if($row['birth_year']==0){
    $by = date('Y');}else{
      $by =$row['birth_year'];
    }
  if($row['birth_month'] < 10){
    $bm = 0;
    $bm .= $row['birth_month'];}else{
      $bm = $row['birth_month'];
    }
  if($row['birth_day'] < 10){
    $bd = 0;
    $bd .= $row['birth_day'];}else{
      $bd = $row['birth_day'];
    }
    $birthdate = $by.$bm.$bd;
    //echo $birthdate;


        // foreach文で配列の中身を一行ずつ出力
        foreach ($stmt2 as $row2) {
          // データベースのフィールド名で出力
          // echo $row['surname']. '　　　　' .$row['name'];
          // 改行を入れる
          echo '<br>';
        }
      ?>

      <!DOCTYPE HTML>
      <html>
      <head>
        <title>管理情報詳細閲覧画面</title>
        <meta charset="UTF8">
        <style>
        .container {
          width: 1000px; /*必要な幅に設定*/
          margin: auto; /*ブラウザ中央に配置*/
        }
        .container:after { /*clearfix設定*/
          content:"";
          display:block;
          clear:both;
        }
        .left_wrap {
          width: 30%; /*左カラム幅設定*/
          float: left;
        }
        .right_wrap {
          width: 70%; /*右カラム幅設定*/
          float: right;
        }
        input#submit{ /*閉じるボタン*/
          padding: 0px 20px;
          background-color: rgba(255,255,255,1);
          color: #000;
          border-color: rgba(0,0,0,1);
        }
        input#close{ /*閉じるボタン*/
          padding: 0px 10px;
          background-color: rgba(200,0,0,1);
          color: #fff;
          border-color: rgba(255,0,0,1);
        }
        </style>
      </head>

      <body>
        <div class="container"> <!--コンテナ用divで囲む-->
          <div class="left_wrap">
            <p class = "businesscardU">
              顔写真<br>
              <?php
              $dbhh = new PDO($dsn, $user);
              $sqll = "SELECT image FROM info_a where manage_id = $MID AND user_id = $ID";
              $stmtl = $dbhh->prepare($sqll);
              $stmtl->execute();
              $row3 = $stmtl->fetch(PDO::FETCH_ASSOC);
              $stmtl->execute();
              while($row3 = $stmtl->fetch(PDO::FETCH_ASSOC) ){
                $DB_PIC_ARRAY[] = $row3['image'];
              }
              foreach($DB_PIC_ARRAY as $pic){
                $enc_img = base64_encode($pic);
                $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
                echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" width="200px" height="200px" />';
              }
              ?>
            </p>
          </div>
          <div class="right_wrap">
            <p class = "name">
              <font size = 1>　　　　　　　　　　　
                <?php  echo $row['surname_ruby']?>　　<?php echo $row['name_ruby']?>
                <br>
                <font size = 3>
                  名　　前　　　<?php echo $row['surname'] ?> 　<?php echo $row['name'] ?>
                </p>

                <p class ="sex">
                  性　　別　　　<?php
                  if($row['gender'] == 'o'){
                    echo 'その他';
                  } else if($row['gender'] == 'f'){
                    echo '女性';
                  } else if($row['gender'] == 'm'){
                    echo '男性';
                  }?>
                </p>

                <p class = "birthday">
                  生年月日　　　<?php echo $row['birth_year']?>年<?php echo $row['birth_month']?>月<?php echo $row['birth_day']?>日
                </p>

                <form action="age." method="POST">
                  <p class = "age">
                    年　　齢　　　<?php
                    $now = date("Ymd");
                    $birthday = str_replace("-", "", $birthdate);//ハイフンを除去しています。
                    echo floor(($now-$birthday)/10000).'歳';?>
                  </p>
                </form>



                <p class = "relation">
                  関　　係　　　<?php
                  $dbh = new PDO($dsn, $user);
                  $k = $row['tag_id'] - 1 ;
                  $stmt4 = $dbh->prepare('SELECT tag_name FROM tag ');
                  $stmt4->execute();
                  $tag_name = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                  echo $tag_name[$k]['tag_name']; ?>
                </p>

                <p class = "hobby">
                  趣　　味　　　<?php echo $row2['hobby'] ?>
                </p>

                <p class = "feature">
                  特　　徴　　　<?php echo $row2['feature'] ?>
                </p>

                <p class = "metday">
                  出会った日　　<?php echo $row['met_year']?>年<?php echo $row['met_month']?>月<?php echo $row['met_day']?>日
                </p>

                <p class = "metplace">
                  出会った場所　<?php echo $row2['met_space'] ?>
                </p>

                <!--<p class = "businesscardO">
                名刺(表)<br><img src="./meisiomote.png" width = 250px border = 2>
              </p>

              <p class = "businesscardU">
              名刺(裏)<br><img src="./meisiura.png" width = 250px border = 2>
            </p>-->

            <p class = "freespace">
              フリースペース<br>
              <?php echo $row2['free_space']?>
            </p>

            <p class = "button">
              <form action="Reading.php" method="post">
                <input type = "button" value = "編集" id = "submit" onClick="location.href='Edit_mi.php?mid=<?php echo $MID ?>'">
                <!--<input type = "submit" value = "削除" id = "submit" name = "delete">-->
                <input type = "button" onClick='history.back();' value = "閉じる" id = "submit" onClick="location.href='../Template.php'">
              </form>
            </p>
          </div>

        </body>

        </html>
