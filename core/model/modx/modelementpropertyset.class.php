<?php
/**
 * Represents a modPropertySet relation to a specific modElement.
 * 
 * @package modx
 * @subpackage mysql
 */
class modElementPropertySet extends xPDOObject {
    function modElementPropertySet(& $xpdo) {
        $this->__construct($xpdo);
    }
    function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }

    /**
     * Returns related modElement instances based on the element_class column.
     */
    function & getOne($alias, $criteria= null, $cacheFlag= true) {
        if ($alias == 'Element') {
            $criteria = $this->xpdo->newQuery($this->get('element_class'), $criteria);
        }
        $object = parent :: getOne($alias, $criteria, $cacheFlag);
        return $object;
    }
}