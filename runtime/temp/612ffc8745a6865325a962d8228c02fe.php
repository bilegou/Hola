<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:59:"D:\myblog\public/../application/admin\view\index\index.html";i:1496911180;s:54:"D:\myblog\public/../application/admin\view\layout.html";i:1495507201;s:54:"D:\myblog\public/../application/admin\view\header.html";i:1496314293;s:52:"D:\myblog\public/../application/admin\view\left.html";i:1496911059;s:54:"D:\myblog\public/../application/admin\view\footer.html";i:1496907917;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>admin</title>
    <link rel="stylesheet" href="__PUBLIC__/css/Administor_index.css">
    <link rel="stylesheet" href="__PUBLIC__/css/footer.css">
    <link rel="stylesheet" href="__PUBLIC__/css/admin_index.css">
    <link rel="stylesheet" href="__PUBLIC__/css/header.css">
    <link rel="stylesheet" href="__PUBLIC__/css/left.css">
    <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
    <script src="__PUBLIC__/js/jquery-1.11.2.min.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
</head>

<div class="header_control">
    <a href="#"><div class="user_info" style="line-height: 50px;">
        <div class="glyphicon glyphicon-user">&nbspadmin&nbsp</div><div class="glyphicon glyphicon-chevron-down"></div>
        <div class="username">
            <ul>
                <a href="#"> <li>个人信息</li></a>
                <a href="/admin/logout"><li>Exit</li></a>
            </ul>
        </div>
    </div>
    </a>
</div>

<body>
<div class="global_left">
    <div class="title_left">
        <a href="/admin" style="text-decoration: none"><div style="color:#00CCCC; font-size: 22px; text-align: center;line-height: 50px;border-bottom: 1px solid #EEEEEE;">Hola Blog <span style="font-size: 14px;color:#DDDDDD">&nbsp by &Sen</span></div></a>
    </div>
    <div class="nav_control">
        <div class="administer">
            <a href="#"><div class="adm_title" style="font-size: 18px">Administrator&nbsp&nbsp<div class="glyphicon glyphicon-chevron-down" id="plus_icon"></div></div></a>
            <ul id="admin">
                <li><a href="/admin/administrator">管理员列表</a></li>
                <li><a href="/admin/administrator/create" data-toggle="modal" data-target="#userCreate">新增管理员</a></li>
            </ul>
        </div>
        <div class="articles">
            <a  href="#"><div class="art_title" style="font-size: 18px"> Articles Management&nbsp&nbsp<div class="glyphicon glyphicon-chevron-down"></div></div></a>
            <ul id="article">
                <li><a href="/admin/articles">文章管理列表</a></li>
                <li><a href="/admin/articles/create">添加新文章</a></li>
            </ul>
        </div>
    </div>
</div>

</body>
<body>
<div class="control-label">
    <h3>Admin Panel<div class="glyphicon glyphicon-home"></div> </h3>
    <div class="nav_controller">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>

    <div class="panel_choice">
        <a href="/admin/administrator"><div class="admin_role">
            <div class="center_block">
            <div class="glyphicon glyphicon-user" style="font-size: 30px;">32</div>
            <div class="man_num">Number</div>
                </div>
        </div></a>

        <a href="/admin/articles"> <div class="admin_role">
            <div class="center_block">
            <div class="glyphicon glyphicon-book" style="font-size: 30px;">12</div>
            <div class="art_num">Articles</div>
                </div>
        </div></a>

        <a href="#"> <div class="admin_role">
            <div class="center_block">
            <div class="glyphicon glyphicon-calendar" style="font-size: 30px;">32</div>
            <div class="man_num">Calendar</div>
                </div>
        </div></a>

        </div>
    </div>
</div>
</body>


<body>
　<div class="footer_content">
    <div class="foot_content">
       <h4>made by Lcs&nbsp<small>---2017-05-24</small></h4>
        <h5>Thinks Bootsrap&ThinkPHP </h5>
    </div>
</div>
</body>
<script type="text/javascript">
    function deleteData(id){
        $.ajax({
            type:"POST",
            url:"<?php echo url('admin/administrator/delete'); ?>",
            data:{
                id:id,
            },
            success:function(data){
                    $('#reload'+data.id).remove();
            }
        });
    }

    function post_update($id){
        $.ajax({
            type:"POST",
            url:"<?php echo url('admin/administrator/update'); ?>",
            data:{
                id:id,
            }
        })
    }

    function deleteArticle(id){
        $.ajax({
            type:"POST",
            url:"<?php echo url('admin/articles/delete'); ?>",
            data:{
                id:id,
            },
            success:function(data){
                $('#reload'+data.id).remove();
            }
        });
    }
</script>

<script>
    $(".user_info").click(function(){
        $(".username").toggle(500);
    })

</script>

<script>
    $(".administer").click(function(){
        $("#admin").slideToggle(300);
    });

    $(".articles").click(function(){
        $("#article").slideToggle(300);
    });
</script>

<script>
    $("#path").change(function () {
        $("#docPath").val($(":file").val());
    });
</script>