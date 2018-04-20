<?php
/*
连接数据库类
 */ 

	class db{
		/*一个类construct方法，这里注意的是前面是双下划线，而且construct这个方法是自动执行*/		
		function __construct(){
			/*连接数据库语句*/
			$this->mysqli=new mysqli('localhost','root','','blog');
			/*如果连接出现错误怎么办*/
			if ($this->mysqli->connect_error) {
	    		die('Connect Error (' . $this->mysqli->connect_errno . ') '
	            		. $this->mysqli->connect_error);
			}
			/*处理数据库传来的汉子乱码的问题*/
			$this->query("SET NAMES UTF8");
		}

		/*一个类query方法*/
		function query( $sql ){
			/*在query类方法里执行数据库语句query*/
			return $this->mysqli->query( $sql );
		}

	}	
