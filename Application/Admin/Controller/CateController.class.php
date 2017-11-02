<?php
namespace Admin\Controller;
use Think\Controller;
class CateController extends Controller {
    public function lst()
    {
    	$cate=D('cate');
        $cates=$cate->catetree();
		$this->assign('cates',$cates);
        $this->display();
    }
    public function add()
    {
    	if(IS_POST)
    	{       
	    		$cate=D('cate');
		    	$data['parentid']=I('parentid');
		    	$data['name']=I('name');
		    	$data['keywords']=I('keywords');
		    	$data['type']=I('type');
		    	$data['des']=I('des');
		    	$data['content']=I('content');
	        if($_FILES['pic']['tmp_name']!='')
	        {
	            $upload = new \Think\Upload();
	            $upload->maxSize   =     3145728 ;// 设置附件上传大小    
	            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型   
	            $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录    
	            $upload->rootPath  =     './';   
	            // 上传文件    
	            
	            $info   =   $upload->uploadOne($_FILES['pic']);
	            if(!$info) {// 上传错误提示错误信息       
	               $this->error($upload->getError());   
	            }else{// 上传成功        
	               $data['pic']=$info['savepath'].$info['savename'];
	            }

	            if($cate->create($data))
	            {
	            	if($cate->add()){

	            		$this->success('新增栏目成功',U('lst'));
	            	}else{

	                    $this->error('栏目添加失败');
	            	}
	            }else{
	                $this->error($cate->getError());
	            }
	        }
    	}else{
    		$cate=D('cate');
	        $cates=$cate->catetree();
	        $this->assign('list',$cates);
    		$this->display();
    	} 
    }
    public function edit()
    { 
    	if(IS_POST)
    	{    
	    		$cate=D('cate');
		    	$data['parentid']=I('parentid');
		    	$data['name']=I('name');
		    	$data['id']=I('id');
		    	$data['keywords']=I('keywords');
		    	$data['type']=I('type');
		    	$data['des']=I('des');
		    	$data['content']=I('content');
		    	var_dump($_FILES['pic']);
	        if($_FILES['pic']['tmp_name']!='')
	        {   
	            $upload = new \Think\Upload();
	            $upload->maxSize   =     3145728 ;// 设置附件上传大小    
	            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型   
	            $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录    
	            $upload->rootPath  =     './';   
	            // 上传文件    
	            
	            $info   =   $upload->uploadOne($_FILES['pic']);
	            if(!$info) {// 上传错误提示错误信息       
	               $this->error($upload->getError());   
	            }else{// 上传成功        
	               $data['pic']=$info['savepath'].$info['savename'];
	            }

	            if($cate->create($data))
	            {
	            	if($cate->save()){

	            		$this->success('修改栏目成功',U('lst'));
	            	}else{

	                    $this->error('栏目修改失败');
	            	}
	            }else{
	                $this->error($cate->getError());
	            }
	        }
    	}else{
            $cate=D('cate');
	    	$content=$cate->find(I('id'));
	    	$this->assign('content',$content);
	    	$cates=$cate->catetree();
		    $this->assign('list',$cates);
	    	$this->display();

    	}
    	
    }
    public function del()
    {
    	$cate=D('cate');
    	$id=I('id');
    	if($cate->delete($id))
    	{
    		$this->success('删除成功',U('lst'));
    	}else
    	{
    		$this->error('删除失败',U('lst'));
    	}
    }
    //批量删除
    public function bdel()
    {
    	$cate=D('cate');
    	$ids=I('ids');
    	$ids=implode(',', $ids);
    	if($ids){
    		if($cate->delete($ids)){
	            $this->success('批量删除成功',U('lst'));
	    	}else{
	    		$this->error('批量删除失败');
	    	}
    	}else{
    		$this->error('批量删除失败');
    	}
    	
    }
    //更新排序
    public function cateSort()
    {
    	if(IS_POST){
    		$cate=D('cate');
    		foreach ($_POST as $id => $sort) {
    			$cate->where("id=$id")->setField('sort',$sort);
    		}
    	}
    	$this->success("更新排序成功",U('lst'));
    }
}