<?php
include_once 'block.inc.php';
include_once 'table.inc.php';
include_once 'field.inc.php';
include_once 'tab.inc.php';
include_once 'image.inc.php';
include_once 'video.inc.php';
include_once 'button.inc.php';

$_lang['pageblocks'] = 'PageBlocks';
$_lang['pb_menu_desc'] = 'Block constructor.';
$_lang['pb_intro_msg'] = 'You can select multiple items by holding Shift or Ctrl button.';

$_lang['pb_constrtuctor'] = 'Block constructor';
$_lang['pb_collections'] = 'Collections';
$_lang['pb_ready_blocks'] = 'Ready blocks';
$_lang['pb_create_ready_block'] = 'Add ready block';
$_lang['pb_license'] = 'License';
$_lang['pb_license_error'] = 'The component is used without a license. <br> To use it legally, purchase a license.';
$_lang['pb_license_description'] = 'Your license key: <br><b>[[+key]]</b>.<br> Do you want to reset the license?';
$_lang['pb_reset_license'] = 'The license can be reset only once, and you won\'t be able to update the component for the current website. Are you sure you want to reset the license?';
$_lang['pb_docs'] = 'Docs';

$_lang['pb_row_create'] = 'Create';
$_lang['pb_row_update'] = 'Update';
$_lang['pb_row_copy'] = 'Copy';
$_lang['pb_row_copy_confirm'] = 'Are you sure you want to copy the element?';
$_lang['pb_row_enable'] = 'Enable';
$_lang['pb_rows_enable'] = 'Enable selected items';
$_lang['pb_row_disable'] = 'Disable';
$_lang['pb_rows_disable'] = 'Disable selected items';
$_lang['pb_row_remove'] = 'Remove';
$_lang['pb_rows_remove'] = 'Remove selected items';
$_lang['pb_row_remove_title'] = 'Removal';
$_lang['pb_row_remove_confirm'] = 'Are you sure you want to remove this item?';
$_lang['pb_rows_remove_confirm'] = 'Are you sure you want to remove this items?';
$_lang['pb_row_active'] = 'Active';
$_lang['pb_row_published'] = 'Published';
$_lang['pb_row_restore'] = 'Restore';
$_lang['pb_rows_restore'] = 'Are you sure you want to restore these items?';
$_lang['pb_row_restore_title'] = 'Recovery';
$_lang['pb_row_view'] = 'View';

$_lang['pb_grid_id'] = 'ID';
$_lang['pb_grid_name'] = 'Name';
$_lang['pb_grid_active'] = 'Active';
$_lang['pb_grid_published'] = 'Published';
$_lang['pb_grid_search'] = 'Search';
$_lang['pb_grid_actions'] = 'Actions';
$_lang['pb_grid_render'] = 'Render';
$_lang['pb_grid_width'] = 'Width (px)';
$_lang['pb_grid_createdby'] = 'User';
$_lang['pb_grid_createdon'] = 'Created';

$_lang['pb_import'] = 'Import';
$_lang['pb_export'] = 'Export';

$_lang['pb_object_err_field'] = 'The field cannot be empty';
$_lang['pb_object_err_name'] = 'You must specify a block name.';
$_lang['pb_object_err_ae'] = 'Block with the same name already exists.';
$_lang['pb_object_err_nfs'] = 'Block not found.';
$_lang['pb_object_err_ns'] = 'Block not specified.';
$_lang['pb_object_err_remove'] = 'Error when deleting a block.';
$_lang['pb_object_err_save'] = 'Error saving block.';
$_lang['pb_object_err_name_cyrillic'] = 'Field name error.';