## 91porn

官方封堵+国内浏览器劫持，建议用梯子搭配chrome浏览器效果最佳。

因官方封堵，源码GG了，会提示获取不到地址。请持续关注演示地址，挂了的话可以微博私信或网站留言。

91Porn手机版，完全无广告，无多余信息，突破游客每天只能看10次的限制。


## 原理简介

项目基于PHP,自动获取91视频，并解析真实地址,通过伪装客户端IP，绕过游客10次观看限制

样例地址 ：哈。这里我就不放样例地址了，防止河蟹。


1.直接进入设置可设置访问域名和页码，如果部署至国内服务器，需设置免番地址，国外服务器推荐用原始地址 http://ip/set.php，默认了一个国内可用源。国外服务完全推荐改成原始地址。

<img src="frozenui/img/007452UMly1foya1v9unwj30a40aojri.png"/>

2.点击确认进入列表页，可直接打开http://ip/index.php  

<img src="frozenui/img/007452UMly1foya2fnqbzj30b70hfq6o.png"/>

3.点击进入视频详情页

<img src="https://91.scjtqs.com:8444/frozenui/img/007452UMly1foya3q7nn8j30b60bf763.png"/>

如无法正常播放，直接刷新页面即可。

4.下载视频，视频详情页提供了解析出的真实地址，

## 配置说明

<b>环境要求</b>
<ol>
<li>PHP 5.6 以上</li>
<li>安装了openssl扩展（闲得蛋疼加密了url）</li>
<li>服务器要有访问外网权限</li>
</ol>

如果你的服务器没有翻墙能力，需要用能翻墙的http代理 或者ss的socks5代理服务共享

请在根目录下创建 config.php文件
内容如下
```php
<?php
$proxy="";//代理服务器地址 支持http,socks4,socks5 如果没有请留空
// eg:// http://192.168.0.1:1234,socket5://192.168.0.5:4455;这样的
$key='hello_world';//aes密码
```
