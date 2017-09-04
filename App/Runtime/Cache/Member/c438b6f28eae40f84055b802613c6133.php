<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<!--[if lte IE 7]><script>window.location.href='http://cdn.dmeng.net/upgrade-your-browser.html?referrer=http://www.dmeng.net/';</script><![endif]-->
<title>个人中心-<?php echo R('Index/Siteinfo/info',array('title'),'Widget');?></title>
<meta name="description" content="<?php echo R('Siteinfo/info',array('description'),'Widget');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../Public/Css/bootstrap.min.css" rel="stylesheet" media="screen">
<!--[if lt IE 9]>
<script src="http://cdn.dmeng.net/wp-content/themes/dmeng/js/html5shiv.js"></script>
<script src="http://cdn.dmeng.net/wp-content/themes/dmeng/js/respond.min.js"></script>
<![endif]-->
<link href="../Public/Css/style.css" rel="stylesheet" media="screen">
<script src="../Public/Js/jquery.js"></script>
<script src="../Public/Js/bootstrap.min.js"></script>
</head><body id="body">
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
  <div class="col-lg-8 col-md-8 content">
  <script>
  $(function(){
  $('#person').click(function(){
    $.post("__APP__/Member/Person/person",{},function(data){
      $('#content').html(data);
      //alert(data);
    });
    
  });
  var article_url = "__APP__/Member/Article/myarticle";
  $('#article').click(function(){
      $.post(article_url,{},function(data){
          $('#content').html(data);
          $('.pagination a').click(function(){
              article_url = $(this).attr("href");
              $('#article').click();
              return false;
          });
      });

  });
  $('#data2').click(function(){
    $.post("__APP__/Member/Person/data",{},function(data){
      $('#content').html(data);
      //alert(data);
    });
    
  });

    $('#person3').click(function(){
    $.post("__APP__/Member/Person/person",{},function(data){
      $('#content').html(data);
      //alert(data);
    });
    
  });
})
</script>
<div >
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-2 uc_left sidebar-offcanvas" id="sidebar" role="navigation">
          <ul class="nav nav-pills  nav-stacked uc_left ">
             <li class="left_head"><h4>会员中心</h4></li>
              <li><a href="<?php echo U(Person/index);?>">我的首页</a></li>
              <li if(action_name="='base'" ||action_name="='head'" 'class="check" ';}=""><a href="javascript:void(0)" id="person">资料修改</a></li>
              <li if(action_name="='base'" ||action_name="='head'" 'class="check" ';}=""><a href="javascript:void(0)" id="article">我的文章</a></li>
          </ul>
        </div>
    <div class="col-md-10" id="content">
      <p class="pull-left visible-xs">
        <a class="label label-default" data-toggle="offcanvas"></a>
      </p>
    <div class="row">
  <div class="col-md-3 offset-1">
      <a href="javascript:void(0)" class="thumbnail uc-zyl" id="data2">
          <?php if($persons["photo"] == null): ?><img src="__AVATAR__/nophoto.gif">
          <?php else: ?>
            <img src="__AVATAR__/avatar_<?php echo ($persons["photo"]); ?>"><?php endif; ?>
            <label class="pic-text">点击设置个性图像</label>
        </a>
  </div>
      <div class="col-md-8"><p>
      <strong></strong>
      <span class="text-muted"></span>
      <a href="javascript:void(0)" id="person3">编辑资料</a>
      </p>
      注册时间<p class="text-muted"><?php echo (date("Y-m-d H:m:s",$persons["regtime"])); ?></p>
      注册ip<p class="text-muted"><?php echo ($persons["regip"]); ?></p>
    </div>
      </div>
	</div> 
      </div>
	</div> 
  </div>
  <div class="col-lg-4 col-md-4 sidebar">
    <div class="clean"></div>
    <aside class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">公告</h3>
      </div>
      <div class="panel-body">
        <?php echo R('Index/Siteinfo/info',array('announcement'),'Widget');?>
      </div>
    </aside>
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=""> <span class="glyphicon glyphicon-pushpin mr10"></span> <span itemprop="name">随机推荐5篇文章</span> </a> </h3>
        </div>
        <div  class="panel-collapse in" style="height: auto;"> 
			   <?php if(is_array($sidebar3)): foreach($sidebar3 as $key=>$sidebar3Val): ?><a href="<?php echo U('Index/Article/index',array('articleid'=>$sidebar3Val['article_id']));?>" class="list-group-item"><span><?php echo ($sidebar3Val["title"]); ?></span></a><?php endforeach; endif; ?>
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
  <button type="button" class="btn btn-default" onclick="window.open('#');" title="赞"><span class="glyphicon glyphicon-thumbs-up"></span></button>
  <button type="button" class="btn btn-default" id="goBottom" title="去底部"><span class="glyphicon glyphicon-arrow-down"></span></button>
</div>
<!-- 去顶部 --> 
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