<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:08:33
         compiled from "application/views/index/Home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19571744024d192a810de551-23813920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ea7286e02b62b89557147c35868090e09d1391a' => 
    array (
      0 => 'application/views/index/Home.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '19571744024d192a810de551-23813920',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_icon')) include 'lib/smarty/plugins/function.icon.php';
?><!--<div class="grid_3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ligula risus, volutpat id euismod sit amet, rhoncus at magna. Ut interdum nunc in libero lobortis ac iaculis nunc egestas. Nullam molestie tempor tristique. Integer et imperdiet lectus. Integer tempor ullamcorper varius. Aenean egestas fermentum suscipit. Aliquam at ante nec quam interdum tincidunt vitae ut urna. Mauris molestie lectus ut lectus placerat iaculis. Curabitur ultricies interdum bibendum. Quisque enim odio, vulputate sit amet vehicula vel, molestie in eros. Praesent vel dapibus neque. Suspendisse potenti. Curabitur condimentum dignissim urna a viverra. </div>

<div class="grid_5">
    <div class="grid_12" >Suspendisse augue ante, faucibus eu porttitor ut, luctus sed nisi. Aliquam erat volutpat. Nulla ornare ultricies dignissim. Donec elementum dui a tortor luctus feugiat eu nec neque. Quisque a placerat sapien. Etiam non sodales purus. Donec a erat ante. Curabitur vitae placerat erat. Morbi id massa in lectus tincidunt sagittis. Donec fringilla nibh semper libero ultricies eu varius nibh ultrices.</div> 
    <div class="clear"></div>
    <br />
    <div class="grid_7">Vestibulum pellentesque faucibus sem et aliquet. Praesent nulla ligula, placerat eget hendrerit in, ultrices non mauris. Nullam lobortis eros ut ante gravida ut tincidunt ante ultrices. Suspendisse justo diam, ultricies sit amet semper ut, ultrices at lacus. Duis volutpat pulvinar luctus. Vestibulum iaculis auctor dictum. In sed gravida elit. Cras convallis tellus id quam pellentesque venenatis ultrices purus rhoncus. Curabitur blandit ullamcorper quam vel ultrices. Phasellus et elit eu odio ultrices hendrerit id non diam. Curabitur lobortis lacus in ante molestie eget blandit augue vestibulum. Phasellus enim nisl, pulvinar ut hendrerit eu, fermentum ut sapien. Suspendisse sit amet sollicitudin arcu. </div>
    
    <div class="grid_5">Integer sollicitudin justo sit amet felis adipiscing interdum. In hac habitasse platea dictumst. Phasellus fringilla mauris ac massa lacinia aliquam. Aliquam quis sapien at mi porta facilisis sed vitae erat. Vestibulum ac enim dui. Quisque vel augue neque. Integer tempus, libero sit amet consectetur varius, est leo hendrerit urna, in viverra nulla nulla sit amet libero. Phasellus ullamcorper risus eu enim ultricies porta. Vestibulum ultricies bibendum enim in ullamcorper. Vestibulum quis metus eros, nec sollicitudin leo. Mauris tincidunt, massa non eleifend accumsan, sem lectus lacinia dui, sit amet suscipit felis ipsum in erat. Mauris at sem augue, vitae tempus arcu. Morbi ornare nisl velit. Mauris quis nisi nibh. Pellentesque a ipsum ac tellus fermentum elementum. In sit amet sem augue. </div>
</div>

<div class="grid_4">

<?php echo smarty_function_icon(array('src'=>"pencil",'class'=>"tip",'title'=>"editar"),$_smarty_tpl->smarty,$_smarty_tpl);?>

Donec varius pellentesque massa ut pellentesque. Nam sit amet quam nisi, vitae imperdiet ipsum. Curabitur id turpis eu nibh vestibulum elementum at euismod tortor. Curabitur cursus lobortis volutpat. Aliquam aliquet, neque quis interdum rhoncus, odio nunc accumsan lectus, eu vehicula nisi eros vitae massa. Mauris aliquet nisi mattis nunc fringilla viverra. Vivamus congue tincidunt sagittis. Nulla sit amet mauris risus. Duis cursus pharetra nulla, eu facilisis est consectetur id. Duis dictum fringilla sagittis. Maecenas blandit porttitor lectus vitae sollicitudin. Nulla bibendum dolor ut erat consequat laoreet. </div>
-->
<link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/css/overlay.css' />
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/js/jquery/popup.js"></script>
<script type='text/javascript' src='<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/js/jquery/jquery.tools.min.js'></script>
<br><br><br>
<div class="grid_5">
	<h2>Bienvenido al Sistema de Registro de Planillas.</h2>	<br>
	<h3>Selecciona una opci&oacute;n del men&uacute; principal.</h3>
</div>

<div class="grid_13">
    <img src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/images/photos/srp.png">
</div>
<?php if ($_smarty_tpl->getVariable('popup')->value){?>
    <div id="overlay" class="center overlay">
        <div id="friday"><h2 id="popup_text"</h2></div>
        
        <table style="width: 300px;">
            <tr><td><b>Días Faltantes</b></td><td rowspan="14"><img src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/images/overlay/calendar.png" alt=""/></td></tr>
            <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('popup_dates')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
            <tr><td id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</td></tr>
            <?php }} ?>
            
        </table>
    </div>
<?php }?>