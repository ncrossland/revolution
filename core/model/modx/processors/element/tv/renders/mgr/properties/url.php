<?php
/**
 * @package modx
 * @subpackage processors.element.tv.renders.mgr.properties
 */

// handles image fields using htmlarea image manager
$modx->smarty->assign('base_url',$this->xpdo->config['base_url']);
return $modx->smarty->fetch('element/tv/renders/properties/url.tpl');