<?php
namespace Admin\Model;
use Think\Model;
class LinkModel extends Model {
    protected   $_validate=array(
          array('title','require','链接标题必须填写'), //默认情况下用正则进行验证
          array('title','','链接标题已经存在！',0,'unique',1), // 在新增的时候验证title字段是否唯一
          array('url','require','链接标题必须填写'),
      );
}