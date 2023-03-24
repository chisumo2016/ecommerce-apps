<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteMediaController extends Controller
{
    public function __invoke(Request $request)
    {
        $media = Media::find($request->id);
        $media->delete();

        return back()->with('message', 'Image deleted successfully');

    }
}
