<?php

namespace App\Traits;

use DomainException;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\FileAdder;

trait HasMediaUpload
{
    /**
     * @param string|UploadedFile $file
     * @param string $fileName
     * @return FileAdder
     */
    public function uploadImage($file, string $fileName): FileAdder
    {
        switch (true) {
            case $file instanceof UploadedFile:
                $method = 'addMedia';
                $extension = ".{$file->getClientOriginalExtension()}";
                break;
            case is_base64_image($file):
                $method = 'addMediaFromBase64';
                [, $extension] = explode('/', mime_content_type($file));
                break;
            default:
                throw new DomainException('File is invalid to upload!', 500);
        }

        return $this->$method($file)->usingFileName($fileName . '-' . now()->timestamp . $extension);
    }
}
