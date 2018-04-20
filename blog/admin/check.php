<?php 
/*
后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录
 */
	/*启动sesssion*/
	session_start();
	/*包含一个配置文件*/
	include('../config.php');
 
 	$session_aid=$input->session('aid');

	/*调用input输入类的session方法，来验证管理员账户是否已登录*/
	if($session_aid === false){
		/*返回login.php文件*/
		header("location:login.php");
	}

	/*取出登录成功的用户名*/
	$sql="select * from admin where aid='{$session_aid}'";
	$session_auser_result=$db->query($sql);
	$session_user=$session_auser_result->fetch_array( MYSQLI_ASSOC );

?>