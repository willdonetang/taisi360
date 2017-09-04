<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<base href="__ROOT__/" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<title><?php echo R('Siteinfo/info',array('title'),'Widget');?></title>
<meta name="description" content="<?php echo R('Siteinfo/info',array('description'),'Widget');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../Public/Css/bootstrap.min.css" rel="stylesheet" media="screen">
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
    <div id="carousel-example-generic" class="carousel slide mb20" data-ride="carousel"> 
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php foreach($modelid1 as $k=>$images0){ ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo ($k); ?>" class="<?php if($k==0){ ?>active<?php } ?>"></li>
        <?php } ?>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php foreach($modelid1 as $k=>$images0){ ?>
        <div class="item <?php if($k==0){ ?>active<?php } ?>">
          <a href="<?php echo U('/article/'.$images0['article_id']);?>" target="_blank"><img  style="margin:0 auto;max-height:300px;" src="<?php echo (imgs($images0["content"],$images0.content)); ?>" alt="<?php echo ($images0["title"]); ?>" /></a>
          <div class="carousel-caption"> </div>
        </div>
        <?php } ?>
      </div>
      <!-- Controls --> 
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" > <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next" > <span class="glyphicon glyphicon-chevron-right"></span> </a> </div>

    <div itemscope itemtype="">
      
<?php if(is_array($modelid1)): $i = 0; $__LIST__ = array_slice($modelid1,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$modelid1): $mod = ($i % 2 );++$i;?><div class="col-lg-4 col-md-6 col-sm-6 mb20">
        <div class="thumbnail">
          <div class="stickyImg"  ><img src="<?php echo (imgs($modelid1["content"],$modelid1.content)); ?>" itemprop="image"  /></div>
          <div class="caption">
            <div class="stickyContent">
              <h3 class="stickyTitle"><a href="<?php echo U('/article/'.$modelid1['article_id']);?>" title="<?php echo ($modelid1["title"]); ?>"><span itemprop="itemListElement"><?php echo ($modelid1["title"]); ?></span></a></h3>
              <div class="stickyDesc" itemprop="description">
                <p><?php echo ($modelid1["summary"]); ?></p> 
              <!--   <p><?php echo (imgs($modelid1["content"],$modelid1.content)); ?></p> -->
              </div>
            </div>
            <a itemprop="url" href="<?php echo U('/article/'.$modelid1['article_id']);?>" class="btn btn-primary" role="button" target="_blank">阅读全文</a> </div>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>


<?php if(is_array($modelid0)): $i = 0; $__LIST__ = $modelid0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$modelids): $mod = ($i % 2 );++$i;?><div class="col-lg-6 col-md-6 col-sm-6 mb20 indexCat" itemscope itemtype="">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" itemprop="name"><a href="<?php echo U('/category/'.$modelids['id']);?>"><?php echo ($modelids["name"]); ?></a></h3>
        </div>
       <ul class="list-group">
       <?php if(is_array($modelids["Article"])): $i = 0; $__LIST__ = $modelids["Article"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Articles): $mod = ($i % 2 );++$i; if($Articles["ispush"] == 1): ?><a itemprop="url" href="<?php echo U('/article/'.$Articles['article_id']);?>"class="list-group-item">
          <span itemprop="itemListElement"><?php echo ($Articles["title"]); ?></span>
          </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
     
      </ul>
      </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    
   
 


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
          <h3 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
              <span class="glyphicon glyphicon-fire mr10"></span>
              <span itemprop="name">按赞的次数推荐的5篇</span>
            </a>
          </h3>
        </div>
       
        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
      <?php if(is_array($approval)): foreach($approval as $key=>$approval): ?><a href="<?php echo U('/article/'.$approval['article_id']);?>" class="list-group-item" itemprop="url">
        <span itemprop="itemListElement"><?php echo ($approval["title"]); ?></span>
        </a><?php endforeach; endif; ?>
        </div>
      </div>
    

      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
              <span class="glyphicon glyphicon-volume-up mr10"></span>
              <span itemprop="name">最新热门的5篇文章</span>
            </a>
          </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
        <?php if(is_array($approval2)): foreach($approval2 as $key=>$approval2): ?><a href="<?php echo U('/article/'.$approval2['article_id']);?>" class="list-group-item" itemprop="url">
        <span itemprop="itemListElement"><?php echo ($approval2["title"]); ?></span>
        </a><?php endforeach; endif; ?>
         </div>
      </div>
    

      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="">
              <span class="glyphicon glyphicon-thumbs-up mr10"></span>
              <span itemprop="name">随机推荐5篇精选文章</span>
            </a>
          </h3>
        </div>
      <div id="collapseThree" class="panel-collapse in" style="height: auto;">
        <?php if(is_array($approval3)): foreach($approval3 as $key=>$approval3): ?><a href="<?php echo U('/article/'.$approval3['article_id']);?>" class="list-group-item" itemprop="url">
        <span itemprop="itemListElement"><?php echo ($approval3["title"]); ?></span>
        </a><?php endforeach; endif; ?>
        </div>
      </div>
    </div>
    


    <aside class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">最新注册会员</h3>
      </div>
      <ul class="ds-recent-visitors" data-num-items="24" data-show-time="0" data-avatar-size="44" id="ds-recent-visitors">
        <?php if(is_array($portrait)): $i = 0; $__LIST__ = $portrait;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$portraits): $mod = ($i % 2 );++$i;?><div class="ds-avatar" style="margin:4px;float:left;"><a title="<?php echo ($portraits["username"]); ?>"><img src="<?php echo (photos($portraits["photo"],$portraits.photo)); ?>" alt="" style="width:44px;height:44px"></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </aside>
    <div id="ad" data-spy="affix" class="fade in"><a class="close" data-dismiss="alert" href="#" aria-hidden="true" style="position:absolute;color:#c5c5c5;" title="关闭"><span class="glyphicon glyphicon-ban-circle"></span></a>
      <aside class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">赞助商</h3>
        </div>
        <div class="panel-body" style="padding:0;text-align:left;">
        	<?php echo R('Siteinfo/info',array('ad'),'Widget');?>
        </div>
      </aside>
    </div>
    <!-- 右侧底部广告 --> 
    <script>var ad=$('#ad'),st;var sd=$('.sidebar'),st;ad.attr('data-offset-top',ad.offset().top+ad.innerWidth());var wd=sd.innerWidth()-30;ad.attr({style:'width:'+wd+'px'});</script> 
  </div>
  <div class="clean"></div>
  </div>
<footer id="footer">
  <div class="col-lg-12 col-md-12">
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-body text-muted">
          <ul>
             <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><li ><a href="<?php echo ($link["url"]); ?>" target="_blank"><?php echo ($link["name"]); ?></a><span>&nbsp;&nbsp;</li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li ><a href="<?php echo U('Reason/index');?>" style="color:red"><span class="glyphicon glyphicon-list-alt"></span>点击申请链接</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
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
<!-- 去顶部 --> 
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#goTop').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);});
  $('#goBottom').click(function(){$('html,body').animate({scrollTop:$('#footer').offset().top}, 800);});
  $('#refresh').click(function(){location.reload();});
});
</script>
</body>
</html>