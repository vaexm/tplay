<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\phpStudy\WWW\tplay\public/../application/admin\view\emailconfig\index.html";i:1513993546;}*/ ?>
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
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div style="margin-top: 20px;">
</div>
<form class="layui-form" id="admin">
  
 
  <div class="layui-form-item">
    <label class="layui-form-label">发件箱</label>
    <div class="layui-input-inline">
      <input name="from_email" type="text" lay-verify="email" autocomplete="off" class="layui-input" value="<?php echo $data['from_email']; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">发件人</label>
    <div class="layui-input-inline">
      <input name="from_name" lay-verify="pass" autocomplete="off" class="layui-input" type="text" value="<?php echo $data['from_name']; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">smtp服务器</label>
    <div class="layui-input-inline">
      <input name="smtp" type="text" lay-verify="pass" autocomplete="off" class="layui-input" value="<?php echo $data['smtp']; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">登录账号</label>
    <div class="layui-input-inline">
      <input name="username" type="text" lay-verify="email" autocomplete="off" autocomplete="off" class="layui-input" value="<?php echo $data['username']; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">登录密码</label>
    <div class="layui-input-inline">
      <input type="password" name="password" lay-verify="pass" autocomplete="off" class="layui-input" value="<?php echo $data['password']; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">邮件标题</label>
    <div class="layui-input-block"  style="max-width: 400px">
      <input name="title" lay-verify="pass" autocomplete="off" class="layui-input" type="text" value="<?php echo $data['title']; ?>">
    </div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">邮件模板</label>
    <div class="layui-input-block" style="max-width:800px;">
      <textarea placeholder="请输入内容" class="layui-textarea" name="content" id="container" style="border:0;padding:0"><?php echo $data['content']; ?></textarea>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="admin">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      <button class="layui-btn layui-btn-normal" id="mailto">发送测试</button>
    </div>
  </div>
</form>

<div class="layui-form-item">
  <div class="layui-input-block">
  </div>
</div>

<script src="__PUBLIC__/layui/layui.js"></script>
<script src="__PUBLIC__/jquery/jquery.min.js"></script>
<script>
  layui.use(['layer', 'form'], function() {
      var layer = layui.layer,
          $ = layui.jquery,
          form = layui.form;
      $(window).on('load', function() {
          form.on('submit(admin)', function(data) {
              $.ajax({
                  url:"<?php echo url('admin/emailconfig/publish'); ?>",
                  data:$('#admin').serialize(),
                  type:'post',
                  async: false,
                  success:function(res) {
                      if(res.code == 1) {
                          layer.alert(res.msg, function(index){
                            location.href = res.url;
                          })
                      } else {
                          layer.msg(res.msg);
                      }
                  }
              })
              return false;
          });
      });
  });
</script>

<!-- 加载编辑器的容器 -->
<script id="container" name="content" type="text/plain">
    这里写你的初始化内容
</script>
<!-- 配置文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>

<script type="text/javascript">
  layui.use('layer', function(){
    var layer = layui.layer;
    var email;
    $('#mailto').click(function(){
      layer.prompt({
        formType: 0,
        value: '',
        title: '请输入邮箱地址,不要重复点确定键'
      }, function(value, index, elem){
        email = value;
        // if(email = null) {
        //   layer.msg('收件箱不能为空');
        //   return false;
        // }
        $.ajax({
          url:"<?php echo url('admin/emailconfig/mailto'); ?>"
          ,type:'post'
          ,data:{email:email}
          ,success:function(res) {
            layer.msg(res.msg);
            if(res.code == 1) {
              layer.close(index);
            }
          }
        })
      });
      return false;
    })
  });              
</script>
</body>
</html>