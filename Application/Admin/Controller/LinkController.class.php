<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends Controller {
     public function lst(){
       $link=D('link');
       $count      = $link->count();// 查询满足要求的总记录数
       $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
       $link = $link->limit($Page->firstRow.','.$Page->listRows)->select();
       $this->assign('page',$show);// 赋值分页输出
       $this->assign('link',$link);
       $this->display();
     }
     public function add(){
       if(IS_POST){
          $link=D('link');

          $data['title']=I('title');
          $data['url']=I('url');
          $data['des']=I('des');
          if($link->create($data)){
               if($link->add()){
                 $this->success('添加链接成功',U('lst'));
               }else{
                $this->error('添加链接失败');
               }
          }else{
            $this->error($link->getError());
          }
       }else{
        $this->display();
       }
       
     }
     public function edit(){
         if(IS_POST){
          $link=D('link');
          $data['title']=I('title');
          $data['id']=I('id');
          $data['url']=I('url');
          $data['des']=I('des');
          if($link->create($data)){
               if($link->save()!==false){
                 $this->success('链接修改成功',U('lst'));
               }else{
                // $sql=$link->getLastSql();
                // echo $sql;die;
                $this->error('链接修改失败');
               }
          }else{
            $this->error($link->getError());
          }
       }else{
          $link=D('link');
          $link=$link->find(I('id'));
          $this->assign('link',$link);
          $this->display();
        }
     }
     public function del(){
          $link=D('link');
          $id=I('id');
          if($link->delete($id)){
            $this->success('链接删除成功',U('lst'));
          }else{
            $this->error('链接删除失败');
          }
     }
     public  function bdel(){
          $link=D('link');
          $ids=I('ids');
          $ids=implode(',',$ids);
          if($link->delete($ids)){
            $this->success('链接批量删除成功',U('lst'));
          }else{
            $this->error('链接批量删除失败');
          }
     }
}