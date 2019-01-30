<?php
// mysqliクラスのオブジェクトを作成
$mysqli = new mysqli('localhost', 'DBユーザー名', 'パスワード', 'DB名');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
//----------------------------------------------------------------------------
$multiArray=array(
//名前,年齢,ふりがな,登録日時
            "河野 雄也"=>
	    array("name"=>"こうの","age"=>21,"sex"=>"男","hurigana"=>"コウノ"),
	    
            "有薗 里奈"=>
	    array("name"=>"ありぞの","age"=>16,"sex"=>"女","hurigana"=>"アリゾノ"),
	    
            "高橋 慎也"=>
	    array("name"=>"たかはし","age"=>4, "sex"=>"男","hurigana"=>"タカハシ"),
	    
            "引本 匡磨"=>
	    array("name"=>"ひきもと","age"=>38,"sex"=>"男","hurigana"=>"ヒキモト"),
	    
            "南部 美希奈"=>
	    array("name"=>"なんぶ","age"=>32,"sex"=>"女","hurigana"=>"ナンブ"),
	    
            "堀 　絢香"=>
	    array("name"=>"ほり","age"=>45,"sex"=>"女","hurigana"=>"ホリ"),
	    
            "伊藤 佑樹"=>
	    array("name"=>"いとう","age"=>14,"sex"=>"男","hurigana"=>"イトウ"),
	    
	    "アンソニー"=>
	    array("name"=>"あんそにー","age"=>45,"sex"=>"男","hurigana"=>"Ansny"),
	    
            "レベッカ"=>
	    array("name"=>"れべっか","age"=>14,"sex"=>"女","hurigana"=>"Lebekka")
        );


//------------------------------------------------------------------------------
//以下ソートプログラム
// 文字列の大文字小文字を区別しない
foreach($multiArray as $key=>$value){
            $age[$key]=$value["age"];    
        }
	
//配列$ageを並び替える、それに伴って$multilArrayも並び替える
array_multisort($age,SORT_ASC,$multiArray);

//年齢順配列のソート表示
print_r($age); 

//-----------------------------------------------------------------------------
$sql = 'SELECT NAME, AGE, WEIGHT FROM TAMESI1'; //データの追加も行える
if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . ', ' . $row['age'] . ', ' . $row['sex'] . ', ' . $row['hurigana'] . '<br />';
    }
    // 結果セットを閉じる
    $result->close();
}

// DB接続を閉じる
$mysqli->close();

/*
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
*/

?>