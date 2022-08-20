<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UrlShortener;

class UrlShortenerController extends Controller
{
    /*
     * TODO: check response 'message' property
     * TODO: check ENV file
     * TODO: phpdoc
     */
    public function makeShortUrl(Request $request, UrlShortener $url_shortener)
    {
        $validator = Validator::make($request->all(), [
            'url' => [
                'required',
                'regex: /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/'
            ],
        ]);

        if ($validator->fails()) {
            $response = [
                "success" => false,
                "message" => "Validation failed.",
                "fails"   => $validator->errors()
            ];
        } else {
            $short_url = $url_shortener->makeShortUrl($request->get('url'));

            $response = [
                "success"   => true,
                "message"   => "Short url generated",
                "short_url" => $short_url
            ];
        }

        return response(json_encode($response, JSON_UNESCAPED_SLASHES), 200);
    }
}
