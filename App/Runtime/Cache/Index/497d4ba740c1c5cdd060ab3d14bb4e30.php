<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title><?php echo R('Siteinfo/info',array('title'),'Widget');?>登陆</title>

    <!-- Bootstrap core CSS -->
    <link href="__PUBLIC__/Css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="__PUBLIC__/Css/login.css" rel="stylesheet">
	<script src="../Public/Js/jquery.js"></script>
   <script>
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

  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" action="<?php echo U('Login/checkLogin');?>" method="post">
        <h4 class="form-signin-heading" style="font-family:'微软雅黑';font-size:20px;">账号登陆:</h4>
         <input type="text" class="form-control"  name="username" placeholder="账号(必填)" required>
          <input type="password" class="form-control" name="password" placeholder="密码(必填)" required>
          <input type="text" class="form-control" name="code" placeholder="验证码(必填)" required width="40"
          style="width:200px;display:inline;valign:center;">
          <span>
          <img id="verifyImg" SRC="__URL__/verify/" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer;width:80px;vertical-align:top;" align="absmiddle">
          
		   <a href="<?php echo U('Index/Login/checkreg');?>" class="btn btn-link" style="float:right" title="注册">没有账号?去注册</a>
          </span>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
      </form>

    </div>
  </body>
</html>