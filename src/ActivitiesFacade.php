<?php

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * ActivitiesFacade
 *
 */
class ActivitiesFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'activities'; }
}