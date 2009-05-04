<?php
/**
 * Upload files to a directory
 *
 * @param string $dir The target directory
 * @param boolean $prependPath (optional) If true, will prepend rb_base_dir to
 * the final path
 *
 * @package modx
 * @subpackage processors.browser.directory
 */
$modx->lexicon->load('file');

if (!$modx->hasPermission('file_manager')) return $modx->error->failure($modx->lexicon('permission_denied'));

if (!isset($_POST['dir']) || $_POST['dir'] == '')
	return $modx->error->failure($modx->lexicon('file_folder_err_ns'));

$d = isset($_POST['prependPath']) && $_POST['prependPath'] != 'null' && $_POST['prependPath'] != null
    ? $_POST['prependPath']
    : $modx->config['base_path'].$modx->config['rb_base_dir'];
$directory = realpath($d.$_POST['dir']);

if (!is_dir($directory)) return $modx->error->failure($modx->lexicon('file_folder_err_invalid'));
if (!is_readable($directory) || !is_writable($directory)) {
	return $modx->error->failure($modx->lexicon('file_folder_err_perms_upload'));
}

foreach ($_FILES as $file) {
	if ($file['error'] != 0) continue;
	if ($file['name'] == '') continue;

	$newloc = strtr($directory.'/'.$file['name'],'\\','/');

	if (!@move_uploaded_file($file['tmp_name'],$newloc)) {
		return $modx->error->failure($modx->lexicon('file_err_upload'));
	}
}

return $modx->error->success();