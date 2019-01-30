<?php
//ini_set('display_errors', 0);
// 接続テスト用ファイル
session_start();
include "../Setting/access_db.php";
$ID = $_SESSION['ID'];
echo $ID;
$MID = $_GET['mid'];

  /*user_idの取得?*/
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

  //仮のmanage_id
  $manage_id = $MID;

  //info_a&info_bを選択するSQL文
  $sql01 = "SELECT * FROM info_a where manage_id = $manage_id AND user_id = $ID";
  $sql02 = "SELECT * FROM info_b where manage_id = $manage_id AND user_id = $ID";

  // SQLステートメントを実行し、結果を変数に格納
  $stmt01 = $dbh->query($sql01);
  $stmt02 = $dbh->query($sql02);

  // foreach文で配列の中身を一行ずつ出力
  foreach ($stmt01 as $row) {
    // データベースのフィールド名で出力
    //echo $row['surname']. '　　　　' .$row['name'];
    // 改行を入れる
    echo '<br>';
  }
  // foreach文で配列の中身を一行ずつ出力
  foreach ($stmt02 as $row2) {
    // データベースのフィールド名で出力
    // echo $row['surname']. '　　　　' .$row['name'];
    // 改行を入れる
    echo '<br>';
  }


  //登録ボタンを押した場合の処理
  if(isset($_POST['submit'])) {
    echo "更新ボタンが押下されました";
    //画像ファイルを更新したか判断
    if(filesize($_FILES['image']['tmp_name'])!=0){
      //画像を更新する場合
      //info_aの更新SQL
      $sql ="UPDATE info_a SET
      user_id = :user_id,
      manage_id = :manage_id,
      surname = :surname,
      name = :name,
      surname_ruby = :surname_ruby,
      name_ruby = :name_ruby,
      gender = :gender,
      tag_id = :tag_id,
      met_year= :met_year,
      met_month = :met_month,
      met_day = :met_day,
      birth_year = :birth_year,
      birth_month = :birth_month,
      birth_day = :birth_day,
      image = :image
      where manage_id = :id AND user_id = :user_id;
      /*info_bの更新SQL*/
      UPDATE info_b SET
      user_id = :user_id2,
      manage_id = :manage_id2,
      blood_type = :blood_type,
      feature = :feature,
      hobby = :hobby,
      met_space = :met_space,
      free_space = :free_space
      where manage_id = :id AND user_id = :user_id";

      //画像の処理
      $img_name = $_FILES['image']['name'];
      $fp = fopen($_FILES['image']['tmp_name'], "rb");
      $img = fread($fp, filesize($_FILES['image']['tmp_name']));
      fclose($fp);

      //変数定義
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

      //
      $stmt=$dbh->prepare($sql);
      $params = array(':user_id' => $ID,':user_id2' => $ID, ':manage_id'=> $manage_id, ':manage_id2'=> $manage_id,':name' => $name, ':surname' => $surname,
      ':name_ruby' =>$name_ruby,':surname_ruby'=>$surname_ruby,':gender'=>$gender, ':tag_id' => $tag_id , ':blood_type'=>$blood_type, ':birth_year'=>$birth_year, ':birth_month'=> $birth_month,
      ':birth_day' => $birth_day, ':met_year'=>$met_year, ':met_month'=> $met_month, ':met_day' => $met_day, ':image' => $img ,':hobby'=> $hobby, ':feature'=>$feature, ':met_space' => $met_space ,
      ':free_space' => $free_space, ':id' => $manage_id);
      $stmt->execute($params);
      header("location: ../Home/Main.php");
    } else {

      //画像を更新しない場合
      //info_aの更新SQL
      $sql ="UPDATE info_a SET
      user_id = :user_id,
      manage_id = :manage_id,
      surname = :surname,
      name = :name,
      surname_ruby = :surname_ruby,
      name_ruby = :name_ruby,
      gender = :gender,
      tag_id = :tag_id,
      met_year= :met_year,
      met_month = :met_month,
      met_day = :met_day,
      birth_year = :birth_year,
      birth_month = :birth_month,
      birth_day = :birth_day
      where manage_id = :id AND user_id = :user_id;
      /*info_bの更新SQL*/
      UPDATE info_b SET
      user_id = :user_id2,
      manage_id = :manage_id2,
      blood_type = :blood_type,
      feature = :feature,
      hobby = :hobby,
      met_space = :met_space,
      free_space = :free_space
      where manage_id = :id AND user_id = :user_id";

      //変数定義
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

      //
      $stmt=$dbh->prepare($sql);
      $params = array(':user_id' => $ID,':user_id2' => $ID, ':manage_id'=> $manage_id, ':manage_id2'=> $manage_id,':name' => $name, ':surname' => $surname,
      ':name_ruby' =>$name_ruby,':surname_ruby'=>$surname_ruby,':gender'=>$gender, ':tag_id' => $tag_id , ':blood_type'=>$blood_type, ':birth_year'=>$birth_year, ':birth_month'=> $birth_month,
      ':birth_day' => $birth_day, ':met_year'=>$met_year, ':met_month'=> $met_month, ':met_day' => $met_day, ':hobby'=> $hobby, ':feature'=>$feature, ':met_space' => $met_space ,
      ':free_space' => $free_space, ':id' => $manage_id);
      $stmt->execute($params);
      header("location: ../Home/Main.php");
    }
  }

  //管理情報削除機能
  if(isset($_POST['delete'])) {
    echo "削除ボタンが押下されました";

    // DELETE文を変数に格納(info_aとinfo_bそれぞれ)
    $sql3 = 'DELETE FROM info_b WHERE manage_id = :id;
    DELETE FROM info_a WHERE manage_id = :id';
    // 削除するレコードのIDは空のまま、SQL実行の準備をする
    $stmt3 = $dbh->prepare($sql3);
    // 削除するレコードのIDを配列に格納する
    $params = array(':id'=>$manage_id);
    // 削除するレコードのIDが入った変数をexecuteにセットしてSQLを実行
    $stmt3->execute($params);
    header("location: ../Home/Main.php");
  }

?>


<!DOCTYPE HTML>
<html>
<head>
  <title>管理情報編集画面</title>
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
  <form enctype="multipart/form-data" action="" method="POST">
    <div class="container"> <!--コンテナ用divで囲む-->
      <div class="left_wrap">
        <p class = "businesscardU">
          顔写真<br>
          現在登録されている画像
          <?php
          //画像用にSQL文を定義
          $dbhh = new PDO($dsn, $user);
          $sqll = "SELECT image FROM info_a where manage_id = $MID AND user_id = $ID";
          $stmtl = $dbhh->prepare($sqll);
          $stmtl->execute();
          $row3 = $stmtl->fetch(PDO::FETCH_ASSOC);
          $stmtl->execute();
          //配列に画像を保存
          while($row3 = $stmtl->fetch(PDO::FETCH_ASSOC) ){
            $DB_PIC_ARRAY[] = $row3['image'];
          }
          //$DB..配列を見てエンコードして表示
          foreach($DB_PIC_ARRAY as $pic){
            $enc_img = base64_encode($pic);
            $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
            echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" width="200px" height="200px" />';
          }
          ?>
          <!--画像入力フォーム-->
          <br>新たに登録する画像<br>
          <img id="img1" style="width:200px;height:200px;" />
          <input type="file" id="myfile" name = "image" accept="image/*" ><br>
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
          <input type = "text" style = "width:100px;" name = "surname" value="<?php echo htmlspecialchars($row['surname'], ENT_QUOTES, "UTF-8"); ?>">
          <input type = "text" style = "width:100px;" name = "name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, "UTF-8"); ?>">
        </p>

        <p class = "namef">
          フリガナ　　
          <input type = "text" style = "width:100px;" name = "surname_ruby" value="<?php echo htmlspecialchars($row['surname_ruby'], ENT_QUOTES, "UTF-8"); ?>">
          <input type = "text" style = "width:100px;" name = "name_ruby" value="<?php echo htmlspecialchars($row['name_ruby'], ENT_QUOTES, "UTF-8"); ?>">
        </p>

        <p class ="sex">
          性　　別　　
          <?php if($row['gender'] == "f"){ ?>
            <input type = "radio" name = "gender" value = "f" checked="checked">女性
          <?php } else{ ?>
            <input type = "radio" name = "gender" value = "f">女性
          <?php }
          if($row['gender'] == "m"){ ?>
            <input type = "radio" name = "gender" value = "m" checked="checked">男性
          <?php } else{ ?>
            <input type = "radio" name = "gender" value = "m">男性
          <?php }
          if($row['gender'] == "o"){ ?>
            <input type = "radio" name = "gender" value = "o" checked="checked">その他
          <?php } else{ ?>
            <input type = "radio" name = "gender" value = "o">その他
          <?php } ?><br>
        </p>

        <p class ="red">
          血液型　　　
          <?php
          if($row2['blood_type'] == "A"){ ?>
            <INPUT type="radio" name="blood_type" value="A" checked = "checked">A型
            <?php } else{ ?>
            <INPUT type="radio" name="blood_type" value="A">A型
          <?php }

          if($row2['blood_type'] == "B"){ ?>
          <INPUT type="radio" name="blood_type" value="B" checked = "checked">B型
          <?php } else{ ?>
            <INPUT type="radio" name="blood_type" value="B">B型
            <?php }

          if($row2['blood_type'] == "AB"){ ?>　
            <INPUT type="radio" name="blood_type" value="AB" checked = "checked">AB型
            <?php } else{ ?>
              <INPUT type="radio" name="blood_type" value="AB">AB型
            <?php }

          if($row2['blood_type'] == "O"){ ?>　
            <INPUT type="radio" name="blood_type" value="O" checked = "checked">O型
            <?php } else{ ?>
              <INPUT type="radio" name="blood_type" value="O">O型
            <?php }

          if($row2['blood_type'] == "ot"){ ?>　
            <INPUT type="radio" name="blood_type" value="other" checked = "checked">不明
            <?php } else{ ?>
              <INPUT type="radio" name="blood_type" value="other">不明
              <?php } ?>
            </p>

                            <p class = "birthday">
                              <form action="./" method="post" name="form1" id="form1">
                                <table>
                                  生年月日　　
                                  <select name="birth_year">
                                    <option value=<?php echo htmlspecialchars($row['birth_year'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['birth_year'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                                    <option value="">--</option>
                                    <option value="1900">1900(明治33)</option>
                                    <option value="1901">1901(明治34)</option>
                                    <option value="1902">1902(明治35)</option>
                                    <option value="1903">1903(明治36)</option>
                                    <option value="1904">1904(明治37)</option>
                                    <option value="1905">1905(明治38)</option>
                                    <option value="1906">1906(明治39)</option>
                                    <option value="1907">1907(明治40)</option>
                                    <option value="1908">1908(明治41)</option>
                                    <option value="1909">1909(明治42)</option>
                                    <option value="1910">1910(明治43)</option>
                                    <option value="1911">1911(明治44)</option>
                                    <option value="1912">1912(大正元)</option>
                                    <option value="1913">1913(大正2)</option>
                                    <option value="1914">1914(大正3)</option>
                                    <option value="1915">1915(大正4)</option>
                                    <option value="1916">1916(大正5)</option>
                                    <option value="1917">1917(大正6)</option>
                                    <option value="1918">1918(大正7)</option>
                                    <option value="1919">1919(大正8)</option>
                                    <option value="1920">1920(大正9)</option>
                                    <option value="1921">1921(大正10)</option>
                                    <option value="1922">1922(大正11)</option>
                                    <option value="1923">1923(大正12)</option>
                                    <option value="1924">1924(大正13)</option>
                                    <option value="1925">1925(大正14)</option>
                                    <option value="1926">1926(大正15)</option>
                                    <option value="1927">1927(昭和2)</option>
                                    <option value="1928">1928(昭和3)</option>
                                    <option value="1929">1929(昭和4)</option>
                                    <option value="1930">1930(昭和5)</option>
                                    <option value="1931">1931(昭和6)</option>
                                    <option value="1932">1932(昭和7)</option>
                                    <option value="1933">1933(昭和8)</option>
                                    <option value="1934">1934(昭和9)</option>
                                    <option value="1935">1935(昭和10)</option>
                                    <option value="1936">1936(昭和11)</option>
                                    <option value="1937">1937(昭和12)</option>
                                    <option value="1938">1938(昭和13)</option>
                                    <option value="1939">1939(昭和14)</option>
                                    <option value="1940">1940(昭和15)</option>
                                    <option value="1941">1941(昭和16)</option>
                                    <option value="1942">1942(昭和17)</option>
                                    <option value="1943">1943(昭和18)</option>
                                    <option value="1944">1944(昭和19)</option>
                                    <option value="1945">1945(昭和20)</option>
                                    <option value="1946">1946(昭和21)</option>
                                    <option value="1947">1947(昭和22)</option>
                                    <option value="1948">1948(昭和23)</option>
                                    <option value="1949">1949(昭和24)</option>
                                    <option value="1950">1950(昭和25)</option>
                                    <option value="1951">1951(昭和26)</option>
                                    <option value="1952">1952(昭和27)</option>
                                    <option value="1953">1953(昭和28)</option>
                                    <option value="1954">1954(昭和29)</option>
                                    <option value="1955">1955(昭和30)</option>
                                    <option value="1956">1956(昭和31)</option>
                                    <option value="1957">1957(昭和32)</option>
                                    <option value="1958">1958(昭和33)</option>
                                    <option value="1959">1959(昭和34)</option>
                                    <option value="1960">1960(昭和35)</option>
                                    <option value="1961">1961(昭和36)</option>
                                    <option value="1962">1962(昭和37)</option>
                                    <option value="1963">1963(昭和38)</option>
                                    <option value="1964">1964(昭和39)</option>
                                    <option value="1965">1965(昭和40)</option>
                                    <option value="1966">1966(昭和41)</option>
                                    <option value="1967">1967(昭和42)</option>
                                    <option value="1968">1968(昭和43)</option>
                                    <option value="1969">1969(昭和44)</option>
                                    <option value="1970">1970(昭和45)</option>
                                    <option value="1971">1971(昭和46)</option>
                                    <option value="1972">1972(昭和47)</option>
                                    <option value="1973">1973(昭和48)</option>
                                    <option value="1974">1974(昭和49)</option>
                                    <option value="1975">1975(昭和50)</option>
                                    <option value="1976">1976(昭和51)</option>
                                    <option value="1977">1977(昭和52)</option>
                                    <option value="1978">1978(昭和53)</option>
                                    <option value="1979">1979(昭和54)</option>
                                    <option value="1980">1980(昭和55)</option>
                                    <option value="1981">1981(昭和56)</option>
                                    <option value="1982">1982(昭和57)</option>
                                    <option value="1983">1983(昭和58)</option>
                                    <option value="1984">1984(昭和59)</option>
                                    <option value="1985">1985(昭和60)</option>
                                    <option value="1986">1986(昭和61)</option>
                                    <option value="1987">1987(昭和62)</option>
                                    <option value="1988">1988(昭和63)</option>
                                    <option value="1989">1989(平成元)</option>
                                    <option value="1990">1990(平成2)</option>
                                    <option value="1991">1991(平成3)</option>
                                    <option value="1992">1992(平成4)</option>
                                    <option value="1993">1993(平成5)</option>
                                    <option value="1994">1994(平成6)</option>
                                    <option value="1995">1995(平成7)</option>
                                    <option value="1996">1996(平成8)</option>
                                    <option value="1997">1997(平成9)</option>
                                    <option value="1998">1998(平成10)</option>
                                    <option value="1999">1999(平成11)</option>
                                    <option value="2000">2000(平成12)</option>
                                    <option value="2001">2001(平成13)</option>
                                    <option value="2002">2002(平成14)</option>
                                    <option value="2003">2003(平成15)</option>
                                    <option value="2004">2004(平成16)</option>
                                    <option value="2005">2005(平成17)</option>
                                    <option value="2006">2006(平成18)</option>
                                    <option value="2007">2007(平成19)</option>
                                    <option value="2008">2008(平成20)</option>
                                    <option value="2009">2009(平成21)</option>
                                    <option value="2010">2010(平成22)</option>
                                    <option value="2011">2011(平成23)</option>
                                    <option value="2012">2012(平成24)</option>
                                    <option value="2013">2013(平成25)</option>
                                    <option value="2014">2014(平成26)</option>
                                    <option value="2015">2015(平成27)</option>
                                    <option value="2016">2016(平成28)</option>
                                    <option value="2017">2017(平成29)</option>
                                    <option value="2018">2018(平成30)</option>
                                    <option value="2018">2019(平成31)</option>
                                  </select>年
                                  <select name="birth_month">
                                    <option value=<?php echo htmlspecialchars($row['birth_month'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['birth_month'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                                    <option value="">--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>月
                                  <select name="birth_day">
                                    <option value=<?php echo htmlspecialchars($row['birth_day'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['birth_day'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                                    <option value="">--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                  </select>日
                                </tr><br><!--<br>
                                  <tr>
                                  年　　齢　　
                                  <input type="text" name="age" value="<?php
                                  $now = date("Ymd");
                                  echo floor(($now-$birthday)/10000).'歳';
                                  ?>" />
                                </tr>
                              -->
                            </table>
                          </form>
                        </p>

                        <p class = "relation">
                          関　　係　　
                          <select name = "tag_id">
                            <?php
                            $dbh = new PDO($dsn, $user, $pass);
                            $stmt3 = $dbh->prepare('SELECT tag_name FROM tag');
                            $stmt3->execute();
                            $tag_name = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                            $k = 0;?>
                            <option value ="<?php echo $row['tag_id']?>"><?php echo $tag_name[$row['tag_id']-1]['tag_name'];echo ("(現在値)") ?></option>
                            <option value="">--</option>
                            <?php
                            while(true){
                              if( empty( $tag_name[$k]['tag_name'] )){
                                break;
                              }
                              ?>
                              <option value ="<?php echo $k+1;?>"><?php echo $tag_name[$k]['tag_name']; ?></option><?php
                              $k = $k + 1;
                            }
                            ?>
                          </select>
                        </p>


                        <p class = "hobby">
                          趣　　味　　
                          <input type = "text" style = "width:115px;" name = "hobby" value="<?php echo htmlspecialchars($row2['hobby'], ENT_QUOTES, "UTF-8"); ?>">
                        </p>

                        <p class = "feature">
                          特　　徴　　
                          <input type = "text" style = "width:115px;" name = "feature" value="<?php echo htmlspecialchars($row2['feature'], ENT_QUOTES, "UTF-8"); ?>">
                        </p>

                        <p class = "metday">
                          出会った日　
                          <select name = "met_year">
                            <option value=<?php echo htmlspecialchars($row['met_year'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['met_year'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                            <option value="">--</option>
                            <option value="1900">1900(明治33)</option>
                            <option value="1901">1901(明治34)</option>
                            <option value="1902">1902(明治35)</option>
                            <option value="1903">1903(明治36)</option>
                            <option value="1904">1904(明治37)</option>
                            <option value="1905">1905(明治38)</option>
                            <option value="1906">1906(明治39)</option>
                            <option value="1907">1907(明治40)</option>
                            <option value="1908">1908(明治41)</option>
                            <option value="1909">1909(明治42)</option>
                            <option value="1910">1910(明治43)</option>
                            <option value="1911">1911(明治44)</option>
                            <option value="1912">1912(大正元)</option>
                            <option value="1913">1913(大正2)</option>
                            <option value="1914">1914(大正3)</option>
                            <option value="1915">1915(大正4)</option>
                            <option value="1916">1916(大正5)</option>
                            <option value="1917">1917(大正6)</option>
                            <option value="1918">1918(大正7)</option>
                            <option value="1919">1919(大正8)</option>
                            <option value="1920">1920(大正9)</option>
                            <option value="1921">1921(大正10)</option>
                            <option value="1922">1922(大正11)</option>
                            <option value="1923">1923(大正12)</option>
                            <option value="1924">1924(大正13)</option>
                            <option value="1925">1925(大正14)</option>
                            <option value="1926">1926(大正15)</option>
                            <option value="1927">1927(昭和2)</option>
                            <option value="1928">1928(昭和3)</option>
                            <option value="1929">1929(昭和4)</option>
                            <option value="1930">1930(昭和5)</option>
                            <option value="1931">1931(昭和6)</option>
                            <option value="1932">1932(昭和7)</option>
                            <option value="1933">1933(昭和8)</option>
                            <option value="1934">1934(昭和9)</option>
                            <option value="1935">1935(昭和10)</option>
                            <option value="1936">1936(昭和11)</option>
                            <option value="1937">1937(昭和12)</option>
                            <option value="1938">1938(昭和13)</option>
                            <option value="1939">1939(昭和14)</option>
                            <option value="1940">1940(昭和15)</option>
                            <option value="1941">1941(昭和16)</option>
                            <option value="1942">1942(昭和17)</option>
                            <option value="1943">1943(昭和18)</option>
                            <option value="1944">1944(昭和19)</option>
                            <option value="1945">1945(昭和20)</option>
                            <option value="1946">1946(昭和21)</option>
                            <option value="1947">1947(昭和22)</option>
                            <option value="1948">1948(昭和23)</option>
                            <option value="1949">1949(昭和24)</option>
                            <option value="1950">1950(昭和25)</option>
                            <option value="1951">1951(昭和26)</option>
                            <option value="1952">1952(昭和27)</option>
                            <option value="1953">1953(昭和28)</option>
                            <option value="1954">1954(昭和29)</option>
                            <option value="1955">1955(昭和30)</option>
                            <option value="1956">1956(昭和31)</option>
                            <option value="1957">1957(昭和32)</option>
                            <option value="1958">1958(昭和33)</option>
                            <option value="1959">1959(昭和34)</option>
                            <option value="1960">1960(昭和35)</option>
                            <option value="1961">1961(昭和36)</option>
                            <option value="1962">1962(昭和37)</option>
                            <option value="1963">1963(昭和38)</option>
                            <option value="1964">1964(昭和39)</option>
                            <option value="1965">1965(昭和40)</option>
                            <option value="1966">1966(昭和41)</option>
                            <option value="1967">1967(昭和42)</option>
                            <option value="1968">1968(昭和43)</option>
                            <option value="1969">1969(昭和44)</option>
                            <option value="1970">1970(昭和45)</option>
                            <option value="1971">1971(昭和46)</option>
                            <option value="1972">1972(昭和47)</option>
                            <option value="1973">1973(昭和48)</option>
                            <option value="1974">1974(昭和49)</option>
                            <option value="1975">1975(昭和50)</option>
                            <option value="1976">1976(昭和51)</option>
                            <option value="1977">1977(昭和52)</option>
                            <option value="1978">1978(昭和53)</option>
                            <option value="1979">1979(昭和54)</option>
                            <option value="1980">1980(昭和55)</option>
                            <option value="1981">1981(昭和56)</option>
                            <option value="1982">1982(昭和57)</option>
                            <option value="1983">1983(昭和58)</option>
                            <option value="1984">1984(昭和59)</option>
                            <option value="1985">1985(昭和60)</option>
                            <option value="1986">1986(昭和61)</option>
                            <option value="1987">1987(昭和62)</option>
                            <option value="1988">1988(昭和63)</option>
                            <option value="1989">1989(平成元)</option>
                            <option value="1990">1990(平成2)</option>
                            <option value="1991">1991(平成3)</option>
                            <option value="1992">1992(平成4)</option>
                            <option value="1993">1993(平成5)</option>
                            <option value="1994">1994(平成6)</option>
                            <option value="1995">1995(平成7)</option>
                            <option value="1996">1996(平成8)</option>
                            <option value="1997">1997(平成9)</option>
                            <option value="1998">1998(平成10)</option>
                            <option value="1999">1999(平成11)</option>
                            <option value="2000">2000(平成12)</option>
                            <option value="2001">2001(平成13)</option>
                            <option value="2002">2002(平成14)</option>
                            <option value="2003">2003(平成15)</option>
                            <option value="2004">2004(平成16)</option>
                            <option value="2005">2005(平成17)</option>
                            <option value="2006">2006(平成18)</option>
                            <option value="2007">2007(平成19)</option>
                            <option value="2008">2008(平成20)</option>
                            <option value="2009">2009(平成21)</option>
                            <option value="2010">2010(平成22)</option>
                            <option value="2011">2011(平成23)</option>
                            <option value="2012">2012(平成24)</option>
                            <option value="2013">2013(平成25)</option>
                            <option value="2014">2014(平成26)</option>
                            <option value="2015">2015(平成27)</option>
                            <option value="2016">2016(平成28)</option>
                            <option value="2017">2017(平成29)</option>
                            <option value="2018">2018(平成30)</option>
                            <option value="2018">2019(平成31)</option>
                          </select>
                          年
                          <select name = "met_month">
                            <option value=<?php echo htmlspecialchars($row['met_month'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['met_month'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                            <option value="">--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                          月
                          <select name = "met_day">
                            <option value=<?php echo htmlspecialchars($row['met_day'], ENT_QUOTES, "UTF-8"); ?>> <?php echo htmlspecialchars($row['met_day'], ENT_QUOTES, "UTF-8");echo ("(現在値)") ?></option>
                            <option value="">--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                          日
                        </p>

                        <p class = "met_space">
                          出会った場所
                          <input type = "text" style = "width:115px;" name = "met_space" value="<?php echo htmlspecialchars($row2['met_space'], ENT_QUOTES, "UTF-8"); ?>">
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
                      <TEXTAREA cols = "60%" rows = "5" name = "free_space" value="<?php echo htmlspecialchars($row2['free_space'], ENT_QUOTES, "UTF-8"); ?>"> <?php echo $row2['free_space']?></TEXTAREA
                      </p>

                      <p class = "button">
                        <input type = "submit" value = "更新" id = "submit" name = "submit">
                        <input type = "submit" value = "削除" id = "close" name = "delete">
                        <input type = "button" onClick='history.back();' value = "キャンセル" id = "submit" onclick="location.href='../Home/Main.php'">
                      </p>
                    </div>
                  </body>
                </form>
                </html>
