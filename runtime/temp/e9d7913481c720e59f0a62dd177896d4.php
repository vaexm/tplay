<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\phpStudy\WWW\tplay\public/../app/admin\view\admin\index.html";i:1513993331;}*/ ?>
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
  <style type="text/css">

/* tooltip */
#tooltip{
  position:absolute;
  border:1px solid #ccc;
  background:#333;
  padding:2px;
  display:none;
  color:#fff;
}
</style>
</head>
<body>

<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;border:0"> 
<div class="layui-btn-group demoTable">
  <a href="<?php echo url('admin/publish'); ?>" class="a_menu">
    <button class="layui-btn layui-btn-sm"><i class="fa fa-edit"> </i>添加管理员</button>
  </a>
</div>
</fieldset>
<table class="layui-table" lay-even="" lay-skin="row" lay-size="sm">
  <colgroup>
    <col width="50">
    <col width="80">
    <col width="100">
    <col width="150">
    <col width="150">
    <col width="200">
    <col width="200">
    <col width="200">
    <col width="100">
  </colgroup>
  <thead>
    <tr>
      <th>ID</th>
      <th>头像</th>
      <th>角色</th>
      <th>用户名</th>
      <th>昵称</th>
      <th>创建时间</th>
      <th>最后登录时间</th>
      <th>最后登录IP</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    <?php if(is_array($admin) || $admin instanceof \think\Collection || $admin instanceof \think\Paginator): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $vo['id']; ?></td>
      <td><a href="<?php echo geturl($vo['thumb']); ?>" class="tooltip"><img src="<?php echo geturl($vo['thumb']); ?>" width="20" height="20"></a></td>
      <td><?php echo $vo['admincate']['name']; ?></td>
      <td><?php echo $vo['name']; ?></td>
      <td><?php echo $vo['nickname']; ?></td>
      <td><?php echo $vo['create_time']; ?></td>
      <td><?php echo date("Y-m-d H:i:s",$vo['login_time']); ?></td>
      <td><?php echo $vo['login_ip']; ?></td>
      <td class="operation-menu">
        <a href="<?php echo url('admin/publish',['id'=>$vo['id']]); ?>" class="a_menu" id="<?php echo $vo['id']; ?>"><button class="layui-btn layui-btn-xs" ><i class="layui-icon"></i></button></a>
        <button class="layui-btn layui-btn-xs delete" id="<?php echo $vo['id']; ?>"><i class="layui-icon"></i></button>
      </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
<div style="padding:0 20px;"><?php echo $admin->render(); ?></div>
        
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
$(function(){
  var x = 10;
  var y = 20;
  $(".tooltip").mouseover(function(e){ 
    var tooltip = "<div id='tooltip'><img src='"+ this.href +"' alt='产品预览图' height='200'/>"+"<\/div>"; //创建 div 元素
    $("body").append(tooltip);  //把它追加到文档中             
    $("#tooltip")
      .css({
        "top": (e.pageY+y) + "px",
        "left":  (e.pageX+x)  + "px"
      }).show("fast");    //设置x坐标和y坐标，并且显示
    }).mouseout(function(){  
    $("#tooltip").remove();  //移除 
    }).mousemove(function(e){
    $("#tooltip")
      .css({
        "top": (e.pageY+y) + "px",
        "left":  (e.pageX+x)  + "px"
      });
  });
})

$('.delete').click(function(){
  var id = $(this).attr('id');
  layer.confirm('确定要删除?', function(index) {
    $.ajax({
      url:"<?php echo url('admin/admin/delete'); ?>",
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
