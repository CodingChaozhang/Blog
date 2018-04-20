<?php
	/*后台除去管理员登录界面，均需加载这个文件，来验证该页面管理员是否登录*/ 
	include('check.php');
	/*将文件上传到服务器的目录里*/
	$key='file1';
	$dir='../upfiles/';
	if(isset($_FILES[$key])){
		$file=$_FILES[$key];
		if($file['error']==0){
			/*文件所处服务器的目录*/
			$pathName=$dir . $file['name'];
			/*文件所在服务器的网址*/
			$urlName='http://blog.com/blog/upfiles' . $file['name'];
			$is=move_uploaded_file($file['tmp_name'], $pathName);
			/*判断是否移动成功*/
			if(!$is){
				die("上传失败");
			}
			/*编辑器来判断是否成功上传图片*/
			$json=array(
				'success' => true,
				'msg'     => '',
				'file_path'=>$urlName
				);
			echo json_encode($json);
		}
	}
?>