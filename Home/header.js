//
function on_icon(){
    var gear = document.getElementById("setting_icon");
    gear.innerHTML = "a";
}

function disp(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('本当にいいんですね？')){
		location.href = "example_confirm.html"; // example_confirm.html へジャンプ
    return true;
	}
	// 「OK」時の処理終了
	// 「キャンセル」時の処理開始
 else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
    return false;
	}
	// 「キャンセル」時の処理終了
}
