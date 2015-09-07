<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['menu']['0']['name'] = '文章';
$config['menu']['0']['0']['name'] = '添加文章';
$config['menu']['0']['0']['url'] = '/admin/article/add/';
$config['menu']['0']['1']['name'] = '文章列表';
$config['menu']['0']['1']['url'] = '/admin/article/lists/';
$config['menu']['0']['2']['name'] = '文章类别';
$config['menu']['0']['2']['url'] = '/admin/article/cat/';

$config['menu']['1']['name'] = '产品';
$config['menu']['1']['0']['name'] = '添加产品';
$config['menu']['1']['0']['url'] = '/admin/product/add/';
$config['menu']['1']['1']['name'] = '产品列表';
$config['menu']['1']['1']['url'] = '/admin/product/lists/';
$config['menu']['1']['2']['name'] = '产品分类';
$config['menu']['1']['2']['url'] = '/admin/product/cat/';

$config['menu']['2']['name'] = '系统';
$config['menu']['2']['0']['name'] = '导航菜单';
$config['menu']['2']['0']['url'] = '/admin/menu/';
$config['menu']['2']['1']['name'] = '单页管理';
$config['menu']['2']['1']['url'] = '/admin/single/';
$config['menu']['2']['2']['name'] = '模块修改';
$config['menu']['2']['2']['url'] = '/admin/module/';
$config['menu']['2']['3']['name'] = '服务器信息';
$config['menu']['2']['3']['url'] = '/admin/serverinfo/';

$config['menu']['3']['name'] = '用户';
$config['menu']['3']['0']['name'] = '修改用户名';
$config['menu']['3']['0']['url'] = '/admin/user/modifyname/';
$config['menu']['3']['1']['name'] = '修改密码';
$config['menu']['3']['1']['url'] = '/admin/user/modifypwd/';
