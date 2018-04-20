<?php
/*
	后台博客管理界面
 */ 
	/*后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录*/
	include('check.php');

	/*删除功能*/
	if($input->get('do')=='delete'){
		/*先获取pid*/
		$pid=$input->get('pid');
		
		$sql="delete from admin where pid='{$pid}' ";
		$is=$db->query($sql);
		if($is){
			header("location:blog.php");
		}else{
			die("删除失败");
		}
	}

	/*从数据库setting中读取pagenum来定义一个分页的显示博客数量*/
	$pageNum=$setting['pagenum'];

	/*获取数据库博客的数据总量*/
	$sql="select count(*) AS total from page";
	$total=$db->query($sql)->fetch_array(MYSQLI_ASSOC)['total'];
	/*分页的页码总数*/
	$maxPage=ceil($total/$pageNum);
	

	/*获得当前page的参数*/
	$page=(int)$input->get('page');
	$page=$page <1 ? 1 : $page;
	
	
	/*当前页码的偏移量*/
	$offset=($page -1)*$pageNum;

	/*取出当前数据库列表中的信息并为实现分页效果*/
	$sql="select * from page order by pid desc limit {$offset},{$pageNum}";
	$result=$db->query($sql);


	$rows=array();
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$rows[]=$row;
	}

?>
<!--后台博客管理的界面<>/!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>博客管理</title>
	<?php include(PATH . '/header.inc.php');?>
</head>
<body>
	<?php include('nav.inc.php');?>
	<div class="container">
	<h2> 博客管理 <small class="pull-right"><a class='btn btn-default' href="blog_add.php">添加博客</a></small></h2>
	<hr/>
		<div class="rows">
		
			<table class="table table-striped">
			
		      <thead>
		        <tr>
		          <th>PID</th>
		          <th>标题</th>
		           <th>作者</th>
		          <th>插入时间</th>
		          <th>修改时间</th>
		          <th>管理</th>
		       
		        </tr>
		      </thead>
		      <tbody>
		        <?php foreach($rows as $row) :?>
		        <tr>
		          <td><?php echo $row['pid'];?></td>
		          <td><?php echo $row['title'];?></td>
		          <td><?php echo $row['author'];?></td>
		          <td><?php echo date("Y-m-d H:i:s",$row['intime']);?></td>
		          <td><?php echo date("Y-m-d H:i:s",$row['uptime']);?></td>
		          <td>
		          	<a href="blog_add.php?pid=<?php echo $row['pid'];?> ">修改</a> <!--修改操作传输aid来判断是否是修改操作></!-->
		          	<a onclick='return confirm("你确定要删除吗？")' href="blog.php?do=delete&pid=<?php echo $row['pid'];?> ">删除</a><!--删除操作，传输动作和aid></!-->
		          </td>
		        </tr>
		        <?php endforeach;?>
		      </tbody>
			</table>

				<!--底部的分页效果></!-->	
				<nav aria-label="Page navigation">
				  <ul class="pagination">
				    <li>
				      <a href='#' aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>			    
	
					<?php 
						$hrefTpl = "<li><a href='blog.php?page=%d'>%s</a></li>";
						for ($i=1; $i<=$maxPage; $i++){
							echo sprintf( $hrefTpl,$i,"第{$i}页" );
						}
					?>
					<li>
				      <a href='#' aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>		

		
		</div>
	</div>
</body>
</html>