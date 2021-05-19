<?php

namespace App\Api\V1\Traits;

/**
 * 
 */
trait NamedRouteGen
{
    public function getNamedRoute($alias)
    {
        return   app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route($alias);
    }
}
