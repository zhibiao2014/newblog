<?php
class BlogAction extends CommonAction
{
    public function index(){
        $this->assign('arclist',$this->arcList());
        $this->assign('position',$this->getPos());
        $this->assign('flag','0_arc');
        $this->display();
    }
    public function detail(){
        $obj = D('Article');
        $arcid = $_GET['arcid'];
        $where['arcid'] = $arcid;
        $article = $obj->relation(true)->where($where)->find();
        $article['arcurl'] =  U('Article/index',array('arcid'=>$arcid));
        $article['commentnum'] = $this->getCommentNum($article['arcid']);
        $article['colurl'] = U('Index/columns',array('colid'=>$article['colid']));
        
        //处理关键字
        $keyarray = explode(',',$article['keyword']);
        foreach ($keyarray as$k=>$v){
            $keyarray[$k] = "<a href='".U('Index/tag',array('key'=>$v))."'>".$v."</a>";
        }
        $article['keyurl'] = implode(',',$keyarray);
        
        //处理上一篇下一篇文章
        $article['prearc'] = $obj->getUpDownArc($article['createtime'],'up');
        $article['nextarc'] = $obj->getUpDownArc($article['createtime'],'down');
        
        //点击次数更新
        $data['click'] = $article['click'] + 1;
        $obj->where(array('arcid'=>$arcid))->save($data);
        
        $this->assign('article',$article);
        $this->display();
    }
    //获取分类文章
    public function columns(){
        $colid = $_GET['colid'];
        $this->assign('arclist',$this->arcList($colid));
        $this->assign('position',$this->getPos($colid));
        $this->assign('flag',$colid.'_colarc');
        $this->display(C('CFG_DF_THEME').':Index:index');
    }
    
    //获取tag文章
    public function tag(){
        $key = $_GET['key'];
        $this->assign('arclist',$this->arcList(0,$key));
        $this->assign('position',$this->getPos(0,$key));
        $this->assign('flag',$key.'_tagarc');
        $this->display(C('CFG_DF_THEME').':Index:index');
    }
    
    //获取归档文章
    public function dateArc(){
        $date = $_GET['date'];
        $this->assign('arclist',$this->arcList(0,'',$date));
        $this->assign('position',$this->getPos(0,'',$date));
        $this->assign('flag',$date.'_datearc');
        $this->display(C('CFG_DF_THEME').':Index:index');
    }
    
    //文章搜索
    public function search(){
        $key = $this->_post('searchkey');
        if(empty($key)){
            $this->error('搜索关键字不能为空！');
        }
        $this->assign('arclist',$this->arcList(0,'','',$key));
        $this->assign('position',$this->getPos(0,'','',$key));
        $this->assign('flag',$key.'_searcharc');
        $this->display(C('CFG_DF_THEME').':Index:index');
    }
    
    //Ajax获取更多文章
    public function getArticle(){
        $flag = $_POST['flag'];
        $flagarray = explode('_',$flag);
        switch($flagarray[1]){
            case 'arc':
                $list = $this->arcList();
                break;
            case 'colarc':
                $list = $this->arcList($flagarray[0]);
                break;
            case 'tagarc':
                $list = $this->arcList(0,$flagarray[0]);
                break;
            case 'datearc':
                $list = $this->arcList(0,'',$flagarray[0]);
                break;
            case 'searcharc':
                $list = $this->arcList(0,'','',$flagarray[0]);
                break;
            default :
                $list = '';
                break;
        }
        $this->ajaxReturn($list);
    }
}

?>