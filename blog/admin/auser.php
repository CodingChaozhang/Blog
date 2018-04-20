<?php
/*
管理员管理的php控制端
 */ 	
	/*后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录*/
	include ('check.php');

	
	/*删除功能*/
	if($input->get('do')=='delete'){
		$aid=$input->get('aid');
		if($aid==$session_aid){
			die("该用户正处于登录状态，不能删除");
		}
		$sql="delete from admin where aid='{$aid}' ";
		$is=$db->query($sql);
		if($is){
			header("location:auser.php");
		}else{
			die("删除失败");
		}
	}

	/*取出当前数据库列表中的信息*/
	$sql="select * from admin";
	$result=$db->query($sql);
	$rows=array();
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$rows[]=$row;
	}
	
?>

<!--管理员管理的界面<>/!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>管理员管理</title>
	<?php include(PATH . '/header.inc.php');?>
</head>
<body>
	<?php include('nav.inc.php');?>
	<div class="container">
	<h2> 管理员管理 <small class="pull-right"><a class='btn btn-default' href="auser_add.php">添加管理员</a></small></h2>
	<hr/>
		<div class="rows">
		
			<table class="table table-striped">
			
		      <thead>
		        <tr>
		          <th>ID</th>
		          <th>用户名</th>
		          <th>管理</th>
		       
		        </tr>
		      </thead>
		      <tbody>
		        <?php foreach($rows as $row) :?>
		        <tr>
		          <td><?php echo $row['aid'];?></td>
		          <td><?php echo $row['ausername'];?></td>
		          <td>
		          	<a href="auser_add.php?aid=<?php echo $row['aid'];?> ">修改</a> <!--修改操作传输aid来判断是否是修改操作></!-->
		          	<a onclick='return confirm("你确定要删除吗？")' href="auser.php?do=delete&aid=<?php echo $row['aid'];?> ">删除</a><!--删除操作，传输动作和aid></!-->
		          </td>
		        </tr>
		        <?php endforeach;?>
		      </tbody>
		    
			</table>	
			
		</div>
	</div>
</body>
</html>