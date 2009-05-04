<?php
/**
 * @package modx
 * @subpackage mysql
 */
$xpdo_meta_map['modAccessResource']= array (
  'package' => 'modx',
  'table' => 'access_resources',
  'fields' => 
  array (
    'context_key' => '',
  ),
  'fieldMeta' => 
  array (
    'context_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'fk',
    ),
  ),
  'aggregates' => 
  array (
    'Target' => 
    array (
      'class' => 'modResource',
      'local' => 'target',
      'foreign' => 'id',
      'owner' => 'foreign',
      'cardinality' => 'one',
    ),
  ),
);
if (XPDO_PHP4_MODE) $xpdo_meta_map['modAccessResource']['aggregates']= array_merge($xpdo_meta_map['modAccessResource']['aggregates'], array_change_key_case($xpdo_meta_map['modAccessResource']['aggregates']));
$xpdo_meta_map['modaccessresource']= & $xpdo_meta_map['modAccessResource'];