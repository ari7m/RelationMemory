<?php
$multiArray=array(
            "河野 雄也"=>array("name"=>"こうの","age"=>21,"hurigana"=>"コウノ"),
            "有薗 里奈"=>array("name"=>"ありぞの","age"=>16,"hurigana"=>"アリゾノ"),
            "高橋 慎也"=>array("name"=>"たかはし","age"=>4, "hurigana"=>"タカハシ"),
            "引本 匡磨"=>array("name"=>"ひきもと","age"=>38,"hurigana"=>"ヒキモト"),
            "南部 美希奈"=>array("name"=>"なんぶ","age"=>32,"hurigana"=>"ナンブ"),
            "堀 　絢香"=>array("name"=>"ほり","age"=>45,"hurigana"=>"ホリ"),
            "伊藤 佑樹"=>array("name"=>"いとう","age"=>14,"hurigana"=>"イトウ"),
	    "アンソニー"=>array("name"=>"あんそにー","age"=>45,"hurigana"=>"Ansny"),
            "ゲイツ"=>array("name"=>"げいつ","age"=>14,"hurigana"=>"geitu")
        );
//---------------------------------------------------------------------------------

// 文字列の大文字小文字を区別しない

foreach($multiArray as $key=>$value){
            $hurigana[$key]=$value["hurigana"];    
        }
//配列$ageを並び替える、それに伴って$multilArrayも並び替える
array_multisort($hurigana,SORT_ASC,$multiArray);
print_r($hurigana);
?>