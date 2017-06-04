<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"D:\myblog\public/../application/admin\view\index\login.html";i:1495596442;}*/ ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="__PUBLIC__/css/login.css">
    <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
    <script src="__PUBLIC__/js/jquery-1.11.2.min.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
</head>
<body background="__IMAGES__/login_bg.jpg">

<div class="login_center">

<form class="form-inline" action="/admin/login_action" method="post">
    <div class="form-group">
        <input type="text" name="username" class="form-control"  id="exampleInputEmail3" placeholder="admin">
    </div>
    <div class="form-group">
        <input type="password" name="pwd" class="form-control" id="exampleInputPassword3" placeholder="Password">
    </div>
    <br/>
    <div class="button_left"><button type="submit" class="btn btn-default">登录</button><div class="button_right"><a href="#">忘记密码?</a></div></div>
</form>

</div>
</body>
</html>