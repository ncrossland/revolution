<?php
/**
 * Duplicate a TV.
 *
 *
 * @param integer $id The ID of the tv to duplicate.
 * @param string $name (optional) The name of the new tv. Defaults to Untitled
 * TV.
 *
 * @package modx
 * @subpackage processors.element.template
 */
$modx->lexicon->load('template');

if (!$modx->hasPermission('new_template')) return $modx->error->failure($modx->lexicon('permission_denied'));

/* get old template */
$old_template = $modx->getObject('modTemplate',$_REQUEST['id']);
if ($old_template == null) {
    return $modx->error->failure($modx->lexicon('template_err_not_found'));
}
$newname = isset($_POST['name'])
    ? $_POST['name']
    : $modx->lexicon('duplicate_of').$old_template->get('templatename');

/* duplicate template */
$template = $modx->newObject('modTemplate');
$template->set('templatename',$newname);
$template->fromArray($old_template->toArray());

if ($template->save() === false) {
	return $modx->error->failure($modx->lexicon('template_err_duplicate'));
}

/* log manager action */
$modx->logManagerAction('template_duplicate','modTemplate',$template->get('id'));

return $modx->error->success('',$template->get(array_diff(array_keys($template->_fields), array('content'))));