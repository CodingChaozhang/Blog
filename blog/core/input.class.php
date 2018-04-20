<?php
/*
一个输入类文件
 */ 
	/*输入类input*/
	class input{

		/*类方法get，以get方法获取页面写入的数据*/
		function get($key=false){
			if($key === false){
				return $_GET;
			}
			if(isset($_GET[ $key ])){
				return $_GET[ $key ];
			}else{
				return false;
			}
		}

		/*类方法post，以post方法获取页面写入的数据*/
		function post($key=false){
			if($key === false){
				return $_POST;
			}
			if(isset($_POST[ $key ])){
				return $_POST[ $key ];
			}else{
				return false;
			}
		}

		/*类方法session，目的是为了验证session是否传入数据*/
		function session($key=false){
			if($key === false){
				return $_SESSION;
			}
			if(isset($_SESSION[ $key ])){
				return $_SESSION[ $key ];
			}else{
				return false;
			}
		}

	}
?>