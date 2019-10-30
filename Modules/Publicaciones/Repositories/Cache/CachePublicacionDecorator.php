<?php

namespace Modules\Publicaciones\Repositories\Cache;

use Modules\Publicaciones\Repositories\PublicacionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePublicacionDecorator extends BaseCacheDecorator implements PublicacionRepository
{
    public function __construct(PublicacionRepository $publicacion)
    {
        parent::__construct();
        $this->entityName = 'publicaciones.publicacions';
        $this->repository = $publicacion;
    }
}
