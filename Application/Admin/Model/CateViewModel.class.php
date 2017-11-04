<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel{
    public $viewFields = array(     
      'article'=>array('id','cateid','title','rem','pic'),     
      'cate'=>array('name', '_on'=>'article.cateid=cate.id')     
    );
    
}
