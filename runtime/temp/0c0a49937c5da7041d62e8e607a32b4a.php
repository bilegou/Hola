<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:68:"D:\myblog\public/../application/admin\view\administrator\create.html";i:1496376540;s:54:"D:\myblog\public/../application/admin\view\layout.html";i:1495507201;s:54:"D:\myblog\public/../application/admin\view\header.html";i:1496314293;s:52:"D:\myblog\public/../application/admin\view\left.html";i:1495697511;s:58:"D:\myblog\public/../application/admin\view\edit_field.html";i:1496305103;s:54:"D:\myblog\public/../application/admin\view\footer.html";i:1496328136;}*/ ?>
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
        <div style="color:#00CCCC; font-size: 22px; text-align: center;line-height: 50px;border-bottom: 1px solid #EEEEEE;">Hola Blog <span style="font-size: 14px;color:#DDDDDD">&nbsp by Sen&Qian</span></div>
    </div>
    <div class="nav_control">
        <div class="administer">
            <a href="#"><div class="adm_title" style="font-size: 18px">Administrator&nbsp&nbsp<div class="glyphicon glyphicon-chevron-down" id="plus_icon"></div></div></a>
            <ul id="admin">
                <li><a href="#">Admin List</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModal">Add Admin</a></li>
            </ul>
        </div>
        <div class="articles">
            <a  href="#"><div class="art_title" style="font-size: 18px"> Articles Management&nbsp&nbsp<div class="glyphicon glyphicon-chevron-down"></div></div></a>
            <ul id="article">
                <li><a href="#">Aticles List</a></li>
                <li><a href="#">Add Article</a></li>
            </ul>
        </div>
    </div>
</div>

</body>
<body>

<div class="free_loop">
    <?php if(is_array($data['edit_field']) || $data['edit_field'] instanceof \think\Collection || $data['edit_field'] instanceof \think\Paginator): if( count($data['edit_field'])==0 ) : echo "" ;else: foreach($data['edit_field'] as $key=>$field): switch($name=$field['type']): case "text": ?>
    <div class="form-group">
        <?php if(isset($field['label']) AND $field['label']): ?><label><?php echo $field['label']; ?></label><?php endif; ?>
        <input type="<?php echo $field['type']; ?>"
               <?php if(isset($field['id']) AND $field['id']): ?>id="<?php echo $field['id']; ?>"<?php endif; if(isset($field['disabled']) AND $field['disabled']): ?>disabled=$field['disabled']<?php endif; ?>
        class="form-control"
        <?php if(isset($field['extra']['data']['format'])): ?>data-format="<?php echo $field['extra']['data']['format']; ?>"<?php endif; ?>
        name="<?php echo $key; ?>" value="<?php if(isset($item[$key])): ?><?php echo $item[$key]; endif; ?>">
        <?php if(isset($field['notes']) AND $field['notes']): ?><p class="help-block"><?php echo $field['notes']; ?></p><?php endif; ?>
    </div>
    <?php break; case "password": ?>
    <div class="form-group">
        <?php if(isset($field['label']) AND $field['label']): ?><label><?php echo $field['label']; ?></label><?php endif; ?>
        <input type="<?php echo $field['type']; ?>"
               <?php if(isset($field['id']) AND $field['id']): ?>id="<?php echo $field['id']; ?>"<?php endif; if(isset($field['disabled']) AND $field['disabled']): ?>disabled=$field['disabled']<?php endif; ?>
        class="form-control"
        name="<?php echo $key; ?>" value="<?php if(isset($item[$key])): ?><?php echo $item[$key]; endif; ?>">

        <?php if(isset($field['create'])): ?>
        <?php echo $field['create']; else: ?>
        <?php echo $field['notes']; endif; ?>
    </div>
    <?php break; case "file": if(isset($field['label']) AND $field['label']): ?><label><?php echo $field['label']; ?></label><?php endif; ?>
    <!--<input type="<?php echo $field['type']; ?>"-->
    <!--<?php if(isset($field['id']) AND $field['id']): ?>id="<?php echo $field['id']; ?>"<?php endif; ?>-->
    <!--<?php if(isset($field['disabled']) AND $field['disabled']): ?>disabled=$field['disabled']<?php endif; ?>-->
    <!--class="btn btn-default"-->
    <!--name="<?php echo $key; ?>">-->

    <div class="form-group">
        <div class="input-group">
            <input id="docPath" type="text" class="form-control" name="<?php echo $key; ?>">
            <span id="scan" style="position: relative" class="btn btn-primary input-group-addon">浏览<input id="path" style="width: 60px;height:40px; position: absolute;top:-6px;left: -4px;opacity: 0; filter:alpha(opacity=0)" class="form-control" type="<?php echo $field['type']; ?>"></span>
        </div>
    </div>
    <?php if(isset($item[$key]) AND $item[$key]!=""): ?>
    <a href="__UPLOADS__/<?php echo $item[$key]; ?>" target="_blank"><img src="__UPLOADS__/<?php echo $item[$key]; ?>" class="img-responsive img-thumbnail"></a>
    <a href="#" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>
    <?php endif; break; case "radio": ?>
    <div class="form-group">
            <?php if(isset($field['label'])): ?><label><?php echo $field['label']; ?></label><?php endif; ?>
        <div class="checkbox">
            <?php foreach($field['default'] as $ov=>$ol): ?>
            <label>
                <input type="<?php echo $field['type']; ?>" name="<?php echo $key; ?>"
                       <?php if(isset($field['disabled']) AND $field['disabled']): ?>disabled="disabled"<?php endif; ?>
                value="<?php echo $ov; ?>" <?php if((isset($item[$key]) && $item[$key] == $ol)): ?>
                checked="checked" <?php endif; ?>> <?php echo $ol; ?>
            </label>
            <?php endforeach; ?>
        </div>
        </div>
        <?php break; endswitch; endforeach; endif; else: echo "" ;endif; ?>

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

    function updateData($id){
        $.ajax({
            type:"POST",
            url:"<?php echo url('admin/administrator/index'); ?>",
            data:{
                id:id,
            },
            success:function(){

            }
        })
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