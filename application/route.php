<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    //admin_index↓
    'admin/login/' => 'admin/index/login',
    'admin/login_action/' =>'admin/index/login_action',
    'admin/logout/'=>'admin/index/logout',

    'admin/administrator/update/:id' => 'admin/Administrator/update',
    'admin/administrator/:id' =>'admin/Administrator/read',

    'admin/administrator/add' =>'admin/Administrator/add',
    'admin/administrator/create' =>'admin/Administrator/create',
    'admin/administrator/delete'=>'admin/Administrator/delete',
];
