<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">
	<form action="__URL__/addCat" target="dialog">
		<div class="pageFormContent" layoutH="60">
			<div style="margin:19%">
			<select name="scat" onchange="check(this.value)">
				<?php if(is_array($clist)): foreach($clist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["html"]); echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			<a id="articlecatselect" style="color:blue;position:relative;left:40px;top:8px;font-size:15px;font-weight:bold;" class="add" href="__URL__/addCat/id/<?php echo ($clist[0]["id"]); ?>/callbackType/closeCurrent" target="dialog" width="800" height="600" rel="user_msg" title="文章发布"><span>点击确认</span></a>
			</div>
		</div>
	</form>
</div>
<script>
	function check(val){
		var url='__URL__/addCat/id/'+val;
		$('#articlecatselect').attr('href',url);
	}
</script>