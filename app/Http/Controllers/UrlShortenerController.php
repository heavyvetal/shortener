<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UrlShortener;

class UrlShortenerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function makeShortUrl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => [
                'required',
                'regex: /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/'
            ],
        ]);

        if (!$validator->fails()) {
            $url_shortener = new UrlShortener($request->get('url'));
            $short_url = $url_shortener->makeShortUrl();

            $response = [
                "success"   => true,
                "short_url" => $short_url
            ];
        } else {
            $response = [
                "success" => false,
                "message" => "Validation failed.",
                "fails"   => $validator->errors()
            ];
        }

        return response(json_encode($response, JSON_UNESCAPED_SLASHES), 200);
    }
}
