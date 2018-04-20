<?php
	/*后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录*/ 
	include ('check.php');
	/*取出传来的pid从而判断是添加还是修改操作*/
	$pid=$input->get('pid');
	/*初始化page，为了区别添加还是修改操作*/
	$page=array(
			'title'   => '',
			'author'  => '',
			'content' => '',
		);
	/*如果pid大于0，可以得出并不是添加操作，而是修改操作*/
	 if($pid>0){
	 	$sql="select * from page where pid ='{$pid}' ";
	 	$res=$db->query($sql);
	 	$page=$res->fetch_array(MYSQLI_ASSOC);
	 }



	 /*对于添加操作操作而言，账户或密码不能为空*/
	if($input->get('do')=='add'){
		$title=$input->post('title');
		$author=$input->post('author');
		$content=$input->post('content');
		if(empty($title)||empty($author)||empty($content)){
			echo("数据不能为空");
		}
		/*如果aid大于1，则得出更新操作，否则执行添加操作*/
		if($pid>0){
			$uptime=time();
			$sqlTpl="UPDATE page set title='%s',author='%s',content='%s',uptime='%d' where pid='%d' ";
			$sql=sprintf($sqlTpl,$title,$author,$content,$uptime,$pid);
		}
		else{
			$intime=time();
			$sqlTpl="INSERT INTO page(`title`,`author`,`content`,`intime`,`uptime`) values('%s','%s','%s','%d','%d')";
			$sql=sprintf($sqlTpl,$title,$author,$content,$intime,0);
			
		}			
		/*判断是否有结果*/
		$is=$db->query($sql);
		if($is){
			header("location:blog.php");
		}else{
			echo "执行失败";
		}
	}
?>

<!--管理员添加博客或修改博客的界面<>/!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加博客</title>
	<?php include(PATH . '/header.inc.php');?>

	<!--加载simiditor编辑器的文件></!-->
	<link rel="stylesheet" type="text/css" href="../theme/simditor/styles/simditor.css" />
	<script type="text/javascript" src="../theme/simditor/scripts/module.js"></script>
	<script type="text/javascript" src="../theme/simditor/scripts/hotkeys.js"></script>
	<script type="text/javascript" src="../theme/simditor/scripts/uploader.js"></script>
	<script type="text/javascript" src="../theme/simditor/scripts/simditor.js"></script>

</head>
<body>
	<?php include('nav.inc.php');?>
	<div class="container">
	<h2> 博客管理 <small class="pull-right"><a class='btn btn-default' href="blog.php">返回</a></small></h2>
	<hr/>
		<div class="rows">
			<form class="form-horizontal" role="form" action="blog_add.php?do=add&pid=<?php echo $pid;?>" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" name="title" placeholder="请输入标题" value='<?php echo $page['title'];?>'>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" name="author" placeholder="请输入作者" value='<?php echo $page['author'];?>' >
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">正文</label>
			    <div class="col-sm-8">
			     	<textarea id="content" name="content" class="form-control"><?php echo $page['content'];?></textarea>
			     	<!--在script中初始化编辑器,在这里注意script里加载的textarea的ID要与上方textarea的id号一致></!-->
					<script>
						var editor = new Simditor({
						  textarea: $('#content'),
						  upload:{
						  	url:'blog_upload.php',
						  	fileKey:'file1'
						  }
						  //optional options
						});
					</script>			     	
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