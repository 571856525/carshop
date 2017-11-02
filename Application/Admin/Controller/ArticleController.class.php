<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
    public function lst()
    {   
    	$article=D('article');
        $count      = $article->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $article->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    public function add()
    {
    	if(IS_POST){
    		$article=D('article');
            $data['title']=I('title');
            $data['author']=I('author');
            $data['content']=I('content');
            $data['keywords']=I('keywords');
            $data['des']=I('des');
            $data['rem']=I('rem');
            $data['cateid']=I('cateid');
            $data['time']=time();
            if(!empty($_FILES['pic']['tmp_name'])){
              $upload = new \Think\Upload();// 实例化上传类   
              $upload->maxSize   =     3145728 ;// 设置附件上传大小    
              $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
              $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录    // 上传单个文件   
              $upload->rootPath  =      './'; 
              $info   =   $upload->uploadOne($_FILES['pic']); 
                if(!$info) {// 上传错误提示错误信息     
                      $this->error($upload->getError());   
                }else{// 上传成功 
                      $data['pic']=$info['savepath'].$info['savename'];
                }
                  if($article->create($data)){
		               if($article->add()){
		                    $this->success('文章添加成功',U('lst'));
		               }else{
                            $this->error('文章添加失败');
		               }
		            }else{
		            	$this->error($article->getError());
		            }
            }
            return;
            
    	}
    	$cate=D('cate');
    	$cates=$cate->catetree();
	    $this->assign('list',$cates);
        $this->display();
    }
    public function edit()
    { 
    	
    }
    public function del()
    {
  
    }
    //批量删除
    public function bdel()
    {
    
    }
  
}