<?php
ini_set('display_errors', 0);

session_start();
include "../Setting/access_db.php";
$ID = $_SESSION['ID'];
// 接続テスト用ファイル
ini_set('display_errors', 0);

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

  //manage_id空の値を取得
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

  //登録ボタンが押下された場合の処理
  if(isset($_POST['submit'])) {
    echo "登録ボタンが押下されました";
    //info_aのINSERTSQL文
    $sql ='REPLACE INTO info_a(
      user_id,
      manage_id,
      surname,
      name,
      surname_ruby,
      name_ruby,
      gender,
      tag_id,
      met_year,
      met_month,
      met_day,
      birth_year,
      birth_month,
      birth_day,
      image
    ) VALUES(
      :user_id,
      :manage_id,
      :surname,
      :name,
      :surname_ruby,
      :name_ruby,
      :gender,
      :tag_id,
      :met_year,
      :met_month,
      :met_day,
      :birth_year,
      :birth_month,
      :birth_day,
      :image
    );
    /*info_bの更新InsertSQL*/
    REPLACE INTO info_b(
      user_id,
      manage_id,
      blood_type,
      feature,
      hobby,
      met_space,
      free_space
    ) VALUES(
      :user_id2,
      :manage_id2,
      :blood_type,
      :feature,
      :hobby,
      :met_space,
      :free_space
    )';

    //画像の処理
    $img_name = $_FILES['image']['name'];
    $fp = fopen($_FILES['image']['tmp_name'], "rb");
    $img = fread($fp, filesize($_FILES['image']['tmp_name']));
    fclose($fp);

    //変数定義
    $manage_id = $i + 1;
    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $surname_ruby = $_POST["surname_ruby"];
    $name_ruby = $_POST["name_ruby"];
    $gender = $_POST["gender"];
    $tag_id = $_POST["tag_id"];
    $blood_type = $_POST["blood_type"];
    $birth_year = $_POST["birth_year"];
    $birth_month = $_POST["birth_month"];
    $birth_day = $_POST["birth_day"];
    $met_year = $_POST["met_year"];
    $met_month = $_POST["met_month"];
    $met_day = $_POST["met_day"];
    $hobby = $_POST["hobby"];
    $feature = $_POST["feature"];
    $met_space = $_POST["met_space"];
    $free_space = $_POST["free_space"];
    $birthday = $birth_year .$birth_month .$birth_day;

    //DBに格納？？
    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(':user_id', $user_id[0]['user_id'], PDO::PARAM_INT);
    //$stmt->bindValue(':user_id', $ID, PDO::PARAM_INT);
    $stmt->bindValue(':manage_id', $manage_id, PDO::PARAM_INT);
    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surname_ruby', $surname_ruby, PDO::PARAM_STR);
    $stmt->bindParam(':name_ruby', $name_ruby, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
    $stmt->bindValue(':met_year', $met_year, PDO::PARAM_INT);
    $stmt->bindValue(':met_month', $met_month, PDO::PARAM_INT);
    $stmt->bindValue(':met_day', $met_day, PDO::PARAM_INT);
    $stmt->bindValue(':birth_year', $birth_year);
    $stmt->bindValue(':birth_month', $birth_month);
    $stmt->bindValue(':birth_day', $birth_day);
    $stmt->bindValue(':image', $img);
    $stmt->bindValue(':user_id2', $user_id[0]['user_id'], PDO::PARAM_INT);
    //$stmt->bindValue(':user_id2', $ID, PDO::PARAM_INT);
    $stmt->bindValue(':manage_id2', $manage_id, PDO::PARAM_INT);
    $stmt->bindParam(':blood_type', $blood_type, PDO::PARAM_STR);
    $stmt->bindValue(':feature', $feature, PDO::PARAM_STR);
    $stmt->bindValue(':hobby', $hobby, PDO::PARAM_STR);
    $stmt->bindValue(':met_space', $met_space, PDO::PARAM_STR);
    $stmt->bindValue(':free_space', $free_space, PDO::PARAM_STR);
    //実行
    $stmt->execute();
    header('location: ../Home/Main.php');
    exit;
  }

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>管理情報登録画面</title>
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
    padding: 0px 20px;
    background-color: rgba(200,0,0,1);
    color: #fff;
    border-color: rgba(255,0,0,1);
  }
  </style>
</head>

<body>
  <form enctype="multipart/form-data" action="" method="POST">
    <div class="container"> <!--コンテナ用divで囲む-->
      <div class="left_wrap">
        <p class = "businesscardU">
          顔写真<br>
          <!--画像登録フォーム-->
          <img id="img1" style="width:200px;height:200px;" />
          <input type="file" id="myfile" name = "image" accept="image/*" required><br>
        </p>
      </div>
      <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script>
      $(function(){
        $('#myfile').change(function(e){
          //ファイルオブジェクトを取得する
          var file = e.target.files[0];
          var reader = new FileReader();
          //画像でない場合は処理終了
          if(file.type.indexOf("image") < 0){
            alert("画像ファイルを指定してください。");
            return false;
          }
          //アップロードした画像を設定する
          reader.onload = (function(file){
            return function(e){
              $("#img1").attr("src", e.target.result);
              $("#img1").attr("title", file.name);
            };
          })(file);
          reader.readAsDataURL(file);
        });
      });
      </script>

      <div class="right_wrap">
        <p class = "name">
          　　　　　　姓　　　　　　名
          <br>
          名　　前　　
          <input type = "text" style = "width:100px;" name = "surname" value="<?php echo htmlspecialchars($surname, ENT_QUOTES, "UTF-8"); ?>">
          <input type = "text" style = "width:100px;" name = "name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>">
        </p>

        <p class = "namef">
          フリガナ　　
          <input type = "text" style = "width:100px;" name = "surname_ruby" value="<?php echo htmlspecialchars($surname_ruby, ENT_QUOTES, "UTF-8"); ?>">
          <input type = "text" style = "width:100px;" name = "name_ruby" value="<?php echo htmlspecialchars($name_ruby, ENT_QUOTES, "UTF-8"); ?>">
        </p>

        <p class ="sex">
          性　　別　　
          <input type = "radio" name = "gender" value = "f" >女性
          <input type = "radio" name = "gender" value = "m" >男性
          <input type = "radio" name = "gender" value = "o" checked = checked>その他<br>
        </p>

        <p class ="red">
          血液型　　　
          <INPUT type="radio" name="blood_type" value="A">A型
            <INPUT type="radio" name="blood_type" value="B">B型
              <INPUT type="radio" name="blood_type" value="AB">AB型
                <INPUT type="radio" name="blood_type" value="O">O型
                  <INPUT type="radio" name="blood_type" value="other" checked = checked>不明
                  </p>

                  <p class = "birthday">
                    <form action="./" method="post" name="form1" id="form1">
                      <table>
                        生年月日　　
                        <?php
                        echo "<select name='birth_year'>";?>
                          <option value="--">--</option>;
                          <?php
                          for ($y=1900;$y<date('Y')+1;$y++) {
                            $y_select = "";
                            echo '<option value="' . $y . '" '.$y_select.'>' . $y . "</option>\n";
                          }
                          echo "</select>年";
                          echo "<select name='birth_month'>";?>
                            <option value="--">--</option>;
                            <?php
                            for ($m=1;$m<13;$m++) {
                              $m_select = "";
                              echo '<option value="' . $m . '" '.$m_select.'>' . $m . "</option>\n";
                            }
                            echo "</select>月";
                            echo "<select name='birth_day'>";?>
                              <option value="--">--</option>;
                              <?php
                              for ($d=1;$d<32;$d++) {
                                $d_select = "";
                                echo '<option value="' . $d . '" '.$d_select.'>' . $d . "</option>\n";
                              }
                              echo "</select>日";
                              ?>
                            </tr><br>
                          </table>
                        </form>
                      </p>

                      <p class = "relation">
                        関　　係　　
                        <select name = "tag_id">
                          <?php
                          $dbh = new PDO($dsn, $user, $pass);
                          $stmt3 = $dbh->prepare("SELECT tag_name FROM tag WHERE user_id = $ID");
                          $stmt3->execute();
                          $tag_name = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                          $k = 0;
                          while(true){
                            if( empty( $tag_name[$k]['tag_name'] )){
                              break;
                            }
                            ?>
                            <option value ="<?php echo $k + 1;?>"><?php echo $tag_name[$k]['tag_name']; ?></option><?php
                            $k = $k + 1;
                          }
                          ?>
                        </select>
                      </p>


                      <p class = "hobby">
                        趣　　味　　
                        <input type = "text" style = "width:115px;" name = "hobby" value="<?php echo htmlspecialchars($hobby, ENT_QUOTES, "UTF-8"); ?>">
                      </p>

                      <p class = "feature">
                        特　　徴　　
                        <input type = "text" style = "width:115px;" name = "feature" value="<?php echo htmlspecialchars($feature, ENT_QUOTES, "UTF-8"); ?>">
                      </p>

                      <p class = "metday">
                        出会った日　
                        <?php
                        echo "<select name='met_year'>";?>
                          <option value="--">--</option>;
                          <?php
                          for ($y=1900;$y<date('Y')+1;$y++) {
                            $y_select = "";
                            if($default_year == $y){
                              $y_select = " selected";
                            }
                            echo '<option value="' . $y . '" '.$y_select.'>' . $y . "</option>\n";
                          }
                          echo "</select>年";
                          echo "<select name='met_month'>";?>
                            <option value="--">--</option>;
                            <?php
                            for ($m=1;$m<13;$m++) {
                              $m_select = "";
                              if($default_month == $m){
                                $m_select = " selected";
                              }
                              echo '<option value="' . $m . '" '.$m_select.'>' . $m . "</option>\n";
                            }
                            echo "</select>月";
                            echo "<select name='met_day'>";?>
                              <option value="--">--</option>;
                              <?php
                              for ($d=1;$d<32;$d++) {
                                $d_select = "";
                                if($default_day == $d){
                                  $d_select = " selected";
                                }
                                echo '<option value="' . $d . '" '.$d_select.'>' . $d . "</option>\n";
                              }
                              echo "</select>日";
                              ?>
                            </p>

                            <p class = "met_space">
                              出会った場所
                              <input type = "text" style = "width:115px;" name = "met_space" value="<?php echo htmlspecialchars($met_space, ENT_QUOTES, "UTF-8"); ?>">
                            </p>

                            <!--<p class = "businesscardO">
                            名刺の登録(表)<input type = "file" name = "pic">
                            <input type = "submit" name = "botan" value = "アップロード">
                          </p>

                          <p class = "businesscardU">
                          名刺の登録(裏)<input type = "file" name = "pic">
                          <input type = "submit" name = "botan" value = "アップロード">
                        </p>-->

                        <p class = "free_space">
                          フリースペース<br>
                          <TEXTAREA cols = "60%" rows = "5" name = "free_space" value="<?php echo htmlspecialchars($free_space, ENT_QUOTES, "UTF-8"); ?>"></TEXTAREA
                          </p>

                          <p class = "button">
                            <input type = "submit" value = "登録" id = "submit" name = "submit">
                            <input type = "button" value = "閉じる" id = "submit" onclick="location.href='../Home/Main.php'">
                          </p>
                        </div>
                      </div>
                    </form>
                  </body>
                  </html>
