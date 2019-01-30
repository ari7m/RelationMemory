<?php
	//IDのひきわたし
	session_start();
	//$ID = $_SESSION['ID'];
	$ID = '1';
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
	//検索ボタンを押したらこれが始まる
	if (isset($_POST['search_start'])){
		
		//出会った日の検索入力があった場合実行
		$myu = $_POST['myu'];//metyaerunder
		$mmu = $_POST['mmu'];//metmonthunder
		$mdu = $_POST['mdu'];//metdayunder
		$my  = $_POST['my'];//metyear
		$mm  = $_POST['mm'];//metmonth
		$md  = $_POST['md'];//metday
		//出会った年月日~年月日が入力されていたら
		if($myu == !null AND $mmu == !null AND $mdu == !null AND $my == !null AND $mm == !null AND $md == !null) {
			$sqlmet = "SELECT manage_id FROM info_a WHERE (($myu < met_year AND met_year < $my) 
																			OR (met_year = $myu AND $mmu < met_month)
																			OR (met_year = $myu AND $mmu = met_month AND met_day >= $mdu) 
																			OR (met_year = $my AND met_month < $mm)
																			OR (met_year = $my AND met_month = $mm AND met_day <= $md)
																			) AND user_id = $ID";
		//出会った年月日~が入力されていたら
		} else if($myu == !null AND $mmu == !null AND $mdu == !null AND $my == null AND $mm == null AND $md == null){
			$sqlmet = "SELECT manage_id FROM info_a WHERE (($myu < met_year ) 
																			OR (met_year = $myu AND $mmu < met_month)
																			OR (met_year = $myu AND $mmu = met_month AND $mdu <= met_day)
																			) AND user_id = $ID ";
		//出会った~年月日が入力されていたら
		} else if($myu == null AND $mmu == null AND $mdu == null AND $my == !null AND $mm == !null AND $md == !null){
			$sqlmet = "SELECT manage_id FROM info_a WHERE ((met_year < $my)
																			OR (met_year = $my AND met_month < $mm)
																			OR (met_year = $my AND met_month = $mm AND met_day <= $md)
																			) AND user_id = $ID";
		//出会った年月日が入力されていなかったらすべての管理情報の取得
		} else if($myu == null AND $mmu == null AND $mdu == null AND $my == null AND $mm == null AND $md == null){
			$sqlmet = "SELECT manage_id FROM info_a WHERE user_id = $ID";
		}
		//出会った年月日で検索して該当した管理情報のmanage_idをmet_MIの配列に格納
		$msql = $dbh -> query($sqlmet) -> fetchALL(PDO::FETCH_ASSOC);
		foreach($msql as $met){
			//echo $met['manage_id']. ':'.$met['surname'];
			$met_MI[] = $met['manage_id'];
		}
		//var_dump($met_MI);

		//年齢の検索
		$ageu = $_POST['ageu'];//ageunder
		$ageo = $_POST['ageo'];//ageover
		/*
		年齢を計算するためにmanage_idとその管理情報の生年月日を取得する
		年齢計算するために年を4桁、月を2桁、日を2桁にする必要があるため月日で一桁の値だった場合2桁にする
		*/
		$sqlage = "SELECT manage_id, birth_year, birth_month, birth_day FROM info_a WHERE user_id = $ID";
		$asql = $dbh -> query($sqlage) -> fetchALL(PDO::FETCH_ASSOC);
		foreach($asql as $age){
			if($age['birth_month'] < 10){
				$age['birth_month'] = '0'. $age['birth_month'];
			}
			if($age['birth_day'] < 10) {
				$age['birth_day'] = '0'. $age['birth_day'];
			}
			//生年月日をつなげる
			$birthday = $age['birth_year'] .$age['birth_month'] .$age['birth_day'];
			//現在の日付 
	  		$now = date("Ymd");
			//echo $age['manage_id'].':'.$birthday .':' .floor(($now-$birthday)/10000).'歳';
			//現在の日付から生年月日を引いて10000で割ることで年齢の計算を行っている
			$sai = floor(($now-$birthday)/10000);
			//年齢とmanage_idを関連付けさせる
			$amanage = $age['manage_id'];
			//□歳~□歳の両方を入力されていて、その年齢内の管理情報のmanage_idをage_MIの配列に格納
			if($ageu == !null AND $ageo == !null AND $ageu <= $sai AND $sai <= $ageo){
				$age_MI[] = $amanage;
				//echo $age['manage_id'].':';
			//□歳~が入力されていて、それに該当する管理情報のmanage_idをage_MIの配列に格納
			}else if($ageu == !null AND $ageo == null AND $ageu <= $sai){
				$age_MI[] = $amanage;
				//echo $age['manage_id'].':';
			//~□歳が入力されていて、それに該当する管理情報のmanage_idをage_MIの配列に格納
			}else if($ageu == null AND $ageo == !null AND $sai <= $ageo){
				$age_MI[] = $amanage;
				//echo $age['manage_id'].':';
			//年齢検索がされていない場合、すべての管理情報のmanage_idをage_MIの配列に格納
			} else if($ageu == null AND $ageo == null){
				$age_MI[] = $amanage;
				//echo $age['manage_id'].':';
			}
		}
		//var_dump($age_MI);
		
		//誕生日の検索
		//入力されていないときにはnull値を入れる
		$byu = $_POST['byu'];
		$bmu = $_POST['bmu'];
		if(isset($_POST['bdu'])){
			$bdu = $_POST['bdu'];
		} else {
			$bdu = null;
		}
		$by  = $_POST['by'];
		$bm  = $_POST['bm'];
		if(isset($_POST['bd'])){
			$bd = $_POST['bd'];
		} else {
			$bd = null;
		}
		//すべての生年月日を入力した場合
		if($byu == !null AND $bmu == !null AND $bdu == !null AND $by == !null AND $bm == !null AND $bd == !null) {
			$sqlbirth = "SELECT manage_id, surname FROM info_a WHERE (($byu < birth_year AND birth_year < $by) 
																			OR (birth_year = $byu AND $bmu < birth_month)
																			OR (birth_year = $byu AND $bmu = birth_month AND birth_day >= $bdu) 
																			OR (birth_year = $by AND birth_month < $bm)
																			OR (birth_year = $by AND birth_month = $bm AND birth_day <= $bd)
																			) AND user_id = $ID";
		} else if($byu == null AND $bmu == !null AND $bdu == null AND $by == null AND $bm == !null AND $bd == null) {
			//生まれた月だけを入力した場合
			$sqlbirth = "SELECT manage_id, surname FROM info_a WHERE (($bmu < birth_month AND birth_month < $bm)
																			OR (birth_month = $bmu AND 1 <= birth_day)
																			OR (birth_month = $bm AND birth_day <= 30)
																			) AND user_id = $ID";
		} else if($byu == !null AND $bmu == !null AND $bdu == null AND $by == !null AND $bm == !null AND $bd == null){
			//生まれた年と月を入力した場合
			$sqlbirth = "SELECT manage_id, surname FROM info_a WHERE (($byu < birth_year AND birth_year < $by)
																			OR (birth_year = $byu AND 1 <= birth_month)
																			OR (birth_year = $by AND birth_month <= 12)
																			) AND user_id = $ID";
		} else if($byu == null AND $bmu == null AND $bdu == null AND $by == null AND $bm == null AND $bd == null){
			//すべて入力しなかった場合
			$sqlbirth = "SELECT manage_id, surname FROM info_a WHERE user_id = $ID";
		}
		//誕生日検索結果から得られた管理情報のmanage_idをbirth_MIの配列に格納
		$bsql = $dbh -> query($sqlbirth) -> fetchALL(PDO::FETCH_ASSOC);
		foreach($bsql as $birth){
			//echo ':'.$birth['manage_id']. ':'.$birth['surname'];
			$birth_MI[] = $birth['manage_id'];
			//$barray = count($birth);
		}
		//var_dump($birth_MI);
		//性別の検索
		//男か女かその他を単体あるいは複数選択したときのgender検索を行う
		if(isset($_POST['male'])){
			if (isset($_POST['female'])){
				if(isset($_POST['other'])){
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE (gender = 'm' OR gender = 'f' OR gender = 'o') AND user_id = $ID";
				} else {
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE (gender = 'm' OR gender = 'f') AND user_id = $ID";
				}
			} else {
				if(isset($_POST['other'])){
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE (gender = 'm' OR gender = 'o') AND user_id = $ID";
				} else {
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE gender = 'm' AND user_id = $ID";
				}
			}
		} else {
			if (isset($_POST['female'])){
				if(isset($_POST['other'])){
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE (gender = 'f' OR gender = 'o') AND user_id = $ID";
				} else {
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE gender = 'f' AND user_id = $ID";
				}
			} else {
				if(isset($_POST['other'])){
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE gender = 'o' AND user_id = $ID";
				} else {
					$sqlgender = "SELECT manage_id, gender FROM info_a WHERE user_id = $ID";
				}
			}
		}
		//gender検索した時に該当した管理情報のmanage_idをgender_MIの配列に格納
		$gsql = $dbh -> query($sqlgender) -> fetchALL(PDO::FETCH_ASSOC);
		foreach($gsql as $gender){
			//echo ':'.$gender['manage_id']. ':'.$gender['gender'];
			$gender_MI[] = $gender['manage_id'];
			//$garray = count($gender);
		}
		//var_dump($gender_MI);
		//すべての検索から得られたmanage_idを入れている配列の重複している値のみをSESSIONでSearch_resultに渡す。
		$merge_MI = array_intersect($met_MI, $age_MI, $birth_MI, $gender_MI);

		//var_dump($merge_MI);
		$_SESSION['manage_id'] = $merge_MI;
	}
											
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>左検索部</title>
		<link rel="stylesheet" type="text/css" href="Search.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">	
	<head>
		
	<body>
	<!--アコーディオンの作成-->
		<form action="" method="post" style="margin-bottom:50px;">
			<div class="accbox">
			<!--ラベル１の開始-->
				<input type="checkbox" id="mday" class="cssacc" />
				<label for="mday">出会った日</label>
				<div class="accshow">
				<!--ここに隱す中身-->
					<table>	
						<p>
							<select id="metyear_under" name="myu"><!--<option value="0">--><option value="">----</option></select>年
							<select id="metmonth_under" name="mmu"><!--<option value="0">--><option value="">--</option></select>月
							<select id="metday_under" name="mdu"><!--<option value="0">--><option value="">--</option></select>日~
							<br>
				<!--年月日をfor文で回す-->
							<script type="text/javascript">
								var time = new Date();
								var year = time.getFullYear();
								for (var i = year; i >= 1900; i--) {
								createOptionElements(i,'metyear_under');
								}
								for (var i = 1; i <= 12; i++) {
								createOptionElements(i,'metmonth_under');
								}
								for (var i = 1; i <= 31; i++) {
								createOptionElements(i,'metday_under');
								}
				
								function createOptionElements(num,parentId){
								var doc = document.createElement('option');
								doc.value = doc.innerHTML = num;
								document.getElementById(parentId).appendChild(doc);
								}
								//ここから閏年や30日の判定JS
								window.addEventListener('DOMContentLoaded', function(e){
									[].forEach.call(document.querySelectorAll('#metyear_under,#metmonth_under'),function(x){
										x.addEventListener('change',function(e){
											var myu=document.querySelector('#metyear_under').value;
											var mmu=document.querySelector('#metmonth_under').value;
											if(myu==="" || mmu===""){
												document.querySelector('#metday_under').selectedIndex=0;
												document.querySelector('#metday_under').disabled=true;
											}else{
												var dd=new Date(myu+"-"+mmu+"-1");
												dd.setMonth(dd.getMonth()+1);
												dd.setDate(0);
												[].forEach.call(document.querySelector('#metday_under').options,function(x){
												var flg=x.value!=="" && x.value>dd.getDate();
												x.style.display=flg?"none":"";
											});
											if(document.querySelector('#metday_under').value>dd.getDate()){
												document.querySelector('#metday_under option[value="'+dd.getDate()+'"]').selected=true;
											}
											document.querySelector('#metday_under').disabled=false;
											}
										});
									});
								});
							</script>
						<select id="metyear" name="my"><!--<option value="0">--><option value="">----</option></select>年
						<select id="metmonth" name="mm"><!--<option value="0">--><option value="">--</option></select>月
						<select id="metday" name="md"><!--<option value="0">--><option value="">--</option></select>日
						<script type="text/javascript">
							var time = new Date();
							var year = time.getFullYear();
							for (var i = year; i >= 1900; i--) {
							createOptionElements(i,'metyear');
							}
							for (var i = 1; i <= 12; i++) {
							createOptionElements(i,'metmonth');
							}
							for (var i = 1; i <= 31; i++) {
							createOptionElements(i,'metday');
							}
				
							function createOptionElements(num,parentId){
								var doc = document.createElement('option');
								doc.value = doc.innerHTML = num;
								document.getElementById(parentId).appendChild(doc);
								}
								window.addEventListener('DOMContentLoaded', function(e){
									[].forEach.call(document.querySelectorAll('#metyear,#metmonth'),function(x){
									x.addEventListener('change',function(e){
										var my=document.querySelector('#metyear').value;
										var mm=document.querySelector('#metmonth').value;
										if(my==="" || mm===""){
											document.querySelector('#metday').selectedIndex=0;
											document.querySelector('#metday').disabled=true;
										}else{
											var dd=new Date(my+"-"+mm+"-1");
											dd.setMonth(dd.getMonth()+1);
											dd.setDate(0);
											[].forEach.call(document.querySelector('#metday').options,function(x){
											var flg=x.value!=="" && x.value>dd.getDate();
												x.style.display=flg?"none":"";
											});
											if(document.querySelector('#metday').value>dd.getDate()){
												document.querySelector('#metday option[value="'+dd.getDate()+'"]').selected=true;
											}
											document.querySelector('#metday').disabled=false;
										}
									});
								});
							});
							</script>
						</p>
					</table>
				</div>
			<!--ラベル１の終了-->
			<!--ラベル２の開始-->
			<input type="checkbox" id="age" class="cssacc" />
			<label for="age">年齢　　　</label>
				<div class="accshow">
				<!--ここに隱す中身-->
					<p>
					<input type="number" name="ageu" id="age_under" min="0" max="150" style="width:50px">歳〜
					<input type="number" name="ageo" id="age_over" min="0" max="150" style="width:50px">歳
					</p>
				</div>
			<!--ラベル2の終了-->
			<!--ラベル3の開始-->
			<input type="checkbox" id="bday" class="cssacc" />
			<label for="bday">生年月日　</label>
			<div class="accshow">
				<!--ここに隱す中身-->
				<table>
					<p>
					<select id="birthyear_under" name="byu"><!--option value="0">--><option value="">----</option></select>年
					<select id="birthmonth_under" name="bmu"><!--<option value="0">--><option value="">--</option></select>月
					<select id="birthday_under" name="bdu"><!--<option value="0">--><option value="">--</option></select>日~
					<script type="text/javascript">
						var time = new Date();
						var year = time.getFullYear();
						for (var i = year; i >= 1900; i--) {
						createOptionElements(i,'birthyear_under');
						}
						for (var i = 1; i <= 12; i++) {
						createOptionElements(i,'birthmonth_under');
						}
						for (var i = 1; i <= 31; i++) {
						createOptionElements(i,'birthday_under');
						}
						function createOptionElements(num,parentId){
							var doc = document.createElement('option');
							doc.value = doc.innerHTML = num;
							document.getElementById(parentId).appendChild(doc);
						}
						window.addEventListener('DOMContentLoaded', function(e){
							[].forEach.call(document.querySelectorAll('#birthyear_under,#birthmonth_under'),function(x){
								x.addEventListener('change',function(e){
									var byu=document.querySelector('#birthyear_under').value;
									var bmu=document.querySelector('#birthmonth_under').value;
									if(byu==="" || bmu===""){
										document.querySelector('#birthday_under').selectedIndex=0;
										document.querySelector('#birthday_under').disabled=true;
									}else{
										var dd=new Date(byu+"-"+bmu+"-1");
										dd.setMonth(dd.getMonth()+1);
										dd.setDate(0);
										[].forEach.call(document.querySelector('#birthday_under').options,function(x){
											var flg=x.value!=="" && x.value>dd.getDate();
											x.style.display=flg?"none":"";
										});
										if(document.querySelector('#birthday_under').value>dd.getDate()){
											document.querySelector('#birthday_under option[value="'+dd.getDate()+'"]').selected=true;
										}
										document.querySelector('#birthday_under').disabled=false;
									}
								});
							});
						});
					</script>
				<br>
				<select id="birthyear" name="by"><!--<option value="0">--><option value="">----</option></select>年
				<select id="birthmonth" name="bm"><!--<option value="0">--><option value="">--</option></select>月
				<select id="birthday" name="bd"><!--<option value="0">--><option value="">--</option></select>日
					<script type="text/javascript">
						var time = new Date();
						var year = time.getFullYear();
						for (var i = year; i >= 1900; i--) {
							createOptionElements(i,'birthyear');
						}
						for (var i = 1; i <= 12; i++) {
							createOptionElements(i,'birthmonth');
						}
						for (var i = 1; i <= 31; i++) {
							createOptionElements(i,'birthday');
						}
						function createOptionElements(num,parentId){
							var doc = document.createElement('option');
							doc.value = doc.innerHTML = num;
							document.getElementById(parentId).appendChild(doc);
						}
						window.addEventListener('DOMContentLoaded', function(e){
							[].forEach.call(document.querySelectorAll('#birthyear,#birthmonth'),function(x){
								x.addEventListener('change',function(e){
									var by=document.querySelector('#birthyear').value;
									var bm=document.querySelector('#birthmonth').value;
									if(by==="" || bm===""){
										document.querySelector('#birthday').selectedIndex=0;
										document.querySelector('#birthday').disabled=true;
									}else{
										var dd=new Date(by+"-"+bm+"-1");
										dd.setMonth(dd.getMonth()+1);
										dd.setDate(0);
										[].forEach.call(document.querySelector('#birthday').options,function(x){
											var flg=x.value!=="" && x.value>dd.getDate();
											x.style.display=flg?"none":"";
										});
										if(document.querySelector('#birthday').value>dd.getDate()){
											document.querySelector('#birthday option[value="'+dd.getDate()+'"]').selected=true;
										}
										document.querySelector('#birthday').disabled=false;
									}
								});
							});
						});
						</script>
					</p>
				</table>

			</div>
			<!--ラベル3の終了-->
			<!--ラベル4の開始-->
			<input type="checkbox" id="blood" class="cssacc" />
			<label for="blood">性別　　　</label>
				<div class="accshow">
				<!--ここに隱す中身-->
					<p>
						<input type="checkbox" id="male" name="male" value="m">男　　
						<input type="checkbox" id="female" name="female" value="f">女　　
						<input type="checkbox" id="other" name="other" value="o">その他
					</p>
				</div>
			<!--ラベル4の終了-->
				<div class="search">
			<!--<a id="lsearch" href="Main.html" target="frame3" name="search_start">検索-->
					<input type = "submit" href="Search_result.php" target="frame3" value = "検索" id = "lsearch" name = "search_start">
				</div>
			</div>
		</form>
	</body>
</html>