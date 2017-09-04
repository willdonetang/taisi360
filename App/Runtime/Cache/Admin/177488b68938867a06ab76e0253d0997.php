<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo (($currentPage)?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--ÿҳ��ʾ������-->
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a  target="selectedTodo" target="dialog" rel="ids[]" href="__URL__/recAll/navTabId/listcomment1" class="add" ><span>批量恢复评论</span></a></li>
			<li class="line">line</li>
			<li><a  target="selectedTodo" target="dialog" rel="ids[]" href="__URL__/delAll/navTabId/listcomment1" class="delete" ><span>批量永久删除</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="76">
		<thead>
			<tr>
				<th width="10"><input type="checkbox" group="ids[]" class="checkboxCtrl"></th>
				<th width="30">作者</th>
				<th width="30">文章</th>
				<th width="40">发布时间</th>
				<th width="30">发布内容</th>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr target="item_id" rel="<?php echo ($vo["commend_id"]); ?>">
					<td><input name="ids[]" value="<?php echo ($vo['commend_id']); ?>" type="checkbox">:<?php echo ($vo['commend_id']); ?></td>
					<td><?php echo ($vo["username"]); ?></td>
					<td><?php echo ($vo["title"]); ?></td>
					<td><?php echo (date("Y-m-d H:m:s",$vo["pubtime"])); ?></td>
					<td><?php echo ($vo["content"]); ?></td>
					<td><?php echo (crubbish($vo["islock"],$vo['commend_id'])); ?>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="10" <?php if($numPerPage == 10 ): ?>selected<?php endif; ?>>10</option>
				<option value="15" <?php if($numPerPage == 15 ): ?>selected<?php endif; ?>>15</option>
				<option value="20" <?php if($numPerPage == 20 ): ?>selected<?php endif; ?>>20</option>
				<option value="25" <?php if($numPerPage == 25 ): ?>selected<?php endif; ?>>25</option>
				<option value="30" <?php if($numPerPage == 30 ): ?>selected<?php endif; ?>>30</option>
			</select>
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
	</div>
</div>