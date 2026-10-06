<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    protected $uploadPath;
    protected $updatePath;

    public function __construct()
    {
        $this->uploadPath = '/storage/images';
        $this->updatePath = 'images/';
        // $this->uploadPath = '../../../../../home/drrcoid/villa-kita.drr.co.id/storage/images';
        // $this->updatePath = 'images/';
    }
}
