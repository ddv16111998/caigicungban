<?php

namespace Modules\Payment\Services\Entities;

use Modules\Payment\Services\Entities\Contracts\MomoInterface;

class Momo implements MomoInterface {
    public function handle()
    {
        return 'momo';
    }
}
