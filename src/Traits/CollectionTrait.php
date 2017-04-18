<?php

namespace Ortegacmanuel\ActivitystreamsLaravel\Traits;

/**
 * CollectionTrait
 * 
 * Implements setters/getters to satisfy CollectionInterface. Does not define
 * properties, as visibility and docblocks are left up to the developer.
 *
 * @author Barnaby Walters
 */
trait CollectionTrait {
    public function offsetGet($index) {
        if ($index == 'totalItems')
            return count($this->offsetGet ('items'));
        
        return parent::offsetGet($index);
    }
    
    public function addItem($item) {
        $this['items'][] = $item;
    }
    
    /**
     * @todo make this check instanceof *Interface
     */
    public function addItems(array $items) {
        array_push($this['items'], $items);
    }
}
