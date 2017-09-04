<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo (($currentPage)?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--ÿҳ��ʾ������-->
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<script>
	function updateSort(obj){
		$id=$(obj).attr('name');
		$value=$(obj).attr('value');
		$.post('__URL__/update/navTabId/listcate/callbackType/closeCurrent' , {'id':$id,'sort':$value} , function(){
			$(obj).html($value);
		});
		navTabPageBreak();
	}

</script>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="__URL__/add/id/0" target="dialog" width="550" height="380" rel="user_msg" title="添加顶级分类"><span>添加顶级分类</span></a></li>
			<li><a class="delete" href="__URL__/delete/id/{item_id}/navTabId/listcate" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="__URL__/edit/id/{item_id}"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr align="center">
				<th width="40">ID</th>
				<th>分类名称</th>
				<th>模型类别</th>
				<th>导航显示</th>
				<th>审核状态</th>
				<th>首页推荐</th>
				<th>排序</th>
				<th>操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>" level="<?php echo ($vo["level"]); ?>" align="center">
					<td ><?php echo ($vo["id"]); ?></td>
					<td align="left"><?php echo ($vo["html"]); echo ($vo["name"]); ?></td>
					<td><?php if($vo['modelid'] == 0): ?>文章模型<?php else: ?>图片模型<?php endif; ?></td>
					<td width="70" align="center"><?php echo (isok($vo["isshow"])); ?></td>
					<td width="70" align="center"><?php echo (isok($vo["isverify"])); ?></td>
					<td width="70" align="center"><?php echo (isok($vo["ispush"])); ?></td>
					<td >
					<input onblur="updateSort(this);" type="text" style="width:30px;border:0;" name="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["sort"]); ?>" > 
					</td>
					
					<td>
						<a href="__URL__/add/id/<?php echo ($vo["id"]); ?>/name/<?php echo ($vo["name"]); ?>" target="dialog">添加子分类</a> |  
						<a href="__URL__/edit/id/<?php echo ($vo["id"]); ?>/name/<?php echo ($vo["name"]); ?>" target="dialog">修改</a> 
						<!-- <a href="__URL__/delete/id/{item_id}/navTabId/listcate" target="ajaxTodo" title="确定要删除吗?">删除</a> -->
					</td>
					
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>