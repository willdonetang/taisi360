<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<title><?php echo ($catName); ?>-<?php echo R('Siteinfo/info',array('title'),'Widget');?></title>
<meta property="og:description" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="../Public/Css/bootstrap.min.css" rel="stylesheet" media="screen">

<link href="../Public/Css/style.css" rel="stylesheet" media="screen">
<script src="../Public/Js/jquery.js"></script>
<script src="../Public/Js/bootstrap.min.js"></script>
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
  <div itemscope itemtype="http://schema.org/ItemList">
    <div class="col-lg-8 col-md-8 content">
      <div class="clean"></div>
  
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="pull-left" itemprop="headline">分类归档 &raquo; <?php echo ($catName); ?></h1>
          <div class="pull-right"> 
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_b" style="line-height: 12px;"> <a class="btn btn-default btn-sm pull-left"> <span class="glyphicon glyphicon-thumbs-up"></span> 分享</a> <a class="shareCount btn btn-default btn-sm pull-right" style="background: #fff !important;line-height: 28px;height: 30px;width: auto;color: #666;padding: 0 10px;"></a>
              <div class="clean"></div>
            </div>
            <script type="text/javascript" id="bdshare_js" data="type=button&amp;mini=1&amp;uid=835052" ></script> 
            <script type="text/javascript" id="bdshell_js"></script> 
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
                    </script> 
            <!-- Baidu Button END --> 
            </div>
          <div class="clean"></div>
        </div>
        <div class="panel-body">

        <?php if(is_array($list)): foreach($list as $key=>$list): ?><div itemprop="itemListElement">
            <h2 class="h4" itemprop="name"><a href="<?php echo U('/article/'.$list['article_id']);?>" rel="bookmark" itemprop="url"><?php echo ($list["title"]); ?></a></h2>
            <div itemprop="description">
              <p><?php echo ($list["summary"]); ?></p>
            </div>
          </div><?php endforeach; endif; ?>

        </div>
        <div class="panel-footer text-muted"> “<?php echo ($catName); ?>”分类目录为您找到结果 <?php echo ($count); ?>个</div>
      </div>
      <?php echo ($show); ?>
 
    </div>
  </div>
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
    <div class="panel-group mb20" id="accordion">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed"> <span class="glyphicon glyphicon-fire mr10"></span> <span itemprop="name">按浏览次数推荐的5篇文章</span> </a> </h3>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;"> 
          <?php if(is_array($sidebar1)): foreach($sidebar1 as $key=>$sidebar1Val): ?><a href="<?php echo U('/article/'.$sidebar1Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar1Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed"> <span class="glyphicon glyphicon-volume-up mr10"></span> <span itemprop="name">最受网友争议5篇文章</span> </a> </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;"> 
          <?php if(is_array($sidebar2)): foreach($sidebar2 as $key=>$sidebar2Val): ?><a href="<?php echo U('/article/'.$sidebar2Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar2Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=""> <span class="glyphicon glyphicon-thumbs-up mr10"></span> <span itemprop="name">随机推荐5篇精选文章</span> </a> </h3>
        </div>
        <div id="collapseThree" class="panel-collapse in" style="height: auto;"> 
          <?php if(is_array($sidebar3)): foreach($sidebar3 as $key=>$sidebar3Val): ?><a href="<?php echo U('/article/'.$sidebar3Val['article_id']);?>" class="list-group-item"><span><?php echo ($sidebar3Val["title"]); ?></span></a><?php endforeach; endif; ?>
        </div>
      </div>
    </div>
    

    
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