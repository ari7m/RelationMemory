<?php
// mysqliクラスのオブジェクトを作成
$mysqli = new mysqli('localhost', 'DBユーザー名', 'パスワード', 'DB名');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

//-------------------------------------------------------------------------------
/*
$link = mysqli_connect($host, $username, $passwd, $dbname);

// 接続成功した場合
if ($link) {

    // 文字化け防止
    mysqli_set_charset($link, 'utf8');

    $query = 'SELECT goods_name, price FROM goods_table ORDER BY price ' . $order;

    // クエリを実行
    $result = mysqli_query($link, $query);

    // 1行ずつ結果を配列で取得
    while ($row = mysqli_fetch_array($result)) {
        $goods_data[] = $row;
    }

    mysqli_free_result($result);

    // 接続を閉じる
    mysqli_close($link);

// 接続失敗した場合
} else {
    print 'DB接続失敗';
}
*/
//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
$multiArray=array(
//名前,年齢,ふりがな,性別
            "河野 雄也"=>
	    array("name"=>"こうの","age"=>21,"sex"=>"male","hurigana"=>"コウノ"),
	    
            "有薗 里奈"=>
	    array("name"=>"ありぞの","age"=>16,"sex"=>"female","hurigana"=>"アリゾノ"),
	    
            "高橋 慎也"=>
	    array("name"=>"たかはし","age"=>4, "sex"=>"male","hurigana"=>"タカハシ"),
	    
            "引本 匡磨"=>
	    array("name"=>"ひきもと","age"=>38,"sex"=>"male","hurigana"=>"ヒキモト"),
	    
            "南部 美希奈"=>
	    array("name"=>"なんぶ","age"=>32,"sex"=>"female","hurigana"=>"ナンブ"),
	    
            "堀 　絢香"=>
	    array("name"=>"ほり","age"=>45,"sex"=>"female","hurigana"=>"ホリ"),
	    
            "伊藤 佑樹"=>
	    array("name"=>"いとう","age"=>14,"sex"=>"male","hurigana"=>"イトウ"),
	    
	    "アンソニー"=>
	    array("name"=>"あんそにー","age"=>45,"sex"=>"male","hurigana"=>"Ansny"),
	    
            "レベッカ"=>
	    array("name"=>"れべっか","age"=>14,"sex"=>"female","hurigana"=>"Lebekka")
        );
//-------------------------------------------------------------------------------------
//以下ソートプログラム

// 文字列の大文字小文字を区別しない

foreach($multiArray as $key=>$value){
            $hurigana[$key]=$value["hurigana"];    
        }
//配列$huriganaを並び替える、それに伴って$multilArrayも並び替える
array_multisort($hurigana,SORT_ASC,$multiArray);
print_r($hurigana);

//-----------------------------------------------------------------------------
$sql = 'SELECT NAME, AGE, WEIGHT FROM TAMESI1'; //データの追加も行える(不安定)
if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
     echo $row['name'] . ', '
	. $row['age'] . ', '
	. $row['sex'] . ', '
	. $row['hurigana']
	. '<br />';
    }
    // 結果セットを閉じる
    $result->close();
}

// DB接続を閉じる
$mysqli->close();

/*---------------------------------------------------------------------------------------
// ひな型を介してステートメントハンドルを取得した追加方法
$sql = "INSERT INTO TAMESI1 (name, age, sex , hurigana) VALUES (?, ?, ? , ?)";
if ($stmt = $mysqli->prepare($sql)) {
    // 条件値をSQLにバインドする
    // bind_param の第１引数 "is" は後続のデータ型を表せる
    $name = "河野";
    $age = 21;
    $sex = men;
    $hurigana = "こうの";
    $stmt->bind_param("sii", $name, $age, $sex, $hurigana);

    // 実行する場合
    $stmt->execute();

    $stmt->close();
}
-----------------------------------------------------------------------------------------*/

?>
