<?php 
/**
 * 单一入口文件下的MVC框架
 */
//网页字符集
header("content-type:text/html;charset=utf-8");
//引入核心框架类文件
require("./Frame/Frame.class.php");
//调用核心框架类的run方法
\Frame\Frame::run();

 ?>