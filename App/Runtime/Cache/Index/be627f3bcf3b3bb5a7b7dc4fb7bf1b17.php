<?php if (!defined('THINK_PATH')) exit();?>    <!DOCTYPE html>
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
      <div class="col-lg-14 col-md-14" id="comments">
      	我的态度：
      	<input type="radio" id="proposal" name="proposal" value="1" checked><img src="../Public/Images/zheng.png" alt="支持">
      	<input type="radio" id="proposal" name="proposal" value="0"><img src="../Public/Images/fan.png" alt="反对">
        <textarea rows="3" class="form-control" placeholder="输入你的评论内容" id="articleComments" name="articleComments"></textarea>
         <?php if($is_login) { ?>
          <input type="text" class="form-control" name="code" placeholder="验证码(必填,区分大小写)" required width="40"
                 style="width:200px;display:inline;valign:center;" id="verify-code">
          <img id="verifyImg" SRC="__URL__/verify/" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer;width:80px;vertical-align:top;" align="absmiddle">
        <?php } ?>
          <?php if($is_login) { ?>
          <button type="button" class="btn btn-primary" onclick="comment();">留言</button>
          <?php }else{ ?>
          <a class="btn btn-primary" href="<?php echo U('/index/login/index');?>" target="_blank">登陆</a>
          <?php } ?>
        <br/><br/>
      	<a name="comments"></a>
        <div id="ds-ssr">
          <ul id="commentlist" class="list-unstyled">
          <?php if(is_array($comments)): foreach($comments as $key=>$commentsVal): ?><li class="comment even thread-even depth-1" id="li-comment-667">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><?php echo ($commentsVal["username"]); ?> 在 <?php echo (date("Y-m-d H:i:s",$commentsVal["pubtime"])); ?> 说:
              </div>
              <div class="panel-body">
                <?php echo ($commentsVal["content"]); ?>
              </div>
            </div>
              <!-- #comment-## --> 
            </li><?php endforeach; endif; ?>
            <!-- #comment-## -->
          </ul>
          <?php echo ($show); ?>
        </div>
      </div>
      <script>
          function comment(){
              var commentVal=$('#articleComments').val();
              var proposal=$('#proposal:checked').val();
              var urlVal=window.location;
              var verify_cdoe = $("#verify-code").val();
              $.post("<?php echo U('Index/Article/addComment');?>",{code:verify_cdoe,aid:<?php echo ($aid); ?>,comment:''+commentVal,proposal:''+proposal},
			  function(data){
				alert(data);
                location.reload();
             });
          }
          function fleshVerify(type){
              //重载验证码
              var timenow = new Date().getTime();
              if (type){
                  $('#verifyImg').attr("src", '__URL__/verify/adv/1/'+timenow);
              }else{
                  $('#verifyImg').attr("src", '__URL__/verify/'+timenow);
              }
          }
      </script>
</body>
</html>