<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model {
    protected $_validate =array(
     array('title','require','文章标题不能为空',1),
     array('title','','文章标题不能重复',1,'unique',1),
     array('content','require','文章内容不能为空',1),
     array('cateid','require','文章分类不能为空',1)
    );

}