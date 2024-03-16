<?php
include_once 'block.inc.php';
include_once 'table.inc.php';
include_once 'field.inc.php';
include_once 'tab.inc.php';
include_once 'image.inc.php';
include_once 'video.inc.php';
include_once 'button.inc.php';

$_lang['pageblocks'] = 'PageBlocks';
$_lang['pb_menu_desc'] = 'Block-Konstruktor.';
$_lang['pb_intro_msg'] = 'Sie können mehrere Elemente gleichzeitig mit Shift oder Strg auswählen.';

$_lang['pb_constrtuctor'] = 'Block-Konstruktor';
$_lang['pb_collections'] = 'Sammlungen';
$_lang['pb_ready_blocks'] = 'Fertige Blöcke';
$_lang['pb_create_ready_block'] = 'Bereit-Block hinzufügen';
$_lang['pb_license'] = 'Lizenz';
$_lang['pb_license_error'] = 'Die Komponente wird ohne Lizenz verwendet. <br> Um sie rechtmäßig zu nutzen, erwerben Sie eine Lizenz.';
$_lang['pb_license_description'] = 'Ihr Lizenzschlüssel: <br><b>[[+key]]</b>.<br> Möchten Sie die Lizenz zurücksetzen?';
$_lang['pb_reset_license'] = 'Die Lizenz kann nur einmal zurückgesetzt werden, und Sie werden nicht in der Lage sein, das Komponente für die aktuelle Website zu aktualisieren. Sind Sie sicher, dass Sie die Lizenz zurücksetzen möchten?';
$_lang['pb_docs'] = 'Dokumentation';

$_lang['pb_row_create'] = 'Schaffen';
$_lang['pb_row_update'] = 'Ändern';
$_lang['pb_row_copy'] = 'Kopieren';
$_lang['pb_row_copy_confirm'] = 'Möchten Sie das Element wirklich kopieren?';
$_lang['pb_row_enable'] = 'Schalte ein';
$_lang['pb_rows_enable'] = 'Ausgewählte Elemente einschließen';
$_lang['pb_row_disable'] = 'Deaktivieren';
$_lang['pb_rows_disable'] = 'Ausgewählte Elemente deaktivieren';
$_lang['pb_row_remove'] = 'Löschen';
$_lang['pb_rows_remove'] = 'Markierte Einträge löschen';
$_lang['pb_row_remove_title'] = 'Entfernung';
$_lang['pb_row_remove_confirm'] = 'Möchten Sie dieses Element wirklich löschen?';
$_lang['pb_rows_remove_confirm'] = 'Möchten Sie diese Elemente wirklich entfernen?';
$_lang['pb_row_active'] = 'Inbegriffen';
$_lang['pb_row_published'] = 'Veröffentlicht';
$_lang['pb_row_restore'] = 'Wiederherstellen';
$_lang['pb_rows_restore'] = 'Sind Sie sicher, dass Sie diese Elemente wiederherstellen möchten?';
$_lang['pb_row_restore_title'] = 'Erholung';
$_lang['pb_row_view'] = 'Sicht';

$_lang['pb_grid_id'] = 'ID';
$_lang['pb_grid_name'] = 'Titel';
$_lang['pb_grid_active'] = 'Aktiv';
$_lang['pb_grid_published'] = 'Veröffentlicht';
$_lang['pb_grid_search'] = 'Suche';
$_lang['pb_grid_actions'] = 'Aktionen';
$_lang['pb_grid_render'] = 'Machen';
$_lang['pb_grid_width'] = 'Breite (px)';
$_lang['pb_grid_createdby'] = 'Benutzer';
$_lang['pb_grid_createdon'] = 'Erstellt';

$_lang['pb_import'] = 'Importieren';
$_lang['pb_export'] = 'Export';

$_lang['pb_object_err_field'] = 'Das Feld darf nicht leer sein.';
$_lang['pb_object_err_name'] = 'Sie müssen einen Blocknamen angeben.';
$_lang['pb_object_err_ae'] = 'Ein Block mit demselben Namen existiert bereits.';
$_lang['pb_object_err_nfs'] = 'Block nicht gefunden.';
$_lang['pb_object_err_ns'] = 'Block nicht angegeben.';
$_lang['pb_object_err_remove'] = 'Fehler beim Löschen eines Blocks.';
$_lang['pb_object_err_save'] = 'Fehler beim Speichern des Blocks.';
$_lang['pb_object_err_name_cyrillic'] = 'Namensfehler.';