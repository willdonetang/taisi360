<?php if (!defined('THINK_PATH')) exit();?>
<script>
	$(function(){
	$('#Data').click(function(){
		$.post("__APP__/Member/Person/data",{},function(data){
			$('#content').html(data);
			//alert(data);
		});
 		
	});
	$('#avatar1').click(function(){
		$.post("__APP__/Member/Person/avatar",{},function(data){
			$('#content').html(data);
			//alert(data);
		});
 		
	});
})
</script>
<div class="uc_right" >
	<div class="">
		<ul class="nav nav-tabs r_nav_title">
			<li class="active"><a>基本资料</a></li>
			<li><a href="javascript:void(0)" id="Data">头像修改</a></li>
			<li><a href="javascript:void(0)" id="avatar1">安全信息</a></li>
		</ul>
	</div>

<div class="r_form_e row" id="content">
	<div class="col-md-8">
		<form action="<?php echo U('Person/Profile');?>" method="post">
			<input type="hidden" name="id" value="<?php echo ($persons["user_id"]); ?>">
				<table class="table">
					<tbody>
					<tr>
						<th class="`">用户名</th>
						<td><?php echo ($persons["username"]); ?></td>

					</tr>
					<tr>
						<th>email</th>
							<td><input type="text" class="form-control" name="email" value="<?php echo ($persons["email"]); ?>"></td>

							
							
					</tr>
						<tr>
							<th>性别</th>
							<td>
								<?php if($persons["sex"] == 1): ?><label class="checkbox-inline">
								<input type="radio" value="1" name="sex" checked="checked">男
								<input type="radio" value="0" name="sex">女
								</label>
								<?php else: ?> 

								<label class="checkbox-inline">
								<input type="radio" value="1" name="sex"> 男
								<input type="radio" value="0" name="sex" checked="checked"> 女
								
								</labe><?php endif; ?>
							</td>
							</tr>
							 <td colspan="2">
								<button class="btn  btn-primary right">提交信息</button>
							</td>
									</tr>
								</tbody></table>
							</form>
							</div>
						</div>
					</div>