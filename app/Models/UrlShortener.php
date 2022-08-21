<?php

namespace App\Models;

class UrlShortener
{
    /**
     * @var int
     */
    private $hash_generation_attempt = 0;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $short_hash;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function makeShortUrl()
    {
        $this->generateHash();

        while ($this->isHashCollision()) {
            $this->generateHash();
        }

        $this->saveUrl();

        return url('/') . '/' . $this->short_hash;
    }

    /**
     * @return bool
     */
    private function isHashCollision()
    {
        $collision = Uri::where('short_hash', $this->short_hash)->first();

        if (isset($collision) && $collision->url != $this->url) {
            return true;
        }

        return  false;
    }

    /**
     * @return void
     */
    private function generateHash()
    {
        $encoded_hash = base64_encode(str_repeat('0', $this->hash_generation_attempt++) . hash('sha256', $this->url));

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

        $this->short_hash = $short_hash;
    }

    /**
     * @return void
     */
    private function saveUrl()
    {
        Uri::updateOrCreate([
            'short_hash' => $this->short_hash,
            'url' => $this->url
        ]);
    }
}
