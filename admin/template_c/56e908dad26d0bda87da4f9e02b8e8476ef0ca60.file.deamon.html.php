<?php /* Smarty version Smarty-3.1.18, created on 2014-08-22 17:20:03
         compiled from "/www/admin/template/deamon.html" */ ?>
<?php /*%%SmartyHeaderCode:91090424453f708c0185329-17480695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56e908dad26d0bda87da4f9e02b8e8476ef0ca60' => 
    array (
      0 => '/www/admin/template/deamon.html',
      1 => 1408699196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91090424453f708c0185329-17480695',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53f708c03d2e76_22056182',
  'variables' => 
  array (
    'deamons' => 0,
    'deamon' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f708c03d2e76_22056182')) {function content_53f708c03d2e76_22056182($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<table>
    <tr><td>process</td><td>pid</td><td>op</td></tr>
<?php  $_smarty_tpl->tpl_vars['deamon'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['deamon']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deamons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['deamon']->key => $_smarty_tpl->tpl_vars['deamon']->value) {
$_smarty_tpl->tpl_vars['deamon']->_loop = true;
?>
   <tr><td><?php echo $_smarty_tpl->tpl_vars['deamon']->value['name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['deamon']->value['pid'];?>
</td><td><a href="#" >启动|停止</a></td></tr>
<?php } ?>
</table>
</body>
</html><?php }} ?>
