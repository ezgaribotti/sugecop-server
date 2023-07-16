<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class UploadImageController extends Controller
{
    protected $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'image' => [
                'required',
                File::image()->max(1024)
            ]
        ]);

        return response()->success(
            $this->uploadImageService->save($request->file('image'))
        );
    }
}
