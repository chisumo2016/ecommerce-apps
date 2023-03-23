<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadMediaController extends Controller
{

    public function __invoke()
    {
        return response('success');
    }
}
