<?php
/**
* 文章评论
* @author  <[c@easycms.cc]>
*/
class CommentAction extends CommonAction
{
	
	Public function comments_article(){
		$article_id=I('aid','','intval');
		//评论相关
		import('ORG.Util.Page');// 导入分页类
   		$count=D('Comment')->relation(true)->where("aid='$article_id' and islock=0")->order('commend_id desc')->count();//获取数据的总数
   		$page=new Page($count,3);
   		$page->setConfig('theme', '<ul class="pagination"><li>%upPage%</li><li>%downPage%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li></ul>');
   		$show=$page->show();//返回分页信息
		$comments=D('Comment')->relation(true)->where("aid='$article_id' and islock=0")->order('commend_id desc')->limit($page->firstRow.','.$page->listRows)->select();
		//dump($comments);
        if($_SESSION[C('USER_AUTH_KEY_ID')]){
            $is_login = true;
        }
        else{
            $is_login = false;
        }
		$this->assign('aid',$article_id);
		$this->assign('is_login',$is_login);
		$this->assign('show',$show);
		$this->assign('comments',$comments);
		$this->display('comments_article');
	}
    public function verify(){
        import('ORG.Util.Image');
        //$length=4, $mode=1, $type='png', $width=48, $height=22, $verifyName='verify'
        Image::buildImageVerify(4,5,'png',48,22,'comment_verify');
    }
}