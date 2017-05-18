<?php

namespace Fireguard\UrlShortener;


use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use PHPUnit\Framework\TestCase;

class ToLyUrlShortenerTest extends TestCase
{
    /**
     * @var UrlShortener
     */
    protected $shortener;

    public function setUp()
    {
        parent::setUp();
        $this->shortener = new ToLyUrlShortener();
    }

    public function testShorten()
    {
        $url = $this->shortener->shorten('https://www.google.com.br');
        $this->assertTrue(!filter_var($url, FILTER_VALIDATE_URL) === false);
    }

    public function testShortenDestinationIsValid()
    {
        $baseUrl = 'https://www.google.com.br/';
        $url = $this->shortener->shorten($baseUrl);
        $client = new Client(['base_uri' => $url]);

        $newUrl = '';
        $client->get($url, [
            'on_stats' => function (TransferStats $stats) use (&$newUrl) {
                $newUrl = $stats->getEffectiveUri();
            }
        ])->getBody()->getContents();

        $this->assertEquals($baseUrl, (string) $newUrl);
    }
}
