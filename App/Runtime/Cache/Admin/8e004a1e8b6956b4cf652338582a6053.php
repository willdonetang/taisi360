<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="__URL__/update/navTabId/listarticle/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  ?>
		<input type="hidden" name="article_id" value="<?php echo ($vo["article_id"]); ?>"/>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>文章分类：</dt>
				<dd><?php echo ($vo["name"]); ?></dd>
			</dl>
			<dl>
				<dt>文章标题：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="title" value="<?php echo ($vo["title"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>关键词：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="keyword"  value="<?php echo ($vo["keyword"]); ?>"/></dd>
			</dl>

			<dl>
				<dt>是否首页推荐：</dt>
				<dd>
					<input type="radio" name="ispush" value="1" <?php if($vo["ispush"] == 1): ?>checked<?php endif; ?>/>推荐
					<input type="radio" name="ispush" value="0" <?php if($vo["ispush"] == 0): ?>checked<?php endif; ?>/>不推荐
				</dd>
			</dl>
			<dl>
				<dt>是否允许评论：</dt>
				<dd>
					<input type="radio" name="iscommend" value="1" <?php if($vo["iscommend"] == 1): ?>checked<?php endif; ?>/>允许
					<input type="radio" name="iscommend" value="0" <?php if($vo["iscommend"] == 0): ?>checked<?php endif; ?>/>不允许
				</dd>
			</dl>
			<dl>
				<dt>是否首页幻灯：</dt>
				<dd>
					<input type="radio" name="isslides" value="1" <?php if($vo["isslides"] == 1): ?>checked<?php endif; ?>/>是
					<input type="radio" name="isslides" value="0" <?php if($vo["isslides"] == 0): ?>checked<?php endif; ?>/>否
				</dd>
			</dl>
			<dl>
				<dt>是否加入回收站：</dt>
				<dd>
					<input type="radio" name="islock" value="1" <?php if($vo["islock"] == 1): ?>checked<?php endif; ?>/>是
					<input type="radio" name="islock" value="0"  <?php if($vo["islock"] == 0): ?>checked<?php endif; ?>/>否
				</dd>
			</dl>
			<dl class="nowrap">
				<dt>摘要：</dt>
				<dd><textarea class="required"  style="width:100%" name="summary"><?php echo ($vo["summary"]); ?></textarea></dd>
			</dl>
			<dl  class="nowrap">
				<dt>文章内容：</dt>
				<dd>
					<textarea id="elm1" name="content"  style="width:100%;display: none;" rows="20"  ><?php echo ($vo["content"]); ?>
					</textarea>
					<script>
						$('#elm1').xheditor({upLinkUrl:"__URL__/upload",upLinkExt:"zip,rar,txt",upImgUrl:"__URL__/upload",upImgExt:"jpg,jpeg,gif,png",upFlashUrl:"__URL__/upload",upFlashExt:"swf",upMediaUrl:"__URL__/upload",upMediaExt:"avi",urlBase:'__ROOT__/'});
					</script>
				</dd>
			</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>