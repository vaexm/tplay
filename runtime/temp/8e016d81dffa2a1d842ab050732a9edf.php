<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\phpStudy\WWW\tplay\public/../app/admin\view\admin\admincate.html";i:1513993331;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="__PUBLIC__/layui/css/layui.css"  media="all">
  <link rel="stylesheet" href="__PUBLIC__/font-awesome/css/font-awesome.min.css" media="all" />
  <link rel="stylesheet" href="__CSS__/admin.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;border:0"> 
<div class="layui-btn-group demoTable">
  <a href="<?php echo url('admin/admin/adminCatePublish'); ?>" class="a_menu">
    <button class="layui-btn layui-btn-sm"><i class="fa fa-edit"> </i>添加新角色</button>
  </a>
</div>
</fieldset>
<table class="layui-table" lay-even="" lay-skin="row" lay-size="sm">
  <thead>
    <tr>
      <th>编号</th>
      <th>角色名称</th>
      <th>权限预览</th>
      <th>创建时间</th>
      <th>修改时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $vo['id']; ?></td>
      <td><?php echo $vo['name']; ?></td>
      <td><a href="javascript:;">点击查看</a></td>
      <td><?php echo $vo['create_time']; ?></td>
      <td><?php echo $vo['update_time']; ?></td>
      <td class="operation-menu">
        <a href="<?php echo url('admin/admin/adminCatePublish',['id'=>$vo['id']]); ?>" class="a_menu"><button class="layui-btn layui-btn-xs" ><i class="layui-icon"></i></button></a>
        <button class="layui-btn layui-btn-xs delete" id="<?php echo $vo['id']; ?>"><i class="layui-icon"></i></button>
      </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
<div style="padding:0 20px;"><?php echo $cate->render(); ?></div>
        
<script src="__PUBLIC__/layui/layui.js" charset="utf-8"></script>
<script src="__PUBLIC__/jquery/jquery.min.js"></script>
<script>
        var message;
        layui.config({
            base: '__JS__/',
            version: '1.0.1'
        }).use(['app', 'message'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
        });
    </script> 
<script type="text/javascript">

$('.delete').click(function(){
  var id = $(this).attr('id');
  layer.confirm('确定要删除?', function(index) {
    $.ajax({
      url:"<?php echo url('admin/admin/adminCateDelete'); ?>",
      data:{id:id},
      success:function(res) {
        layer.msg(res.msg);
        if(res.code == 1) {
          setTimeout(function(){
            location.href = res.url;
          },1500)
        }
      }
    })
  })
})
</script>
<script type="text/javascript">
$('.a_menu').click(function(){
  var url = $(this).attr('href');
  var id = $(this).attr('id');
  var a = true;
  if(id) {
    $.ajax({
      url:url
      ,async:false
      ,data:{id:id}
      ,success:function(res){
        if(res.code == 0) {
          layer.msg(res.msg);
          a = false;
        }
      }
    })
  } else {
    $.ajax({
      url:url
      ,async:false
      ,success:function(res){
        if(res.code == 0) {
          layer.msg(res.msg);
          a = false;
        }
      }
    })
  }
  return a;
})
</script>
</body>
</html>
