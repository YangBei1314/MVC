<?php 
namespace Frame;
//定义最终的核心框架类
final class Frame
{
	// 静态的公共的方法
	public static function run()
	{
		self::initCharset();//初始化字符集
		self::initConfig();//获取配置信息
		self::initRoute();//初始化路由参数
		self::initConst();//初始化目录常量
		self::AutoLoad();//类自动加载函数
		self::initDispatch();//初始化分发
	}
	//初始化字符集
	private static function initCharset()
	{
		//设置网页字符集
		header("content-type:text/html;charset=utf-8");
	}
	//初始化配置信息
	private static function initConfig()
	{
		//读取配置信息,并存入全局数组中
		$GLOBALS['config'] = require("./App/Conf/Config.php");
	}
	//初始化路由
	private static function initRoute()
	{
		//判断平台参数是否有数据,若没有数据,使用默认参数
		$p = isset( $_GET['p'] ) ? $_GET['p'] : $GLOBALS['config']['default_platform'];
		$c = isset( $_GET['c'] ) ? $_GET['c'] : $GLOBALS['config']['default_controller'];
		$a = isset( $_GET['a'] ) ? $_GET['a'] : $GLOBALS['config']['default_action'];
		//把平台参数定义为常量
		define('PLATFORM',$p);
		define('CONTROLLER',$c);
		define('ACTION',$a);
	}
	//初始化目录常量
	private static function initConst()
	{
		//目录分隔符
		define('DS',DIRECTORY_SEPARATOR);
		//网站根目录
		define('ROOT',getcwd().DS);
		//视图目录
		define('APP_VIEW',ROOT.'App'.DS.PLATFORM.DS."View".DS.CONTROLLER.DS);
		//Frame目录
		define('FRAME_VIEW',ROOT."Frame".DS);
	}
	//类的自动加载
	private static function AutoLoad()
	{
		//\App\Home\Controller\IndexController
		spl_autoload_register(function($className){
			// 构建文件路径
			$filename = str_replace("\\", DS, $className).".class.php";;
			// 判断文件路径是否存在
			if ( $filename ) require_once($filename);
		});
	}
	//路由分发
	private static function initDispatch()
	{
		//命名空间下类的调用
		$controller = DS.'App'.DS.PLATFORM.DS.'Controller'.DS.CONTROLLER.'Controller';
		// 新建控制器对象
		$controllerObj = new $controller;
		$action = ACTION;
		//调用对应控制器的对应方法
		$controllerObj -> $action();
	}
}




 ?>