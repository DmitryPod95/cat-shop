<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ThumbnailController extends Controller
{
    public function __invoke(
        string $dir,
        string $method,
        string $size,
        string $file,
    ): BinaryFileResponse {
        abort_if(
            !in_array($size, config('thumbnail.allowed_size', [])),
            403,
            'size not allowed'
        );

        $storage = Storage::disk('images');

        $realPath = "$dir/$file";
        $newDirPath = "$dir/$method/$size";
        $resultPath = "$newDirPath/$file";

        if(!$storage->exists($newDirPath)) {
            $storage->makeDirectory($newDirPath);
        }

        if(!$storage->exists($resultPath)) {
            //TODO разобраться с драйвером Imagick
            $manager = new ImageManager(new Driver());

            $image = $manager->read($storage->path($realPath));
            [$w, $h] = explode('x', $size);
            $image->{$method}($w, $h);

            $image->save($storage->path($resultPath));

            return response()->file($storage->path($resultPath));
        }
    }
}
