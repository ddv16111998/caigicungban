<?php

namespace App\Services\Upload\Entities\Contracts;

interface UploadInterface {
    public function upload();
    public function delete();
}
