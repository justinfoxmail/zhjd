<?php
return array(

	    //数据库配置信息
    'DB_TYPE'    => 'mysql', // 数据库类型
    'DB_HOST'    => '127.0.0.1', // 服务器地址
    'DB_NAME'    => 'ma', // 数据库名
    'DB_USER'    => 'mobile_xy_zhbit', // 用户名
    'DB_PWD'     => 'mobile_xy_zhbit2014', // 密码
    'DB_PORT'    => 3306, // 端口
    'DB_PREFIX'  => 'ma_', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 字符集
    'DB_BACKUP'  => './Data/Backup/',

    'DEFAULT_THEME'    =>    'default',  // 模板主题

        // 配置邮件发送服务器
   'MAIL_HOST' =>'smtp.exmail.qq.com',
   'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
   'MAIL_USERNAME' =>'767110505@qq.com',
   'MAIL_FROM' =>'767110505@qq.com',
   'MAIL_FROMNAME' =>'HackerZ',
   'MAIL_PASSWORD' =>'zhbit123',
   'MAIL_CHARSET' =>'utf-8',
   'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

    'TMPL_PARSE_STRING' =>array(
		'__PUBLIC__'  => __ROOT__.'/Public',
		'__HJS__'     => __ROOT__.'/Public/Home/js',
		'__HCSS__'    => __ROOT__.'/Public/Home/css',
		'__HIMG__'    => __ROOT__.'/Public/Home/images',
		'__AJS__'     => __ROOT__.'/Public/Admin/js',
		'__ACSS__'    => __ROOT__.'/Public/Admin/css',
		'__AIMG__'    => __ROOT__.'/Public/Admin/image',
        '__UPLOADS__' => __ROOT__.'/Uploads',
	),
);
?>