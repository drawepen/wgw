<html>
<head>
	<title>登陆</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/Load_css.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<div class="adcenter"></div>
	<h1 style="position: relative; top:-80px;font-family:'STXingkai';font-size:48px;">
		<img src="images/wgw_logo.png" height="50" width="50"/>&nbsp外挂网</h1>
	<h1 style="position: relative; top:-150px;">登录&注册</h1>
	<div class="container w3layouts agileits" style="position: relative; top:-180px;">
		<div class="login w3layouts agileits send-button">
			<h2>登 录</h2>
			<form action="load.php" method="post" id="loadform">
				<input id="loadname_input" name="load_name" required="" type="text" placeholder="用户名/邮箱/手机号">
				<input id="loadpassword_input" name="load_password" required="" type="password" placeholder="密码">
                <input type="submit" value="登 录" >
			</form>
			<ul class="tick w3layouts agileits">
				<li>
					<input id="brand1" type="checkbox" value="">
					<label for="brand1"><span></span>记住密码</label>
				</li>
			</ul>
			<a href="#" onClick="wjmm()">忘记密码?</a>
			<div class="social-icons w3layouts agileits">
				<p>- 其他方式登录 -</p>
				<ul>
					<li class="qq"><a href="#">
					<span class="icons w3layouts agileits"></span>
					<span class="text w3layouts agileits">QQ</span></a></li>
					<li class="weixin w3ls"><a href="#">
					<span class="icons w3layouts"></span>
					<span class="text w3layouts agileits">微信</span></a></li>
					<li class="weibo aits"><a href="#">
					<span class="icons agileits"></span>
					<span class="text w3layouts agileits">微博</span></a></li>
					<div class="clear"> </div>
				</ul>
			</div>
			<div class="clear"></div>
		</div><div class="copyrights">Collect from <a href="http://www.cssmoban.com/">企业网站模板</a></div>
		<div class="register w3layouts agileits send-button">
			<h2>注 册</h2>
			<form action="load.php" method="post" >
				<input name="Name" required="" type="text" placeholder="用户名">
				<input name="Email" required="" type="text" placeholder="邮箱">
                <input name="Phone Number" required="" type="text" placeholder="手机号码">
				<input name="Password" required="" type="password" placeholder="密码">
				<input name="Passwordqr" required="" type="password" placeholder="确认密码">
                <input type="submit" value="免费注册">
			</form>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
    
</body>
<script src="js/load_js.js" type="text/javascript"></script>
</script>
<?php
if( isset($_POST['load_name'])&&$_POST['load_name']!=""){//登陆
	$Servername="localhost";
	$username="root";
	$password="56789shi";
	$dbname="wgw";
	$conn = new mysqli($Servername, $username, $password,$dbname);
	if ($conn)//连接成功
  	{
		try{
			// mysqli预处理及绑定
			/*$stmt = $conn->prepare("SELECT * FROM user where name=? and password=? ");
			$stmt->bind_param("ss",$name_in,$pasword_in);
			// 设置参数并执行
			$name_in="5D5C8CDF13";//str_to_ascii($_POST['load_name']);
			$password_in="132333";//str_to_ascii($_POST['load_password']);
			$stmt->execute();*/
			// 执行SQL语句
			$sql="SELECT * FROM user where name='".str_to_ascii($_POST['load_name'])."' and password='".str_to_ascii($_POST['load_password'])."'";
			$result = $conn->query($sql);
    		if($result->num_rows > 0){//登陆成功
				//echo "<script>alert('".$_POST['load_name']."'+'登陆成功');</script>";//字符串变量输出字符串纯文字，在alert()中不代表字符串变量，需要加''
				// 发送一个  秒后过期的 cookie
				setcookie("wgwCookie",urlencode($_POST['load_name']), time()+300);//设置cookie//中文cookie会乱码，php写人的内容用urlencode()编码，后自动cookie编码，js获取数据先cookie解码得到url编码，再decodeURI()解码可得不乱码中文
				$urlAd=isset($_GET['ReturnAd'])? $_GET['ReturnAd']:"index.html";
				header("Refresh:0.5;url=".$urlAd);// 会在 秒后执行跳转
			}else{
				echo "<script>alert('用户名或密码错误');</script>";
			}
		}catch(Exception $e) { 
			$stderr = fopen("ErrorFile.txt",'a');
        	fwrite($stderr,$e->getMessage()."\n" );
        	fclose($stderr);
		}
		$conn->close();
	}
}
if(isset($_POST['Name'])&&$_POST['Name']!=""){//注册
	$Servername="localhost";
	$username="root";
	$password="56789shi";
	$dbname="wgw";
	$conn = new mysqli($Servername, $username, $password,$dbname);
	if ($conn)//连接成功
  	{
		try{
			//$conn->beginTransaction();//开启事务,加锁
			// mysqli预处理及绑定
			$stmt = $conn->prepare("SELECT * FROM user where name=?");
			$stmt->bind_param("s", $name);
			// 设置参数并执行
			$name =str_to_ascii($_POST['Name']);
			$stmt->execute();
			//echo "<script>alert('".str_to_ascii($_POST['Name'])."');</script>";//////////////////////////
			// 执行SQL语句
    		$stmt->store_result();
    		if($stmt->num_rows==0){//没有重名
				//查询ids
				$ids=0;
				$sql = "SELECT value_int FROM System_information where name='ids'";//查询
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// 输出数据
					while($row = $result->fetch_assoc()) {
						$ids=$row["value_int"];
					}
				}
				
				//$stmt->close();
				/*$stmt = $conn->prepare("INSERT INTO user (id,name,password,sjh,email,jfs) VALUES (?,?,?,?,?,100)");
				$stmt->bind_param("issss", $inids,$nameu, $namep, $names, $namee);
				// 设置参数并执行
				$inds=$ids+1;
				$nameu =str_to_ascii($_POST['Name']);
				$namep =str_to_ascii($_POST['Password']);
				$names =$_POST['Phone_Number'];
				$namee =$_POST['Email'];
				$stmt->execute();// 执行SQL语句*/////?????mysqli预处理执行插入不报错，但数据库却没有变化！！！！！
				$sql ="INSERT INTO user (id,name,password,sjh,email,jfs) VALUES (".($ids+1).",'".str_to_ascii($_POST['Name'])."','".str_to_ascii($_POST['Password'])."',".$_POST['Phone_Number'].",'".str_to_ascii($_POST['Email'])."',100)";
				$reut=$conn->query($sql);
				
				if($reut==1){
					//注册成功
					$sql ="update System_information  set value_int=".($ids+1)." where name='ids'";//修改ids
					$conn->query($sql);
					echo "<script> var sure=confirm('注册成功，是否登录');if(sure==1) {document.getElementById('loadname_input').value ='";
					echo $_POST['Name'];
					echo "';document.getElementById('loadpassword_input').value='";
					echo $_POST['Password'];
					echo "';document.getElementById('loadform').submit();}</script>";
				}else{
					echo "<script>alert('注册失败，手机号或邮箱格式不对');</script>";
				}
				
			}else{
				echo "<script>alert('用户名已被使用，请重新注册');</script>";
			}
			$stmt->close();
		}catch(Exception $e) { 
			$stderr = fopen("ErrorFile.txt",'a');
        	fwrite($stderr,$e->getMessage()."\n" );
        	fclose($stderr);
		}
		//$conn->rollBack();//回滚,解锁
	}
	
	$conn->close();
}

function str_to_ascii($str){
        $str=mb_convert_encoding($str,'GB2312');
        $change_after="";
        for($i=0;$i<strlen($str);$i++){
            $temp_str=dechex(ord($str[$i]));
            $change_after.=$temp_str[1].$temp_str[0];
        }
        return strtoupper($change_after);
  }
 
function ascii_to_str($sacii){
        $asc_arr= str_split(strtolower($sacii),2);
        $str="";
        for($i=0;$i<count($asc_arr);$i++){
            $str.=chr(hexdec($asc_arr[$i][1].$asc_arr[$i][0]));
        }
        return mb_convert_encoding($str,'UTF-8','GB2312');
    }

?>
</html>