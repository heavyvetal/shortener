<?php

namespace App\Http\Controllers;

use App\Models\Uri;

class RedirectorController extends Controller
{
    public function index($hash)
    {
        $url_record = Uri::where('short_hash', $hash)->first();

        if (isset($url_record)) {
            return redirect($url_record->url);
        }

        return abort(404);
    }
}
