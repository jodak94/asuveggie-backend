<?php

namespace Modules\Locales\Repositories\Cache;

use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLocalDecorator extends BaseCacheDecorator implements LocalRepository
{
    public function __construct(LocalRepository $local)
    {
        parent::__construct();
        $this->entityName = 'locales.locals';
        $this->repository = $local;
    }
}
