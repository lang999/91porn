<?php
define('ROOT',__DIR__);
require 'functions.php';
$domain =$_COOKIE['91url'];
$md5='file.php?url='.$aes->encrypt($domain.'/js/m.js');
#获取URL
$url=$_REQUEST['url'];
//$url="encyT0d0Zm5OcnRqNEE5ZnNTM0NUMTJHdktXRXliWTBDbTNQU25ycVl3TE9HdEtEOjqkJq2sY6f0XavEaEhh07Ym";
if(!$url){
    httpStatus(404);
}
//var_dump($url);exit;
if(!$url){
    httpStatus(403);
}
$file=new \lib\cache\driver\File();
$data=$file->get($url);
if(!$data){
    $url=$aes->decrypt(urldecode($url));
    if(!strstr($url,'http')){
        httpStatus(404);
    }
    $data=getVideo($url);
    if(!$data['title']){
        httpStatus(404);
    }
    $file->set($_GET['url'],$data,7200);
}
$video = $data;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Cache" content="no-cache">
        <title><?php echo $video['title']; ?></title>
        <link rel="stylesheet" href="frozenui/css/frozen.css">
        <link rel="stylesheet" href="frozenui/css/demo.css">
    </head>
    <body>
    	<header class="ui-header ui-header-positive ui-border-b">
            <i class="ui-icon-return" onclick="history.back()"></i><a href="index.php" style="position: absolute;left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;列表页</a><h1>视频详情</h1><button onclick="window.location.href='index.php';" class="ui-btn">回首页</button>
        </header>

        <section class="ui-container">
        	<?php if($video['video']){ ?>
        	<div class="ui-tooltips ui-tooltips-guide">
                <div class="ui-tooltips-cnt ui-tooltips-cnt-link ui-border-b">
                    <i class="ui-icon-talk"></i>加载成功，如播放失败刷新页面获取新地址
                </div>
            </div>
            <?php } else{ ?>
            <div class="ui-tooltips ui-tooltips-warn">
                <div class="ui-tooltips-cnt ui-border-b">
                    <i></i>获取失败，请刷新重试
                </div>
            </div>
            
            <?php } ?>

            <p class="demo-desc"><?php echo $video['title']; ?></p>
<!--        	<video width="100%"  controls="controls">-->
<!--        		<source src="--><?php //echo $video['video']; ?><!--" type="video/mp4">-->
<!--        	</video>-->
            <link rel="stylesheet" href="https://cdn.fluidplayer.com/v2/current/fluidplayer.min.css" type="text/css"/>
            <script src="https://cdn.fluidplayer.com/v2/current/fluidplayer.min.js"></script>
            <video id="my-video" controls style="width: 100%">
                <!--source src="" type="video/mp4" /-->
                <script language="JScript" type="text/jscript" src="<?php echo $md5; ?>"></script>
                <?php echo $video['video'] ?>
            </video>
            <script language="JScript" type="text/jscript"  src="//lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
            <div class="demo-block">
                <div class="ui-form ui-border-t">
                    <div class="ui-form-item ui-form-item-link ui-border-b">
                        <a target="_blank" id="videoUrl2" href="">真实地址（长按另存，短按新窗口打开）</a>
                        <?php echo $video['video']; ?>
                    </div>
                    <div class="ui-form-item ui-form-item-r ui-border-b">
                        <input type="text" id="videoUrl" placeholder="真实地址" value="">
                        <!-- 若按钮不可点击则添加 disabled 类 -->
                        <button type="button" data-clipboard-target="#videoUrl" class="copy ui-border-l">复制地址</button>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript" src="https://cdn.bootcss.com/clipboard.js/2.0.0/clipboard.min.js"></script>
        <script>
            new ClipboardJS('.copy');
            $(document).ready(function(){
                var videoUrl=$('source')[0].src;
                console.log(videoUrl);
                $("#videoUrl").val(videoUrl);
                $("#videoUrl2").attr('href',videoUrl);
            });
            function sleep(n) { //n表示的毫秒数
                var start = new Date().getTime();
                while (true) if (new Date().getTime() - start > n) break;
            }
            function showImgDelay(imgObj,imgSrc,maxErrorNum){
                showSpan.innerHTML += "--" + maxErrorNum;
                if(maxErrorNum>0){
                    imgObj.onerror=function(){
                        showImgDelay(imgObj,imgSrc,maxErrorNum-1);
                    };
                    setTimeout(function(){
                        imgObj.src=imgSrc;
                    },500);
                }
            }
            $("p.vjs-no-js").remove();
        </script>
        <span id="showSpan" style="display:none"></span>
    </body>
</html>
