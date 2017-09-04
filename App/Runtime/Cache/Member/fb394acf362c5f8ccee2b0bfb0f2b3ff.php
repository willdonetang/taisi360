<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
    <title>编辑文章-<?php echo ($vo["title"]); ?></title>
    <meta property="og:description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../Public/Css/bootstrap.min.css" rel="stylesheet" media="screen">

    <link href="../Public/Css/style.css" rel="stylesheet" media="screen">
    <script src="../Public/Js/jquery.js"></script>
    <script src="../Public/Js/bootstrap.min.js"></script>


    <link href="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <link href="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
    <!--[if IE]>
    <link href="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->

    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/speedup.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/jquery-1.7.1.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/jquery.validate.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>

    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/xheditor/xheditor-1.1.14-zh-cn.min.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/uploadify/scripts/swfobject.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>


    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/dwz.min.js" type="text/javascript"></script>
    <script src="__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function(){
            DWZ.init("__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/dwz.frag.xml", {
                //loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
                //loginUrl:"login.html",	// 跳到登录页面
                statusCode:{ ok:200, error:300, timeout:301}, //【可选】
                pageInfo:{ pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
                debug:false,	// 调试模式 【true|false】
                callback:function(){
                    initEnv();
                    $("#themeList").theme({ themeBase:"__ROOT__/App/Modules/Admin/Tpl/default/Public/dwz/themes"}); // themeBase 相对于index页面的主题base路径
                }
            });
        });

    </script>
<body id="body">
<header>
    <!-- 导航开始 -->
    <nav id="navbar" class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h1 class="site-title">
                    <a class="navbar-brand logo" href="<?php echo U('/index/');?>">
                        <img class="logo-img" src="__ROOT__/App/Modules/Index/Tpl/default/Public/Images/logo1.png" alt="<?php echo R('Siteinfo/info',array('title'),'Widget');?>"/>
                        <span class="hide"><?php echo R('Siteinfo/info',array('title'),'Widget');?></span>
                    </a>
                </h1>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if(($_GET['catsid']== null) AND ($article['tid'] == null)): ?>class="active"<?php endif; ?>><a href="<?php echo U('/index/');?>">首页</a></li>
                    <?php if(is_array($cats)): foreach($cats as $key=>$cats): ?><li <?php if(($_GET['catsid']== $cats['id']) OR ($article['tid'] == $cats['id'])): ?>class="active"<?php endif; ?>><a href="<?php echo U('/category/'.$cats['id']);?>"><?php echo ($cats["name"]); ?></a></li><?php endforeach; endif; ?>
                </ul>
                <form class="navbar-form navbar-left" role="search" method="post" id="searchform" action="<?php echo U('Index/Search/index');?>">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="输入关键词搜索" name="s" id="s">
                    </div>
                    <button type="submit" class="btn btn-default" id="searchsubmit"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <ul class="nav navbar-nav navbar-right header-nav-right" id="user">

                    <script>
                        $(function(){
                            $.get("<?php echo U('Index/Article/checkuser');?>",function(data) {
                                $('#user').html(data);
                            });
                        })
                    </script>

                </ul>
            </div>
        </div>
    </nav>
    <!-- 导航结束 -->
</header>
<div class="container">
<div class="pageContent">
    <?php if(!$vo){ ?>
        <h2>文章不存在或你没有权限编辑</h2>
    <?php }else { ?>
    <form method="post" action="__URL__/update/navTabId/listarticle/callbackType/closeCurrent"  class="pageForm required-validate"
          onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
        <input type="hidden" name="article_id" value="<?php echo ($vo["article_id"]); ?>"/>
        <div class="pageFormContent" layoutH="60">
            <dl>
                <dt>文章分类：</dt>
                <dd><?php echo ($vo["name"]); ?></dd>
            </dl>
            <dl>
                <dt>文章标题：</dt>
                <dd><input type="text" class="required"  style="width:100%" name="title" value="<?php echo ($vo["title"]); ?>"/></dd>
            </dl>
            <dl>
                <dt>关键词：</dt>
                <dd><input type="text" class="required"  style="width:100%" name="keyword"  value="<?php echo ($vo["keyword"]); ?>"/></dd>
            </dl>

            <dl>
                <dt>是否首页推荐：</dt>
                <dd>
                    <input type="radio" name="ispush" value="1" <?php if($vo["ispush"] == 1): ?>checked<?php endif; ?>/>推荐
                    <input type="radio" name="ispush" value="0" <?php if($vo["ispush"] == 0): ?>checked<?php endif; ?>/>不推荐
                </dd>
            </dl>
            <dl>
                <dt>是否允许评论：</dt>
                <dd>
                    <input type="radio" name="iscommend" value="1" <?php if($vo["iscommend"] == 1): ?>checked<?php endif; ?>/>允许
                    <input type="radio" name="iscommend" value="0" <?php if($vo["iscommend"] == 0): ?>checked<?php endif; ?>/>不允许
                </dd>
            </dl>
            <dl>
                <dt>是否首页幻灯：</dt>
                <dd>
                    <input type="radio" name="isslides" value="1" <?php if($vo["isslides"] == 1): ?>checked<?php endif; ?>/>是
                    <input type="radio" name="isslides" value="0" <?php if($vo["isslides"] == 0): ?>checked<?php endif; ?>/>否
                </dd>
            </dl>
            <dl>
                <dt>是否加入回收站：</dt>
                <dd>
                    <input type="radio" name="islock" value="1" <?php if($vo["islock"] == 1): ?>checked<?php endif; ?>/>是
                    <input type="radio" name="islock" value="0"  <?php if($vo["islock"] == 0): ?>checked<?php endif; ?>/>否
                </dd>
            </dl>
            <dl class="nowrap">
                <dt>摘要：</dt>
                <dd><textarea class="required"  style="width:100%" name="summary"><?php echo ($vo["summary"]); ?></textarea></dd>
            </dl>
            <dl  class="nowrap">
                <dt>文章内容：</dt>
                <dd>
                    <textarea id="elm1" name="content"  style="width:100%;display: none;" rows="20"  ><?php echo ($vo["content"]); ?>
                    </textarea>
                    <script>
                        $('#elm1').xheditor({upLinkUrl:"__URL__/upload",upLinkExt:"zip,rar,txt",upImgUrl:"__URL__/upload",upImgExt:"jpg,jpeg,gif,png",upFlashUrl:"__URL__/upload",upFlashExt:"swf",upMediaUrl:"__URL__/upload",upMediaExt:"avi",urlBase:'__ROOT__/'});
                    </script>
                </dd>
            </dl>
        </div>

        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
    <?php } ?>
</div>
</div>

</body>
<footer id="footer">
    <div class="col-lg-12 col-md-12">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-footer"> <span class="text-muted pull-left">  <?php echo R('Index/Siteinfo/info',array('copyright'),'Widget');?>  </span> <span class="text-muted pull-right"> 源自 <?php echo R('Index/Siteinfo/info',array('title'),'Widget');?></span>
                    <div class="clean"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>