<?php

namespace Knovators\ImageResize;

use Arr;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;

/**
 * Trait ImageService
 * @package Knovators\ImageResize
 */
trait ImageService
{

    /**
     * @param         $uri
     * @param         $extension
     * @param Request $request
     * @return void
     */
    public function imageParse($uri, $extension, Request $request) {

        $disk = ($request->has('disk')) ? Storage::disk($request->get('disk')) : Storage::disk('public');

        $uri = explode(DIRECTORY_SEPARATOR, $uri);

        $fileName = array_pop($uri) . '.' . $extension;

        $sizeFolder = array_pop($uri);

        $uri = implode(DIRECTORY_SEPARATOR, $uri);

        $newPath = $disk->path($uri . DIRECTORY_SEPARATOR . $sizeFolder);

        if (!file_exists($newPath)) {
            File::makeDirectory($newPath);
        }

        $dimensions = explode('x', $sizeFolder);

        $image = Image::make($disk->path($uri . DIRECTORY_SEPARATOR . $fileName))
                      ->resize(Arr::first($dimensions), Arr::last($dimensions))
                      ->save($newPath . DIRECTORY_SEPARATOR . $fileName);

        return $image->response($extension);

    }


}
