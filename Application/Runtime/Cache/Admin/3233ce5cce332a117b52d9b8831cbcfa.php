<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_PUC;?>/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_PUC;?>/css/main.css"/>
    <script type="text/javascript" src="<?php echo ADMIN_PUC;?>/js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_PUC;?>/js/jquery-1.11.3.js"></script>
    
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="http://www.jscss.me">管理员</a></li>
                <li><a href="http://www.jscss.me">修改密码</a></li>
                <li><a href="http://www.jscss.me">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
     <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php/Admin/Cate/lst"><i class="icon-font">&#xe008;</i>栏目管理</a></li>
                        <li><a href="/index.php/Admin/Article/lst"><i class="icon-font">&#xe005;</i>文章管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">文章管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/jscss/admin/design/index" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="">全部</option>
                                    <option value="19">精品界面</option><option value="20">推荐界面</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform"  id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Article/add" class="btn btn-primary btn2"><i class="icon-font"></i>新增文章</a>
                        <a id="batchDel" ><i class="icon-font" ></i><input formaction="/index.php/Admin/Article/bdel"  class="btn btn-primary btn2" type="submit" value="批量删除"></a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" id="check"  type="checkbox" ></th>
                            <th>ID</th>
                            <th>文章标题</th>
                            <th>是否推荐</th>
                            <th>缩略图</th>
                            <th>所属栏目</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td class="tc"><input name="ids[]" class='check' value="<?php echo ($vo["id"]); ?>" type="checkbox"></td>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td title="发哥经典"><a target="_blank" href="#" title="发哥经典"><?php echo ($vo["title"]); ?></a>
                                </td>
                                <td>
                                <?php if($vo['rem'] == 1): ?>推荐
                                <?php else: ?>
                                未推荐<?php endif; ?>
                                </td>
                                <td>
                                <?php if($vo['pic'] != ''): ?><img src="/<?php echo ($vo["pic"]); ?>" alt="" width="60px"></td>
                                <?php else: ?>
                                暂无缩略图<?php endif; ?>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td>
                                    <a class="link-update" href="/index.php/Admin/Article/edit/id/<?php echo ($vo["id"]); ?>">修改</a>
                                    <a class="link-del" href="/index.php/Admin/Article/del/id/<?php echo ($vo["id"]); ?>" onclick="return confirm('确定要删除文章吗？')">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <div class="list-page"><?php echo ($page); ?></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//jqurty点击批量选中全部的checkbox
$('#check').click(function(){
    if($(this).is(':checked')){
        //$(this).attr('checked')  jquery1.6之前没问题，之后不能用了
        $('.check').prop('checked',true);
    }else{
        $('.check').removeAttr('checked');
    }
})

//原生js点击批量选中全部的checkbox
//   function checkall(form) {
//     for(var i = 0;i < form.elements.length; i++) {
//         var e = form.elements[i];
//         if (e.name != 'chkall' && e.disabled != true) {
//             e.checked = form.chkall.checked;
//         }
//     }
// }
</script>
</body>
</html>