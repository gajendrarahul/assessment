<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : $uploadedFile->getClientOriginalName();

        // Delete the existing file if it exists
        // if (Storage::disk($disk)->exists($folder . '/' . $name)) {
        //     Storage::disk($disk)->delete($folder . '/' . $name);
        // }

        // Upload the new file and return the new path (here the dist is set to public by default)
        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return $file;
    }

    public function deleteFile($path, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}
