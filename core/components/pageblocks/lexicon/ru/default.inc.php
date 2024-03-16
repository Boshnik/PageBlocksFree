<?php
include_once 'block.inc.php';
include_once 'table.inc.php';
include_once 'field.inc.php';
include_once 'tab.inc.php';
include_once 'image.inc.php';
include_once 'video.inc.php';
include_once 'button.inc.php';

$_lang['pageblocks'] = 'PageBlocks';
$_lang['pb_menu_desc'] = 'Конструктор блоков.';
$_lang['pb_intro_msg'] = 'Вы можете выделять сразу несколько предметов при помощи Shift или Ctrl.';

$_lang['pb_constrtuctor'] = 'Конструктор блоков';
$_lang['pb_collections'] = 'Коллекции';
$_lang['pb_ready_blocks'] = 'Готовые блоки';
$_lang['pb_create_ready_block'] = 'Добавить готовый блок';
$_lang['pb_license'] = 'Лицензия';
$_lang['pb_license_error'] = 'Компонент используется без лицензии. <br> Для законного использования приобретите лицензию.';
$_lang['pb_license_description'] = 'Ваш ключ лицензии: <br><b>[[+key]]</b>.<br> Хотите сбросить лицензию?';
$_lang['pb_reset_license'] = 'Лицензию можно сбросить только один раз и вы не сможете обновить компонент для текущего сайта. Вы уверены что хотите сбросить лицензию?';
$_lang['pb_docs'] = 'Документация';

$_lang['pb_row_create'] = 'Создать';
$_lang['pb_row_update'] = 'Изменить';
$_lang['pb_row_copy'] = 'Копировать';
$_lang['pb_row_copy_confirm'] = 'Вы действительно хотите скопировать элемент?';
$_lang['pb_row_enable'] = 'Включить';
$_lang['pb_rows_enable'] = 'Включить выбранные элементы';
$_lang['pb_row_disable'] = 'Отключить';
$_lang['pb_rows_disable'] = 'Отключить выбранные элементы';
$_lang['pb_row_remove'] = 'Удалить';
$_lang['pb_rows_remove'] = 'Удалить выбранные элементы';
$_lang['pb_row_remove_title'] = 'Удаление';
$_lang['pb_row_remove_confirm'] = 'Вы уверены, что хотите удалить этот элемент?';
$_lang['pb_rows_remove_confirm'] = 'Вы уверены, что хотите удалить эти элементы?';
$_lang['pb_row_active'] = 'Включено';
$_lang['pb_row_published'] = 'Опубликован';
$_lang['pb_row_restore'] = 'Восстановить';
$_lang['pb_rows_restore'] = 'Вы уверены, что хотите восстановить эти элементы?';
$_lang['pb_row_restore_title'] = 'Восстановление';
$_lang['pb_row_view'] = 'Просмотр';

$_lang['pb_grid_id'] = 'Id';
$_lang['pb_grid_name'] = 'Название';
$_lang['pb_grid_active'] = 'Активно';
$_lang['pb_grid_published'] = 'Опубликован';
$_lang['pb_grid_search'] = 'Поиск';
$_lang['pb_grid_actions'] = 'Действия';
$_lang['pb_grid_render'] = 'Рендер';
$_lang['pb_grid_width'] = 'Ширина (px)';
$_lang['pb_grid_createdby'] = 'Пользователь';
$_lang['pb_grid_createdon'] = 'Создано';

$_lang['pb_import'] = 'Импорт';
$_lang['pb_export'] = 'Экспорт';

$_lang['pb_object_err_field'] = 'Поле не может быть пустым';
$_lang['pb_object_err_name'] = 'Вы должны указать имя блока.';
$_lang['pb_object_err_ae'] = 'Объект с таким именем уже существует.';
$_lang['pb_object_err_nfs'] = 'Объект не найден.';
$_lang['pb_object_err_ns'] = 'Объект не указан.';
$_lang['pb_object_err_remove'] = 'Ошибка при удалении.';
$_lang['pb_object_err_save'] = 'Ошибка при сохранении.';
$_lang['pb_object_err_name_cyrillic'] = 'Ошибка в названии.';