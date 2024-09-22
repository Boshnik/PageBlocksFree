<?php
$xpdo_meta_map['pbFieldTab']= array (
  'package' => 'pageblocks',
  'version' => '1.1',
  'table' => 'pb_field_tabs',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'model_type' => 'pbBlock',
    'model_id' => 0,
    'name' => '',
    'menuindex' => 0,
    'published' => 1,
  ),
  'fieldMeta' => 
  array (
    'model_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => 'pbBlock',
    ),
    'model_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => true,
      'default' => 0,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'menuindex' => 
    array (
      'dbtype' => 'smallint',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'published' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 1,
    ),
  ),
  'composites' => 
  array (
    'Fields' => 
    array (
      'class' => 'pbField',
      'local' => 'id',
      'foreign' => 'tab_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
