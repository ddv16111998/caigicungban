<?php

namespace Modules\Banner\Repositories;

use Modules\Banner\Entities\Banner;
use Modules\Banner\Repositories\Contracts\BannerRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface{
    public function __construct(Banner $banner) {
        $this->model = $banner;
    }
}
