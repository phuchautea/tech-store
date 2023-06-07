<?php

namespace App\Services;

use App\Interfaces\Image\IImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageService implements IImageService
{
    public function normalizeFileName($fileName){
        // Remove special characters
        $fileName = preg_replace("/[^a-zA-Z0-9\.\-\s]/", "", $fileName);

        // Replace spaces with underscores
        $fileName = str_replace(' ', '_', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        return $fileName;
    }
    public function upload(Request $request) {
        $image = $request->file('image');
        return self::processUpload($image);
    }
    public function processUpload($image){
        //$image = $request->file('image');

        if (!$image) {
            return response()->json(['error' => 'No image uploaded.']);
        }

        if (!$image->isValid()) {
            return response()->json(['error' => 'Invalid image.']);
        }

        // $path = $image->store('uploads/products'); // lưu với tên ngẫu nhiên của hàm uniqid();

        $prefix = 'uploads';
        $fileName = self::normalizeFileName($image->getClientOriginalName());
        $exists = Storage::exists("public/{$prefix}/{$fileName}");
        $extension = $image->getClientOriginalExtension();

        if ($exists) {
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
        }

        $path = $image->storeAs("public/{$prefix}", $fileName);

        return response()->json(['path' => "/storage/{$prefix}/{$fileName}"]);
    }
}
