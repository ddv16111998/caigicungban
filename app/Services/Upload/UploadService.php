<?php
namespace App\Services\Upload;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use function createFolder;
use function public_path;


class UploadService{

    const THUMBNAIL = [
        'width' => 800,
    ];

    public function getFileName($file): string
    {
        return time() . '-' . $file->getClientOriginalName(). '.' .$file->extension();
    }

    public function getPathSavePublic($folderName, $fileName): string
    {
        return 'storage/upload/'. $folderName . '/'. $fileName;
    }

    public function resize($file, $width)
    {
        return $file->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
    }

    public function optimizeAutoImage($path)
    {
        $optimizerChain = OptimizerChainFactory::create();

        $optimizerChain->optimize($path);
    }

    public function upload($file, $folderName , $resize = true): ?string
    {
        if (!is_file($file)) {
            return null;
        }
        createFolder($folderName);

        $fileName = $this->getFileName($file);

        $pathSavePublic = $this->getPathSavePublic($folderName, $fileName);

        if ($resize) {
            $image = Image::make($file->getRealPath());
            $width = $image->width() > self::THUMBNAIL['width'] ? self::THUMBNAIL['width']  :  $image->width();
            $this->resize($image, $width)->save(public_path($pathSavePublic));
        }else{
            $path = 'public/upload/' . $folderName;
            Storage::putFileAs($path, $file, $fileName);
        }
        $this->optimizeAutoImage(public_path($pathSavePublic));

        return $pathSavePublic;
    }

    public function uploadMulti($files, $folderName, $resize = true): array
    {
        $pathFileArr = [];

        if ($files){
            foreach ($files as $file){
                array_push($pathFileArr, $this->upload($file, $folderName, $resize));
            }
        }

        return $pathFileArr;
    }

    function destroyFile($fileUrl): bool
    {
        $path = str_replace("storage","public",$fileUrl);
        if (Storage::exists($path)) {
            Storage::delete($path);
            return true;
        }
        return false;
    }

}
