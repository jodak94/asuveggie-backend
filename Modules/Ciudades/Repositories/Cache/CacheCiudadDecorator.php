<?php

namespace Modules\Ciudades\Repositories\Cache;

use Modules\Ciudades\Repositories\CiudadRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCiudadDecorator extends BaseCacheDecorator implements CiudadRepository
{
    public function __construct(CiudadRepository $ciudad)
    {
        parent::__construct();
        $this->entityName = 'ciudades.ciudads';
        $this->repository = $ciudad;
    }
}
