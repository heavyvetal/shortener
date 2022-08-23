<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserShortenerControllerTest extends TestCase
{
    public function testMakeShortUrl()
    {
        $response = $this->post(
            '/shortener',
            [
                'url' => 'http://asd.com',
            ]
        );

        $response->assertSeeText('"success":true', false);
    }

    public function testMakeShortUrlFromWrongUrl()
    {
        $response = $this->post(
            '/shortener',
            [
                'url' => 'http://asd',
            ]
        );

        $response->assertSeeText('Validation failed');
        $response->assertSeeText('The url format is invalid');
    }

    public function testMakeShortUrlFromEmptyUrl()
    {
        $response = $this->post(
            '/shortener',
            [
                'url' => '',
            ]
        );

        $response->assertSeeText('Validation failed');
        $response->assertSeeText('The url field is required');
    }
}
