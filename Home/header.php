<?php
    session_start();
    
    // DBと接続

    //$id = '1';
    /*
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
         exit();
    }
    */
    
    include "../Setting/access_db.php";

    $id = $_SESSION['ID'];
    //echo $id;

    if(isset($_POST['search_start'])){
        if(isset($_POST['keywords'])){
            $asql = "SELECT * FROM info_a WHERE user_id = $id AND (surname LIKE '%".$_POST["keywords"]."%' 
                                                                    OR name LIKE '%".$_POST["keywords"]."%' 
                                                                    OR surname_ruby LIKE '%".$_POST["keywords"]."%' 
                                                                    OR name_ruby LIKE '%".$_POST["keywords"]."%'
                                                                    )";
            $bsql = "SELECT * FROM info_b WHERE user_id = $id AND (blood_type LIKE '%".$_POST["keywords"]."%'
                                                                    OR feature LIKE '%".$_POST["keywords"]."%'
                                                                    OR hobby LIKE '%".$_POST["keywords"]."%'
                                                                    OR met_space LIKE '%".$_POST["keywords"]."%'
                                                                    OR free_space LIKE '%".$_POST["keywords"]."%'
                                                                    )";
        } else {
            $asql = "SELECT manage_id FROM info_a WHERE user_id = $id";
            $bsql = "SELECT manage_id FROM info_b WHERE user_id = $id";
        }
        $ksql = $dbh -> query($asql) -> fetchALL(PDO::FETCH_ASSOC);
        foreach($ksql as $key){
            //echo $key['manage_id'];
            $akey_MI[] = $key['manage_id'];
        }
        //var_dump($akey_MI);
        $ksql = $dbh -> query($bsql) -> fetchALL(PDO::FETCH_ASSOC);
        foreach($ksql as $key){
            //echo $key['manage_id'];
            $akey_MI[] = $key['manage_id'];
        }
        //var_dump($akey_MI);
        //重複の削除
        $key_MI = array_unique($akey_MI);
        //var_dump($key_MI);
        //配列の要素が重複を削除したことで抜けてる部分ができるため再振り分け
        $_SESSION['manage_id'] = (array_values($key_MI));
        //var_dump(array_values($key_MI));
    }
    
    
    if(isset($_GET['logout']) === true){
        //pirnt_r($_GET);
        header('location: logout.php');
        exit();
    }
    
?>

<!DOCTYPE html>
<html>
    <head id = "site_header">
        <meta charset = "UTF8">
        <link rel = "stylesheet" type = "text/css" href = "../Home/header.css">
        <script src = "../Home/header.js"></script>

        <div class="container"> <!--コンテナ用divで囲む-->
        <!-- アイコンをクリックするとメインページにジャンプする処理 -->
        <div class = "header_place">
            <p>
                <a href = "../Template.html" target="_top">
                    <img src = "../Image/rogo.png" alt = "オオカミとマカロン" id = "rogo_icon_size">
                </a>
            </p>
        </div>


        <!-- 検索フォーム -->
        <div class = "header_place">
            <form id = "form" method="post">
              <input id="sbox"  id="keywords" name="keywords" type="text" placeholder="キーワードを入力" value=""/>
              <input id="sbtn" type="submit" href="../Search/Search_result.php" target ="frame3" name="search_start" value="検索" />
            </form>
        </div>

        <!-- インフォメーション。マウスイベント(アイコンに触れるまたはクリックする)で検索の仕方を表示 -->
        <div class = "header_place msg">
            <a href = "#">
                <img src = "../Image/info_icon.png" alt = "i" class = "inf_icon">
                <span class = "infometion">
                    <b>検索のヒント</b></br>
                    <i>A or B</i></br>
                    AまたはBを含む結果の表示</br>
                    </br>
                    <i>-A</i></br>
                    Aを含まない結果の表示</br>
                    </pre>
                </span>
            </a>
        </div>

        <!-- 共有をクリックで共有モジュールへジャンプ -->
        <div class="header_place buttonContainer">
          <a class="header_place button" href="../Template.html"  target="_top">Share</a>
        </div>

        <!-- 設定。歯車マークにマウスカーソルを合わせるまたはクリックで設定メニューを表示 -->
        <div class="header_place menu">
          <label for="menu_bar01">
            <img src = "../Image/setting.png" alt = "設定" id = "setting_icon"><!--onmouseover="on_icon();"-->
          </label>
          <input type="checkbox" id="menu_bar01" class="accordion"  hidden/>
          <ul id="links01">
              <form action="Template.html" method="get">
                  <li><a href="../Setting/ Setting_user.php" target="frame3" >ユーザ情報の設定</a></li>
                  <li><a href="../Setting/Setting_tag.php" target="frame3">登録情報の設定</a></li>
                  <li>
                      <input type='hidden' onclick="return disp();" target="_top" name="logout" value="logout">
                      <a href="logout.php" target="_top">ログアウト</a>
                  </li>
              </form>
          </ul>
        </div>
        </div>
    </head>
    <body></body>
</html>
