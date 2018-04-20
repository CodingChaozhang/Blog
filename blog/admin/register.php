<?php
	/*包含一个配置文件*/
	include('../config.php');
	
	if($input->get('do')=='check'){
		/*获取用户页面注册传来的用户名和密码数据*/
		$ausername=$input->post('ausername');
		$apassword=$input->post('apassword');
		$aconfirmpassword=$input->post('aconfirmpassword');
		/*注册时的处理*/
		if($apassword!=$aconfirmpassword){
			echo "前后两次输入的密码不一致";
			exit;
		}
		/*将用户填入的数据插入到数据库的sql语句*/
		$sql="INSERT INTO admin(`ausername`,`apassword`) values('$ausername','$apassword')";
		/*提交sql语句到数据库处理*/
		$is=$db->query($sql);
		/*判断是否注册成功*/
		if($is){
			echo "注册成功";
			header("Location:login.php");
		}else{
			echo "注册失败";
		}
	}


?>



<!--后台管理员登录界面></!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>管理员注册界面</title>
	<!--加载包含bootstrap里css和javascript里的文件></!-->
	<?php include(PATH . '/header.inc.php');?>
	
</head>
<body>
	<!--最外面的container容器></!-->
	<div class="container">
		<!--bootstrap使用时建议使用一个row表格类，包含12个列></!-->
		<div class="row" style="margin-top:200px;">
			<!--距左边3个列></!-->
			<div class="col-md-3"></div>
			<!--中间部分占据6列></!-->
			<div class="col-md-6" ">
			 
			    <div class="panel panel-primary">
			    	<!--注册头部分></!-->
			  		<div class="panel-heading">管理员注册</div>
			  		<!--注册的身体部分></!-->
			  		<div class="panel-body">
			    		
			    		<form  class="form-horizontal" action="register.php?do=check" method="post">
							<!--注册的用户名那一行></!-->
							<div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="ausername" id="ausername" placeholder="请输入用户名">
						    </div>
						    </div>
							
							<!--注册的密码那一行></!-->
						    <div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">密码</label>
						    <div class="col-sm-10">
						      	<input type="password" class="form-control" name="apassword" id="apassword" placeholder="请输入密码">
						    </div>
						    </div>
						    <!--注册的密码确定那一行></!-->
						    <div class="form-group">
						    	<label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
						    <div class="col-sm-10">
						      	<input type="password" class="form-control" name="aconfirmpassword" id="aconfirmpassword" placeholder="请再次输入密码">
						    </div>
						    </div>
							
							<!--提交注册那一行></!-->
						    <div class="form-group">
						    <div class="col-sm-4"></div>
						    <div class="col-sm-6">
						      	<input type="submit" value="注册" class='btn btn-primary btn-lg btn-block'>
						    </div>
						    </div>
			    		</form>

						

					</div>
					 <!--登录的尾部分></!-->
			  		 <div class="panel-footer text-right">版权所有，盗版必究</div>
			    </div>
			
			</div>
			<!--距离右边三列></!-->
			<div class="col-md-3"></div>
		</div>
	</div>
	<!--窗口背景的script加载></!-->
	<script type="text/javascript">
		window.onload = function() {
			var config = {
				vx : 4,
				vy : 4,
				height : 2,
				width : 2,
				count : 100,
				color : "121, 162, 185",
				stroke : "100, 200, 180",
				dist : 6000,
				e_dist : 20000,
				max_conn : 10
			}
			CanvasParticle(config);
		}
	</script>
	<script type="text/javascript" src="../theme/js/canvas-particle.js"></script>
	</script>
</body>
</html>