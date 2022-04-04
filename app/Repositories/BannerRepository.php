<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

class BannerRepository extends BaseRepository
{
    public function model()
    {
        return Model::class;
    }
}
