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
    
    $id = $_SESSION['id'];
    echo $id;
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
            <form id = "form">
              <input id="sbox"  id="s" name="s" type="text" placeholder="キーワードを入力" />
              <input id="sbtn" type="submit" value="検索" />
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
                      <a href="logout.php">ログアウト</a>
                  </li>
              </form>
          </ul>
        </div>
        </div>
    </head>
    <body></body>
</html>
