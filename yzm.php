
<?php
header("content-type:text/html;charset=utf-8");
if (empty($_POST['register'])) {
	$rand="获取验证码";
	$zhanghao="";
	$password="";
	$rands=rand(1111,9999);
	if (!empty($_POST['code'])) {
		$rand=$rands;
		$zhanghao=$_POST['text_zc'];
		$password=$_POST['password_zc'];
	}
}
else{
	$yzm=$_POST['yzm'];
	$yzmyzyc=$_POST['yzmyzyc'];
	// $yzmyzyc=$_POST['code'];
	$zhanghao=$_POST['text_zc'];
	$password=$_POST['password_zc'];
	if ($yzm != $yzmyzyc) {
		$rand ="验证码不一样";
	}else
	{
		$rand="验证码通过";

		//写入数据


		$con=mysqli_connect('www.abc.com','root','root');//连接数据库
		if(!$con){
		die('失败');
		}
		mysqli_select_db($con,'login');//选择数据库
		if(isset($_POST['register'])){
		// $name=$_POST['name'];
		$phone=$_POST['text_zc'];
		$password=md5($_POST['password_zc']);
		///echo $password;
		if ($phone != '' && $password != 'd41d8cd98f00b204e9800998ecf8427e222') {
				$sql="select * from user where `phone` ='{$phone}'";
				$data = mysqli_query($con,$sql);
				$datas = mysqli_fetch_array($data);
				if ($datas) {
				echo "已被注册！";
				}
				else{
				$mysqli="insert into user(`id`,`phone`,`password`) values('','{$phone}','{$password}')";
				echo $mysqli;
				$a=mysqli_query($con,$mysqli);//相当于回车
				if ($a) {
				echo "注册成功！";
				}
				else{
				echo "注册失败！";}
				}
		}
}else{
	echo "请输入信息";die;
}


	}
}?>
<article>
		<form action="" method="post">
			<header>注册</header>
			<section>
				<input type="text" name="text_zc" placeholder="账号"
				value="<?php echo $zhanghao ?>">
				<input type="password" name="password_zc" placeholder="密码" value="<?php echo $password ?>"><br>
				<input type="text" name="yzm" placeholder="验证码">
				<input type="hidden" name="yzmyzyc" value="<?php echo $rand ?>">
				<input type="submit" name="code" value="<?php echo $rand ?>">
			</section>
			<footer>
				<input type="submit" name="register" value="注册">
				<a href=""><input type="button" name="signin" value="登陆"></a>
			</footer>
		</form>
	</article>