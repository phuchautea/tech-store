<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Image\IImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;
    public function __construct(IImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(Request $request){
        return $this->imageService->upload($request);
    }
}
