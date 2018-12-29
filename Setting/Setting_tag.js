// 静的変数的な
var num = function() {
    // 変数"a"を初期化
    var a = 0;
    // 処理内容の（外側でtest関数になる）無名関数を返す
    return function() {
        // 変数"a"をカウントアップ
        a ++;
        // 変数"a"の値を返す
        return a;
    };
}();
// 最初に表示される分(title属性の値の数だけ表示)
window.onload = function() {
    const tag = document.getElementById("tag");
    const item = document.getElementById("item");
    const cntTag = tag.getAttribute("data-cntTag");
    const cntItem = item.getAttribute("data-cntItem");
    for (var i = 0; i < cntTag; i++) {
        CreateForm("tag");
        if (i == 0) {
            tag.removeChild(tag.firstChild);
            tag.removeChild(tag.firstChild);
            tag.removeChild(tag.firstChild);
            tag.removeChild(tag.lastChild);
        }
    }
    for (var i = 0; i < cntItem; i++) {
        CreateForm("item");
        if (i == 0) {
            item.removeChild(item.firstChild);
            item.removeChild(item.firstChild);
            item.removeChild(item.firstChild);
            item.removeChild(item.lastChild);
        }
    }
}
// form作成する分
function CreateForm(str) {
    const id = document.getElementById(str);
    const input = document.createElement("input");
    const button = document.createElement("input");
    var N = num();
    // formの属性設定
    input.setAttribute("type", "text");
    input.setAttribute("value", N);
    input.setAttribute("id", str + N);
    // buttonの属性設定
    button.setAttribute("type", "button");
    button.setAttribute("value", "削除");
    button.setAttribute("onclick", "RemoveForm(" + N + ", '" + str + "')");
    button.setAttribute("id", "button" + N);
    // 描画
    id.appendChild(document.createElement("br"));
    id.appendChild(document.createElement("br"));
    id.appendChild(input);
    id.appendChild(button);
}
// form消す分
function RemoveForm(num, str) {
    const id = document.getElementById(str);
    console.log(typeof str);
    console.log(typeof num);
    const targ1 = document.getElementById(str + num);
    console.log(str + num);
    const targ2 = document.getElementById("button" + num);
    console.log(targ2);
    const targ3 = targ1.previousElementSibling;
    const targ4 = targ3.previousElementSibling;
    id.removeChild(targ1);
    id.removeChild(targ2);
    id.removeChild(targ3);
    id.removeChild(targ4);
}
