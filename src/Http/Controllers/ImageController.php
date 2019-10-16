<?php

namespace Knovators\ImageResize\Http\Controllers;

use Illuminate\Routing\Controller;
use Knovators\ImageResize\ImageService;

/**
 * Class ImageResizeController
 * @package Knovators\ImageResize\Http\Controllers
 */
class ImageController extends Controller
{
    use ImageService;

}
