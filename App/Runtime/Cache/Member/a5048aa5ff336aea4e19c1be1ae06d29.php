<?php if (!defined('THINK_PATH')) exit();?><div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="pull-left" itemprop="headline">我发布的文章 &raquo</h1>
        <div class="clean"></div>
    </div>
    <div class="panel-body">

        <?php if(is_array($list)): foreach($list as $key=>$list): ?><div itemprop="itemListElement">
                <h2 class="h4" itemprop="name">
                    <a target="_blank" href="<?php echo U('/article/'.$list['article_id']);?>" rel="bookmark" itemprop="url"><?php echo ($list["title"]); ?></a>
                    <a style="float: right;font-size: 14px;" target="_blank" href="<?php echo U('/member/article/edit?aid='.$list['article_id']);?>" rel="bookmark" itemprop="url">编辑</a>
                </h2>
                <div itemprop="description">
                    <p><?php echo ($list["summary"]); ?></p>
                </div>
            </div><?php endforeach; endif; ?>

    </div>
    <div class="panel-footer text-muted"> 共发布了 <?php echo ($count); ?>篇文章</div>
    <?php echo ($show); ?>
</div>