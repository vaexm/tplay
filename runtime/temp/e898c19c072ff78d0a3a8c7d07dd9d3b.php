<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"E:\phpStudy\WWW\tplay\public/../app/admin\view\admin\editpassword.html";i:1513993331;}*/ ?>
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
    <label class="layui-form-label">原密码</label>
    <div class="layui-input-inline">
      <input name="password_old" lay-verify="pass" placeholder="请输入原密码" autocomplete="off" class="layui-input" type="password">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">新密码</label>
    <div class="layui-input-inline">
      <input name="password" lay-verify="pass" placeholder="请输入新密码" autocomplete="off" class="layui-input" type="password">
    </div>
    <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">重复新密码</label>
    <div class="layui-input-inline">
      <input name="password_confirm" lay-verify="pass" placeholder="请再次输入新密码" autocomplete="off" class="layui-input" type="password">
    </div>
  </div>

  <input type="hidden" name="id" value="<?php echo $cookie['id']; ?>">
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="admin">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  
</form>


<script src="__PUBLIC__/layui/layui.js"></script>
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
<script>
  layui.use(['layer', 'form'], function() {
      var layer = layui.layer,
          $ = layui.jquery,
          form = layui.form;
      $(window).on('load', function() {
          form.on('submit(admin)', function(data) {
              $.ajax({
                  url:"<?php echo url('admin/admin/editPassword'); ?>",
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
</body>
</html>