<?php
/*
管理员添加操作和修改操作的php控制端
 */ 	
	/*后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录*/
	include ('check.php');
	/*取出传来的aid从而判断是添加还是修改操作*/
	$aid=$input->get('aid');
	/*初始化auser，为了区别添加还是修改操作*/
	$auser=array(
			'ausername' => '',
			'apassword' => ''
		);
	/*如果aid大于0，可以得出并不是添加操作，而是修改操作*/
	if($aid>0){
		$sql="select * from admin where aid='{$aid}' ";
		$res=$db->query($sql);
		$auser=$res->fetch_array(MYSQLI_ASSOC);
	}


	/*对于添加操作操作而言，账户或密码不能为空*/
	if($input->get('do')=='add'){
		$ausername=$input->post('ausername');
		$apassword=$input->post('apassword');
		if(empty($ausername)||empty($apassword)){
			die("账户或密码为空");
		}
		/*检查用户名是否重复，这里注意，后面的and是用来判断是否是修改操作，修改操作可以账户重复*/
		$sql="select * from admin where ausername='{$ausername}' and aid <> '{$aid}' ";
		$res=$db->query($sql);
		if($res->fetch_array()){
			die('账户不能重复');
		}
		/*如果aid小于1，则得出是添加操作，否则执行更新操作*/
		if($aid<1){
			$sql="insert into admin (`ausername`,`apassword`) values('{$ausername}','{$apassword}')";
		}else{
			$sql = "UPDATE admin SET ausername='{$ausername}' , apassword='{$apassword}' where aid='{$aid}' ";
		}
		/*判断是否有结果*/
		$is=$db->query($sql);
		if($is){
			header("location:auser.php");
		}else{
			die("执行失败");
		}
	}
	
?>

<!--管理员添加账户或修改账户的界面<>/!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加管理员</title>
	<?php include(PATH . '/header.inc.php');?>
</head>
<body>
	<?php include('nav.inc.php');?>
	<div class="container">
	<h2> 管理员管理 <small class="pull-right"><a class='btn btn-default' href="auser.php">返回</a></small></h2>
	<hr/>
		<div class="rows">
			<form class="form-horizontal" role="form" action="auser_add.php?do=add&aid=<?php echo $aid;?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">账户</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" name="ausername" placeholder="请输入你要添加的账户" value='<?php echo $auser['ausername'];?>'>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
			    <div class="col-sm-6">
			      <input type="password" class="form-control" name="apassword" placeholder="请输入密码" value='<?php echo $auser['apassword'];?>'>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-6">
			      <button type="submit" class="btn btn-default">提交</button>
			    </div>
			  </div>
			</form>
			
		</div>
	</div>
</body>
</html>