<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocumentService
{
    public function saveDocument(UploadedFile $file, $title, $disk, $id = null)
    {
        $fileName = Str::slug($title).'-'.date('YmdHos').$id.'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($disk, $file, $fileName);

        return $fileName;
    }

    public function deleteDocument($fileName, $disk)
    {
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$disk.DIRECTORY_SEPARATOR.$fileName;

        return File::delete($path);
    }
}
