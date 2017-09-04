<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<base href="__ROOT__/" />
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<title><?php echo ($article["title"]); ?>-<?php echo R('Siteinfo/info',array('title'),'Widget');?></title>
<meta name="description" content="<?php echo ($article["summary"]); ?>" />
<meta name="keywords" content="<?php echo ($article["keyword"]); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="../Public/Css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../Public/Css/style.css" rel="stylesheet" media="screen">
<script src="../Public/Js/jquery.js"></script>
<script src="../Public/Js/bootstrap.min.js"></script>
</head>
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
 <!-- 百度统计代码 -->
 <script>
     var _hmt = _hmt || [];
     (function() {
         var hm = document.createElement("script");
         hm.src = "//hm.baidu.com/hm.js?9dffd1f9f52d9d75b50df3c90a4d6dd5";
         var s = document.getElementsByTagName("script")[0];
         s.parentNode.insertBefore(hm, s);
     })();
 </script>

  <!-- 导航结束 --> 
</header>
<div class="container">
  <article itemscope itemtype="http://schema.org/Article">
    <div class="col-lg-8 col-md-8 content">
      <div class="clean"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="pull-left" itemprop="name"><?php echo ($article["title"]); ?></h1>
          <div class="pull-right"> 
          	<!--qr二维码开始-->
          	<div style="float:left;position:relative" id="qr">
          		 <a  class="btn btn-default btn-sm pull-left"> <span class="glyphicon glyphicon-thumbs-up"></span>“扫一扫”二维码分享给朋友</a>&nbsp;&nbsp;
          		<div class="hm" style="margin-top:14px;display:none;position:absolute;z-index:1">
          			<img z-index=999 src="<?php echo U('/index/Article/get_qrcode');?>?content=<?php echo ($qrcode); ?>"/>
          		</div>
          	</div>
          	<script>
          		$(function(){
          			$('#qr').hover(function(){
						$(this).children('.hm').toggle();
					});	
				});
          	</script>
        <!--前台文章标题右侧钩子，position=1开始-->
        <?php if(is_array($plugin1)): foreach($plugin1 as $key=>$plugin1Val): echo R($plugin1Val['method'],$article['article_id'],'Widget'); endforeach; endif; ?>
        <!--前台文章标题右侧钩子，position=1结束-->
           </div>
          <div class="clean"></div>
        </div>
        <div itemprop="articleBody" class="panel-body">
         <?php echo ($article["content"]); ?>
         <div class="join_us_info">
            <?php echo R('Siteinfo/info',array('join_us_info'),'Widget');?>
         </div>
        </div>

        <div>
          <div class="pull-left text-success" >
            <?php if($preArticle != null): ?>上一篇：<a href="<?php echo U('/article/'.$preArticle['article_id']);?>" ><span><?php echo ($preArticle["title"]); ?></span></a>
            <?php else: ?>
               没有上一篇了<?php endif; ?>
          </div>
          <div class="pull-right text-danger" >
            <?php if($nextArticle != null): ?>下一篇：<a href="<?php echo U('/article/'.$nextArticle['article_id']);?>" ><span><?php echo ($nextArticle["title"]); ?></span></a>
            <?php else: ?>
               没有下一篇了<?php endif; ?>
          </div>
        </div>
        <div style="clear:both"></div>
        <div style="border-top:1px solid #ddd;">
		  </div>
      <div class="panel-footer">
          <div class="text-muted"> 本文在
            <time itemprop="datePublished" datetime="<?php echo (date("Y-m-d H:i:s",$article["pubtime"])); ?> "><?php echo (date("Y-m-d H:i:s",$article["pubtime"])); ?></time>
            发布在 <span itemprop="articleSection"><a href="<?php echo U('/category/'.$article['tid']);?>"><?php echo ($article["name"]); ?></a></span>  </div>
        </div>
      </div>
<?php if($article["iscommend"] == 1): ?><!--评论开始-->
<iframe class="col-lg-12 col-md-12" scrolling="no"  src="<?php echo U('Index/Comment/comments_article',array('aid'=>$aid));?>" frameborder="0"  style="max-width:730px;min-height:540px;padding:0;margin:0 auto;"></iframe>
<!--评论结束--><?php endif; ?>
    </div>
  </article>
  <div class="col-lg-4 col-md-4 sidebar">
    <div class="clean"></div>
      <aside class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">公告</h3>
          </div>
          <div class="panel-body">
              <?php echo R('Siteinfo/info',array('announcement'),'Widget');?>
          </div>
      </aside>
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=""> <span class="glyphicon glyphicon-thumbs-up mr10"></span> <span itemprop="name">最受欢迎5篇文章</span> </a> </h3>
        </div>
        <div class="panel-collapse in" style="height: auto;"> 
			     <?php if(is_array($sidebar1)): foreach($sidebar1 as $key=>$sidebar1Val): ?><a href="<?php echo U('/article/'.$sidebar1Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar1Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=""> <span class="glyphicon glyphicon-thumbs-down mr10"></span> <span itemprop="name">最受争议的5篇文章</span> </a> </h3>
        </div>
        <div  class="panel-collapse in" style="height: auto;">
        	<?php if(is_array($sidebar2)): foreach($sidebar2 as $key=>$sidebar2Val): ?><a href="<?php echo U('/article/'.$sidebar2Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar2Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=""> <span class="glyphicon glyphicon-pushpin mr10"></span> <span itemprop="name">随机推荐5篇文章</span> </a> </h3>
        </div>
        <div  class="panel-collapse in" style="height: auto;"> 
			   <?php if(is_array($sidebar3)): foreach($sidebar3 as $key=>$sidebar3Val): ?><a href="<?php echo U('/article/'.$sidebar3Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar3Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
	
   
   

    <script>var ad=$('#ad'),st;var sd=$('.sidebar'),st;ad.attr('data-offset-top',ad.offset().top+ad.innerWidth());var wd=sd.innerWidth()-30;ad.attr({style:'width:'+wd+'px'});</script> 
  </div>
  <div class="clean"></div>
</div>
<!-- footer start -->
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

<!-- footer end -->
<div class="btn-group-vertical floatButton">
  <button type="button" class="btn btn-default" id="goTop" title="去顶部"><span class="glyphicon glyphicon-arrow-up"></span></button>
  <button type="button" class="btn btn-default" id="refresh" title="刷新"><span class="glyphicon glyphicon-repeat"></span></button>
  
  <button type="button" class="btn btn-default" id="goBottom" title="去底部"><span class="glyphicon glyphicon-arrow-down"></span></button>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#goTop').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);});
  $('#goBottom').click(function(){$('html,body').animate({scrollTop:$('#footer').offset().top}, 800);});
  $('#goComments').click(function(){$('html,body').animate({scrollTop:$('#comments').offset().top}, 800);});
  $('#refresh').click(function(){location.reload();});
});
</script>
</body>
</html>