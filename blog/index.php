<?php
/*主界面*/ 
	/*基本的配置文件*/
	include('config.php');
	/*从数据库读取最新10条的博客标题和内容*/
	$sql="select *from page order by pid desc limit 0,10";
	$result=$db->query($sql);

	$blogs=array();
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$blogs[]=$row;
	}
 ?>
<!--主界面<>/!-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
	<title><?php echo $setting['title'];?></title>
	<?php include(PATH . '/header.inc.php');?>  <!--所有的页面都需加载这个文件></!-->
</head>
<body>
	<div class='container'>
			<div class="jumbotron">
				<h2><?php echo $setting['title'];?></h2>
				<p><?php echo $setting['intro'];?></p>
			</div>
			<!--导航条></!-->
				<ol class="breadcrumb">
				  <li><a href="index.php">首页</a></li>
				</ol>

			<div class="col-md-3">

				<div class="panel panel-default">
				  <div class="panel-heading" >作者简介：曾国藩</div>
				  <div class="panel-body">
				  	<div style="text-indent:2em;">曾国藩,中国近代政治家、战略家、理学家、文学家，湘军的创立者和统帅。与胡林翼并称“曾胡”，与李鸿章、左宗棠、张之洞并称“晚清中兴四大名臣”,谥号“文正”，后世称“曾文正”。</div>
				  </div>
				</div>

				<div class="panel panel-default">
				  <div class="panel-heading">词条统计</div>
				  <div class="panel-body" >	 
				       浏览次数：9321826次 <br>
				       编辑次数：496次历史版本 <br>
				       最近更新：2017-07-29 <br>	
				       创建者：lcz <br>
				  </div>
				</div>

			</div>

			<div class="col-md-9">
			<?php foreach($blogs as $blog):?>
				<div class="panel panel-default">
				  <div class="panel-heading" style="text-indent:2em;">
				  	
				  	<a href="read.php?pid=<?php echo $blog['pid'];?>"><?php echo $blog['title'];?></a>
				  		
				  </div>
				  <div class="panel-body">
				  	 <?php echo mb_substr(strip_tags($blog['content']),0,80);?> ......
				  </div>
				</div>
			<?php endforeach;?>
            </div>	
	</div>
</body>
</html>