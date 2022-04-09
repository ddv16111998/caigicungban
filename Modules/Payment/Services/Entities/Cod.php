<?php

namespace  Modules\Payment\Services\Entities;

use Modules\Payment\Services\Entities\Contracts\CodInterface;

class Cod implements CodInterface {
    public function handle()
    {
        return 'cod';
    }
}
