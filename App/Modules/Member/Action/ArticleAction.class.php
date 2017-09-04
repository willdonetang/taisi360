<?php
/**
 * Created by PhpStorm.
 * User: ivancen
 * Date: 2017/3/22
 * Time: 16:44
 */
class ArticleAction extends CommonAction
{
    public function index()
    {
        if (!$_SESSION[C('USER_AUTH_KEY_F')]) {
            $this->error("请先登陆");
        }
        $User = M('Member_user');
        $id = $_SESSION[C('USER_AUTH_KEY_ID')];
        $result = $User->find($id);
        $this->assign('persons', $result);
        $this->display('index');
    }

    public function myarticle(){
        $uid = $_SESSION[C('USER_AUTH_KEY_ID')];
        //数据分页
        import('ORG.Util.Page');// 导入分页类
        $condition = array();
        $condition['uid'] = $uid;
        $condition['islock'] = 0;
        $count=M('article')->where($condition)->count();//获取数据的总数
        $page=new Page($count,10);
        $page->setConfig('theme', '<ul class="pagination"><li>%upPage%</li><li>%downPage%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li></ul>');
        $show=$page->show();//返回分页信息
        $articles=M('article')->where($condition)->order('article_id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('show',$show);
        $this->assign('count',$count);
        $this->assign('list',$articles);

        $this->display();
    }
    public function edit(){
        $model = D('Article');
        $aid = I('aid');
        $uid = $_SESSION[C('USER_AUTH_KEY_ID')];
        $condition = array();
        $condition['article_id'] = $aid;
        $condition['uid'] = $uid;
        $vo = $model->where($condition)->relation(true)->find();
        $this->assign('vo', $vo);
        $this->display();
    }
}