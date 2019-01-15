<?php
// DBとの接続
$user = 'wolf';
$pass = 'password';

try {
    // MySQLへの接続
    $dbh = new PDO('mysql:host=localhost;dbname=rmdb', $user, $pass);

    // 接続を使用する
    $sth = $dbh->query('SELECT * from foo');
    echo "<pre>";
    foreach($sth as $row) {
        print_r($row);
    }
    echo "</pre>";

    // 接続を閉じる
    $sth = null;
    $dbh = null;

    print("DB接続できました！");

} catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>リレメモスタート画面</title>
        <meta charset="UTF8">
        <link rel = "stylesheet" type = "text/css" href = "../Start/Start.css">
    </head>

    <body>
        <div class = "center1">
            <p>・知り合った人の情報を記録</p>
            <p>・豊富な検索機能</p>
            <p>・登録した情報を特定の人と共有</p>
        </div>

        <div class = "center2">
            <dialog>
                ユーザID　
                <input type = "text" name = "id">
                <br>
                <form>
                  パスワード
                    <input type = "password" name = "inputPassword"><br/>
                    <input type = "checkbox" id = "chk" onChange = "toggleInputType(this)" checked>
                    <label for = "chk">
                        パスワードを隠す
                    </label>
                </form>
                <a href = "Secret.html" >忘れた方はこちら<br>
                </a>
                <div class = "button_place">
                    <input type = "button" value = "ログイン" onclick = " location.href = '../Template.html'" id = 'login'>
                    <input type = "button" value = "閉じる" id = "close">
                </div>
            </dialog>
            <input type = "button" value = "今すぐ始める" onclick = " location.href = 'Create_user.html'" id = "start">
            <input type= "button" value = "ログイン" id = "show">
        </div>

        <!-- ダイアログの表示 -->
        <script>
            var dialog = document.querySelector('dialog');
            var btn_show = document.getElementById('show');
            var btn_close = document.getElementById('close');
            btn_show.addEventListener('click', function() {
            dialog.showModal();
            }, false);
            btn_close.addEventListener('click', function() {
            dialog.close();
            }, false);

            function toggleInputType(chk) {
                if (chk.checked) {
                    document.forms[0].inputPassword.type = "password";
                } else {
                    document.forms[0].inputPassword.type = "text";
                }
            }
        </script>

    </body>
</html>