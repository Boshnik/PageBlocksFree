<?php
$xpdo_meta_map['pbTable']= array (
  'package' => 'pageblocks',
  'version' => '1.1',
  'table' => 'pb_tables',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'name' => '',
    'menuindex' => 0,
    'published' => 1,
  ),
  'fieldMeta' => 
  array (
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
      'attributes' => 'unsigned',
      'phptype' => 'integer',
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
      'index' => 'index',
    ),
  ),
  'indexes' => 
  array (
    'published' => 
    array (
      'alias' => 'published',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'published' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'Fields' => 
    array (
      'class' => 'pbField',
      'local' => 'id',
      'foreign' => 'model_id',
      'cardinality' => 'many',
      'owner' => 'local',
      'criteria' => 
      array (
        'foreign' => 
        array (
          'model_type' => 'pbTable',
        ),
      ),
    ),
    'Tabs' => 
    array (
      'class' => 'pbFieldTab',
      'local' => 'id',
      'foreign' => 'model_id',
      'cardinality' => 'many',
      'owner' => 'local',
      'criteria' => 
      array (
        'foreign' => 
        array (
          'model_type' => 'pbTable',
        ),
      ),
    ),
    'Columns' => 
    array (
      'class' => 'pbTableColumn',
      'local' => 'id',
      'foreign' => 'model_id',
      'cardinality' => 'many',
      'owner' => 'local',
      'criteria' => 
      array (
        'foreign' => 
        array (
          'model_type' => 'pbTable',
        ),
      ),
    ),
  ),
);
