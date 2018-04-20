<?php 
/*
整体配置文件
 */
	/*将当前文件所在的路径赋值于PATH这个变量，这里注意的是FILE前后是双下划线*/
	define("PATH", dirname(__FILE__));

	/*包含数据库连接类这个文件*/
	include(PATH . '/core/db.class.php');
	/*生成一个db的对象*/
	$db = new db();
   
   	/*包含一个输入类一个文件*/
    include(PATH . '/core/input.class.php');
    /*生成一个input对象*/
    $input = new input();

 	/*读取后台管理员的系统配置即每页的显示博客数量、博客标题等信息*/
 	$sql="select * from setting";
	$set_result=$db->query($sql);
	$setting=array();
	while($row=$set_result->fetch_array(MYSQLI_ASSOC)){
		$setting[$row['key']]=$row['val'];
	}

?>