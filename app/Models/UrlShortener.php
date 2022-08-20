<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    private $hash_generation_attempt = 0;

    private $url;

    public function makeShortUrl($url)
    {
        $short_hash = $this->generateHash($url);

        while ($this->isHashCollision($url, $short_hash)) {
            $short_hash = $this->generateHash($url);
        }

        $this->saveUrl($url, $short_hash);

        return url('/') . '/' . $short_hash;
    }

    private function isHashCollision($url, $short_hash)
    {
        $collision = Uri::where('short_hash', $short_hash)->first();

        if (isset($collision) && $collision->url != $url) {
            return true;
        }

        return  false;
    }

    private function generateHash($url)
    {
        $encoded_hash = base64_encode(str_repeat('0', $this->hash_generation_attempt++) . hash('sha256', $url));

        $short_hash = '';

        foreach (str_split($encoded_hash) as $index => $symbol) {
            if (strlen($short_hash) < 6) {
                if (ctype_alpha($symbol)) {
                    $short_hash .= $symbol;
                }
            } else {
                break;
            }
        }

        return $short_hash;
    }

    private function saveUrl($url, $short_hash)
    {
        Uri::updateOrCreate([
            'short_hash' => $short_hash,
            'url' => $url
        ]);
    }
}
