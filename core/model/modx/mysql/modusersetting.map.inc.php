<?php
/**
 * @package modx
 * @subpackage mysql
 */
$xpdo_meta_map['modUserSetting']= array (
  'package' => 'modx',
  'table' => 'user_settings',
  'fields' => 
  array (
    'user' => 0,
    'key' => '',
    'value' => NULL,
    'xtype' => 'textfield',
    'namespace' => 'core',
    'area' => '',
    'editedon' => NULL,
  ),
  'fieldMeta' => 
  array (
    'user' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'pk',
    ),
    'value' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
    ),
    'xtype' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '75',
      'phptype' => 'string',
      'null' => false,
      'default' => 'textfield',
    ),
    'namespace' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '40',
      'phptype' => 'string',
      'null' => false,
      'default' => 'core',
    ),
    'area' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'editedon' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => false,
      'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
    ),
  ),
  'aggregates' => 
  array (
    'modUser' => 
    array (
      'class' => 'modUser',
      'key' => 'id',
      'local' => 'user',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
if (XPDO_PHP4_MODE) $xpdo_meta_map['modUserSetting']['aggregates']= array_merge($xpdo_meta_map['modUserSetting']['aggregates'], array_change_key_case($xpdo_meta_map['modUserSetting']['aggregates']));
$xpdo_meta_map['modusersetting']= & $xpdo_meta_map['modUserSetting'];