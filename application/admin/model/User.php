<?php
namespace app\admin\model;
use think\Model;

class User extends Model
{
    protected $insert = ['status' => 1];
    protected $autoWriteTimestamp = true;
}