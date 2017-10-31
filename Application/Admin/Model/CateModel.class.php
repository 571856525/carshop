<?php
namespace Admin\Model;
use Think\Model;
class CateModel extends Model {
    protected $_validate =array(
     array('name','require','栏目名称不能为空',1),
     array('name','','栏目名称不能重复',1,'unique',1)

    );
    public function catetree()
    {
    	$data=$this->select();
    	return $this->resort($data);
    }
    public function resort($data,$parentid=0,$level=0)
    {
          static $tree=array();
          foreach($data as $k=>$v)
          {
              if($v['parentid']==$parentid){
                  $v['level']=$level;
                  $tree[]=$v;
                  $this->resort($data,$v['id'],$level+1);
              }
          }
          return $tree;
    }
    public  function childIds($id){
      $data=$this->select();
      return $this->getChildIds($data,$id);
    }
    public function getChildIds($data,$parentid){
         static $ids=array();
         foreach($data as $k=>$v){
             if($v['parentid']==$parentid){
                 $ids[]=$v['id'];
                 $this->getChildIds($data,$v['id']);
             }
         }
       return $ids;
    }
    public function _before_delete($option)
    { 
       if(is_array($option['where']['id']))
       {
          //批量删除
          $ids=explode(',', $option['where']['id'][1]);
          $idAll=array();
          foreach ($ids as  $k=> $v) {
              $id=$this->childIds($v);
              $idAll=array_merge($idAll,$id);
          }
          $idAll=array_unique($idAll);
          $idAll=implode(',',$idAll);
       }else
       {
          //单个删除
          $ids=$this->childIds($option['where']['id']);
          $idAll=implode(',',$ids);
       }
       if($ids){
             $this->execute("delete from cs_cate where id in($idAll)");
        }
          
    }
}