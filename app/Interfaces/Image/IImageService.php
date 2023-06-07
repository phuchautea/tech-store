<?php

namespace App\Interfaces\Image;

use Illuminate\Http\Request;

interface IImageService
{
    public function normalizeFileName($fileName);
    public function upload(Request $request);
    public function processUpload($image);
}
