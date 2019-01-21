<head>
   <?php
       session_start();
       $ID = $_SESSION['ID'];
   ?>
</head>

<?php
  include "access_db.php"; // データベース取得
  $sql = "select * from user where user_id = 'abc123'"; 
  $stmt = $dbh -> query($sql);	   

foreach ($stmt as $row){
$user_id = $row["user_id"]; // user_idの確保
$user_name = $row["user_name"];
$user_pwd = $row["user_pwd"];
}
?>

<html>
  
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Mitame.css">
  <h2 class = "title">
    ユーザ設定＠<?php echo $user_id; ?></h2>

  <br />

  <div align = "center">
    
    <div style="float:left;width:35%;" align = "right">
      ユーザ名 <br /><br />
      ユーザ名の変更<br /><br />
      パスワードの変更<br /><br />
      パスワードの再入力
    </div>

    <div style="float:left;width:10%;">
      　<!--ここ全角スペース-->
   </div>
    <form action="Setting_changed.php" method="post" name = "form1">
      <div align = "left" style="float:left;width:55%;">
	<?php echo $user_name; ?> <br /><br >
	
	<input type = "text" name = "user"  style="width:250px;"/> <br /><br />
<!--	<input type = "password" name = "pwd" id = "pwd" maxlength = "256" pattern = "^[!-~]+$"  style="width:250px;"required/> <br /><br />
	 <input type = "password" name = "repwd" id = "repwd" oninput="CheckPassword(this)"style="width:250px;" required/> -->

	
	<input type = "password" name = "pwd" style="width:250px;" />                           <br /><br />
	<input type = "password" name = "repwd" style="width:250px;" />

      </div>
      
   <!--   <script>
       function CheckPassword(repwd){
           // 入力値取得
           var input1 = pwd.value;
           var input2 = repwd.value;
           // パスワード比較
           if(input1 != input2){
               repwd.setCustomValidity("入力値が一致しません。");
           }else{
               repwd.setCustomValidity('');
           }
       }
   </script> -->

      <div style="clear:both;"></div>
      <br /><br />
      <div class = "center2">
	
	<dialog>
	  <h3 class = "title">
	    ユーザ情報の変更</h3>
          ユーザID　
	  <form name = "myform">
	    <input type = "text" name = "a">
            <br>
            
            パスワード
            <input type = "password" name = "b"><br />
          </form>
          <div class = "button_place"> 
            <input value = "変更する" type = "button" onclick="check(a.value,b.value);">
            <input type = "button" value = "キャンセル" id = "close">
          </div>
	  
	  <script>
	    function check(a,b){ <!--　アカウント変更じのID、PWDのチェック -->
	   var user = <?php echo json_encode($user_id); ?>;<!--DBから取ってきたものをhtmlの変数に入れる -->
            var pwd = <?php echo json_encode($user_pwd); ?>;
	    if(a == user && b == pwd){
	    document.form1.submit(); 
	    }
	    }
	  </script>
	 
	  
	</dialog>
	
	<input type= "button" value = "変更する" id = "change">      
	<br />  <br />  <br />
    </form>
    <input type="button" id="open2" value="アカウント削除">
    </div>
    
    <br/>

   <script>
      var dialog = document.querySelector('dialog');
      var btn_show = document.getElementById('change');
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

    
    <br/>
    
      
      <script>
	window.addEventListener('load', function() {
	var dialog2 = document.getElementById('dialog2');
	var open2 = document.getElementById('open2');
	var text2 = document.getElementById('text2');
	var close2 = document.getElementById('close2');
	open2.addEventListener('click', function() {
        dialog2.showModal();
	});
	close2.addEventListener('click', function() {
        dialog2.close();
	});
	});
      </script>

     <form name = "delete">
	
	<dialog id="dialog2">
	  <h3 class = "title">
	    アカウントの削除</h3>
	  
	  <form name = "delete_check">
	    ユーザID　
            <input type = "text" name = "c">
            <br>
          </form>
          パスワード
          <input type = "password" name = "d"><br />
      </form>
      
      <div class = "button_place">
        <input type = "button" value = "削除する"  onclick="delete_check(c.value,d.value,);" >
        <input type = "button" value = "キャンセル" id = "close2">
      </div>
      
      <script>
	function delete_check(c,d){ <!--　アカウント削除じのID、PWDのチェック -->
	var user = <?php echo json_encode($user_id); ?>;<!--DBから取ってきたものをhtmlの変数に入れる -->
        var pwd = <?php echo json_encode($user_pwd); ?>;
	if(c == user && d == pwd){
	dialog2.close()
	dialog3.show()
	}
	
	
	}
      </script>
     
      
      </dialog>

      
      <dialog id="dialog3">

	削除するとこのアカウントは使用できなくなります。
	<h3 class = "title">本当に削除しますか？

	</h3>
	
        <input type = "button"  value = "はい" id = "open3" onclick="delete_really();">
	<input type = "button" value = "いいえ" id = "close3">

	<script>
	  function delete_really(){
	  
	  
	  location.href = "user_delete.php";
	  }
	  
        </script> 
	
      </dialog>
      
      　 <script>
	window.addEventListener('load', function() {
	var dialog3 = document.getElementById('dialog3');
	var open3 = document.getElementById('open3');
	var text3 = document.getElementById('text3');
	var close3 = document.getElementById('close3');
	open3.addEventListener('click', function() {
        dialog3.showModal();
	});
	close3.addEventListener('click', function() {
        dialog3.close();
	});
	});
      </script>

</html>

