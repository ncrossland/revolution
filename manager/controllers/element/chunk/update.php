<?php
/**
 * Load update chunk page
 *
 * @package modx
 * @subpackage manager.element.chunk
 */
if (!$modx->hasPermission('edit_chunk')) return $modx->error->failure($modx->lexicon('access_denied'));

/* grab chunk */
$chunk = $modx->getObject('modChunk',$_REQUEST['id']);
if ($chunk == null) {
        return $modx->error->failure(sprintf($modx->lexicon('chunk_err_id_not_found'),$_REQUEST['id']));
}

if ($chunk->get('locked') && !$modx->hasPermission('edit_locked')) {
    return $modx->error->failure($modx->lexicon('chunk_err_locked'));
}


/* grab category for chunk, assign to parser */
$category = $chunk->getOne('modCategory');
$modx->smarty->assign('chunk',$chunk);

/* assign RTE if being overridden */
$which_editor = isset($_POST['which_editor']) ? $_POST['which_editor'] : 'none';
$modx->smarty->assign('which_editor',$which_editor);


/* invoke OnChunkFormPrerender event */
$onChunkFormPrerender = $modx->invokeEvent('OnChunkFormPrerender',array('id' => $_REQUEST['id']));
if (is_array($onChunkFormPrerender)) {
	$onChunkFormPrerender = implode('',$onChunkFormPrerender);
}
$modx->smarty->assign('onChunkFormPrerender',$onChunkFormPrerender);


/* invoke OnChunkFormRender event */
$onChunkFormRender = $modx->invokeEvent('OnChunkFormRender',array('id' => $_REQUEST['id']));
if (is_array($onChunkFormRender)) {
	$onChunkFormRender = implode('', $onChunkFormRender);
}
$modx->smarty->assign('onChunkFormRender',$onChunkFormRender);


/* invoke OnRichTextEditorInit event */
if ($modx->config['use_editor'] == 1) {
	$onRTEInit = $modx->invokeEvent('OnRichTextEditorInit',array(
		'editor' => $which_editor,
		'elements' => array('post'),
	));
	if (is_array($onRTEInit))
		$onRTEInit = implode('', $onRTEInit);
	$modx->smarty->assign('onRTEInit',$onRTEInit);
}

/* check unlock default element properties permission */
$modx->smarty->assign('unlock_element_properties',$modx->hasPermission('unlock_element_properties') ? 1 : 0);


/* register JS scripts */
$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/widgets/core/modx.grid.local.property.js');
$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/widgets/element/modx.grid.element.properties.js');
$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/widgets/element/modx.panel.element.properties.js');
$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/widgets/element/modx.panel.chunk.js');
$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/sections/element/chunk/update.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
// <![CDATA[
Ext.onReady(function() {
    MODx.load({
        xtype: "modx-page-chunk-update"
        ,id: "'.$chunk->get('id').'"
        ,name: "'.$chunk->get('name').'"
        ,category: "'.$chunk->get('category').'"
    });
});
var onChunkFormRender = "'.$onChunkFormRender.'";
MODx.perm.unlock_element_properties = '.($modx->hasPermission('unlock_element_properties') ? 1 : 0).';
// ]]>
</script>');

/* display template */
return $modx->smarty->fetch('element/chunk/update.tpl');