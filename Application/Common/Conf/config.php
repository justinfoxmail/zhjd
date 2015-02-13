<?php
return array(
	    //数据库配置信息
    'DB_TYPE'    => 'mysql', // 数据库类型
    'DB_HOST'    => '127.0.0.1', // 服务器地址
    'DB_NAME'    => 'thinkphp', // 数据库名
    'DB_USER'    => 'root', // 用户名
    'DB_PWD'     => '', // 密码
    'DB_PORT'    => 3306, // 端口
    'DB_PREFIX'  => 'think_', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 字符集
    'DB_BACKUP'  => './Data/Backup/',

    'DEFAULT_THEME'    =>    'default',  // 模板主题

    'TMPL_PARSE_STRING' =>array(
		'__PUBLIC__' => '/Public',
		'__JS__'     => '/Public/js',
		'__CSS__'    => '/Public/css',
		'__IMG__'    => '/Public/images',
        '__UPLOADS__'=> '/Uploads',
        '__DATA__'=> '/Data',
	),

    'config' => array(
            'path' => '/Data/Backup/',                                           //备份文件存在哪里
            'isCompress' => 0,                                                  //是否开启gzip压缩      【未测试】
            'isDownload' => 0                                                   //备份完成后是否下载文件 【未测试】
        ),                                                        //相关配置
    'model' => '',                                                        //实例化一个model
    'content' => '',                                                            //内容
    'dbName' => '',                                                        //数据库名
    'dir_sep' => '/',                                                       //路径符号

);
?>