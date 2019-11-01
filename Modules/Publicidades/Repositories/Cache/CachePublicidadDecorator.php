<?php

namespace Modules\Publicidades\Repositories\Cache;

use Modules\Publicidades\Repositories\PublicidadRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePublicidadDecorator extends BaseCacheDecorator implements PublicidadRepository
{
    public function __construct(PublicidadRepository $publicidad)
    {
        parent::__construct();
        $this->entityName = 'publicidades.publicidads';
        $this->repository = $publicidad;
    }
}
