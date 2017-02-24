<?php

function is_SSL() {
    if (!isset($_SERVER['HTTPS']))
        return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache  
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS  
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他  
        return TRUE;
    }
    return FALSE;
}

/* * 通用设置 */
date_default_timezone_set("Asia/Shanghai");
error_reporting(0);
// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/* * 数据库名称 */
define('DB_NAME', 'auth');

/** MySQL 数据库用户名 */
define('DB_USER', 'root');

/** MySQL 数据库密码 */
define('DB_PASSWORD', '12345678');

/** MySQL 主机 */
define('DB_HOST', 'localhost');

/** MySQL 主机端口 */
define('DB_PORT', '3306');

//过期COOKIE清除SQL指令:
//DELETE FROM `cookiedata` WHERE unix_timestamp(`login_time`) < unix_timestamp('2017-01-24 00:00:00')

/** 每个用户最多的安全令数量  * */
define('MOST_AUTH', 3);
define('MOST_AUTH_DONATED', 20);
define('AUTH_HINT_LOGO_XISHU', 1);
define('AUTH_HINT_LOGO_XISHU_DONATED', 2);

// ** 邮件设置 ** //
/* * 邮局地址* */
define('SMTP_HOST', "smtp.qq.com");

/* * 邮局端口* */
define('SMTP_PORT', 465);

/* * 邮件用户名* */
define('SMTP_USERNAME', "10000@qq.com");

/* * 邮件密码* */
define('SMTP_PASSWD', "12345678");

/* * 邮件发件人* */
define('SMTP_FROMNAME', "竹井詩織里(战网安全令在线版)");

//禁止直接include
define('ZHANGXUAN', true);

//是否SSL
/* * 页面地址 */
if (is_SSL()) {
    define('SSLMODE', 1);
    define("SITEHOST", "https://myauth.us/");
    define("SITEHOSTSAFEMODE", "http://myauth.us/");
} else {
    define('SSLMODE', 0);
    define("SITEHOST", "http://myauth.us/");
    define("SITEHOSTSAFEMODE", "https://myauth.us/");
}

define("TITLENAME", "战网安全令在线版");

/* * 微博分享内容* */
define("SINAKEY", "12345678");
define("TENCENTKEY", "12345678");
define("SOHUKEY", "12345678");
define("NETEASEKEY", "12345678");
define("WEIBOMESSAGE", "战网安全令,魔兽世界,暗黑破坏神,炉石传说,风暴英雄,星际争霸,守望先锋,创建战网安全令,还原战网安全令,台服,美服,欧服,国服,手机安全令,丢失安全令,一键登录,安全令请求,一键安全令");

/** 百度统计ID * */
define("BAIDUTONGJI_ID", "0abf57ffe072b473a0418ad8c368f7d2"); //myauth.us

$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT); //连接数据库

include_once 'function.php';

@mysqli_select_db($dbconnect, DB_NAME);

@queryArray("set names utf8");
@queryArray("set time_zone = '+8:00'");

/**
 * 非对称加密，盐
 * 请自行生产KEY并提取KEY文件生成KEY值
 * * */
define("RSA_SALT", "ShioriTakei");
define("RSA_KEY_ADD", "resources/rsa/yourkey.key");//将key文件放到这里,文件名修改下
define("RSA_KEY", "YourOwnKey");

if (!$dbconnect) {
    include('page_inc/db_error.php');
    die();
}