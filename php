var_dump() 


create database gms default character set utf8;

dump($array, true, '<pre>', 0)// true:输出 0:print_r

将默认__PUBLIC__路径改为项目目录下都Tpl/Public
'TMPL_PARSE_STRING' => array(
    '__PUBLIC__' => __ROOT__.'/'.APP_NAME.'Tpl/Public'
)

应用分组部署：相当于只创建一个应用，在应用的各个模块进行分组
1.创建单入口
2.添加配置
  // 开启分组
  'APP_GROUP_LIST' => 'Index, Admin',
  // 默认分组
  'DEFAULT_GROUP' => 'Index',
  
公用函数文件名为common.php, 项目(前台，后台)函数文件名为function.php
App
|-Common
  |-common.php
  |-Index
    |-function.php
  |-Admin
    |-function.php
|-Action
  |-Index 
    |-IndexAction.php
  |-Admin
    |-IndexAction.php
|-Config
  |-config.php
  |-Index
    |-config.php
  |-Admin
    |-config.php
    
  
    
  
